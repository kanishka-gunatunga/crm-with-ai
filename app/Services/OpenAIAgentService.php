<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromArray;

class OpenAIAgentService
{
    /**
     * Process a user message through the Agentic workflow.
     *
     * @param array $messages History of messages including the latest user query.
     * @return array The assistant's response (content or tool output).
     */
    public function chat(array $messages)
    {
        // 1. Define available tools
        $tools = [
            [
                'type' => 'function',
                'function' => [
                    'name' => 'query_database',
                    'description' => 'Execute a read-only SQL query against the CRM database to answer user questions about leads, customers, or sales. The user might ask "How many leads..." or "List customers...". returns standard array of objects.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'sql' => [
                                'type' => 'string',
                                'description' => 'The SQL query to execute. MUST be a SELECT statement.',
                            ],
                        ],
                        'required' => ['sql'],
                    ],
                ],
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'generate_excel_report',
                    'description' => 'Generate an Excel report for sales or customer data. Use this when the user explicitly asks for a "report", "excel file", or to "download" data.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'report_type' => [
                                'type' => 'string',
                                'enum' => ['leads', 'customers', 'sales'],
                                'description' => 'The type of report to generate.',
                            ],
                            'filters' => [
                                'type' => 'object',
                                'description' => 'Optional filters like {"status": "won", "date_range": "last_month"}',
                            ],
                        ],
                        'required' => ['report_type'],
                    ],
                ],
            ],
        ];

        // 2. Add System Prompt with Schema Context
        $schemaContext = $this->getDatabaseSchemaContext();

        $systemMessageContent = "You are a helpful CRM assistant using Laravel. You can answer questions about data or generate reports. 
            
            Database Schema Context:
            $schemaContext
            
            Rules:
            1. Only generate SQL for READ operations (SELECT).
            2. If the user asks for a report/file, call 'generate_excel_report' tool.
            3. If the user asks a specific data question, call 'query_database' tool.
            4. Be concise and professional in your final answer.
            5. NEVER show the raw SQL query or internal reasoning in your final response to the user.
            6. If an error occurs, apologize and state you couldn't retrieve the data, do not explain the technical SQL error.
            7. Current Date is " . now()->toDateTimeString();

        // Check if system message exists, if not add it
        if (empty($messages) || $messages[0]['role'] !== 'system') {
            array_unshift($messages, ['role' => 'system', 'content' => $systemMessageContent]);
        }

        try {
            // 3. Call OpenAI
            $response = OpenAI::chat()->create([
                'model' => 'gpt-4o-mini', // Or gpt-3.5-turbo if cost is concern
                'messages' => $messages,
                'tools' => $tools,
                'tool_choice' => 'auto',
            ]);

            $message = $response->choices[0]->message;

            // 4. Handle Tool Calls
            if (isset($message->toolCalls) && count($message->toolCalls) > 0) {
                // OpenAI wants to run a tool
                $toolCall = $message->toolCalls[0];
                $functionName = $toolCall->function->name;
                $arguments = json_decode($toolCall->function->arguments, true);

                $toolResult = null;

                if ($functionName === 'query_database') {
                    $toolResult = $this->queryDatabase($arguments['sql']);
                } elseif ($functionName === 'generate_excel_report') {
                    $toolResult = $this->generateExcelReport($arguments['report_type'], $arguments['filters'] ?? []);
                }

                // Add the assistant's tool call message to history
                $messages[] = $message->toArray();

                // Add the tool execution result to history
                $messages[] = [
                    'role' => 'tool',
                    'tool_call_id' => $toolCall->id,
                    'content' => is_string($toolResult) ? $toolResult : json_encode($toolResult),
                ];

                // 5. Recursive Call: Send tool output back to OpenAI for final response
                $finalResponse = OpenAI::chat()->create([
                    'model' => 'gpt-4o-mini',
                    'messages' => $messages,
                ]);

                $finalMessage = $finalResponse->choices[0]->message;
                $messages[] = $finalMessage->toArray();

                return [
                    'message' => $this->cleanResponse($finalMessage->content),
                    'history' => $messages
                ];
            }

            // No tool call, just a normal reply
            $messages[] = $message->toArray();
            return [
                'message' => $this->cleanResponse($message->content),
                'history' => $messages
            ];

        } catch (\Exception $e) {
            Log::error('OpenAI Agent Error: ' . $e->getMessage());
            return [
                'message' => "I'm sorry, I encountered an error while processing your request.",
                'error' => $e->getMessage()
            ];
        }
    }

    protected function cleanResponse($content)
    {
        // Remove markdown code blocks (e.g., ```sql ... ```)
        $content = preg_replace('/```.*?```/s', '', $content);

        // Remove specific "internal thought" phrases if they appear at the start
        $patterns = [
            '/^Fetching the data now\.\.\./i',
            '/^Let me query the database\.\.\./i',
            '/^It seems there was an error.*?Let me/is',
        ];

        foreach ($patterns as $pattern) {
            $content = preg_replace($pattern, '', $content);
        }

        return trim($content);
    }

    protected function getDatabaseSchemaContext()
    {
        // This should be dynamic in a real app, but extracting schema for all tables is expensive
        // We list key columns for the most relevant tables
        return "
        Table: leads
        Columns: id, title, description, lead_value, type_id, source_id, pipeline_id, stage_id, created_at, updated_at
        
        Table: persons
        Columns: id, name, emails, contact_numbers, organization_id, created_at
        
        Table: organizations
        Columns: id, name, address, created_at
        
        Table: deals (if applicable, or similar to leads)

        Table: products
        Columns: id, name, sku, quantity, cost, description, created_at

        Table: services
        Columns: id, name, cost, description, created_at
        ";
    }

    protected function queryDatabase($sql)
    {
        // Security: Block destructive commands
        if (preg_match('/(INSERT|UPDATE|DELETE|DROP|ALTER|TRUNCATE)/i', $sql)) {
            return "Error: I can only execute read-only (SELECT) queries.";
        }

        try {
            // Limit results to prevent overwhelming the context
            if (!str_contains(strtoupper($sql), 'LIMIT')) {
                $sql .= " LIMIT 10";
            }

            $results = DB::select($sql);
            return $results;
        } catch (\Exception $e) {

            return "SQL Error: " . $e->getMessage();
        }
    }

    protected function generateExcelReport($type, $filters = [])
    {
        // Generate a filename
        $fileName = 'report_' . $type . '_' . time() . '.xlsx';

        // We need to store it in public storage to be downloadable
        // Ensure 'public' disk is configured in filesystems.php

        // Create dummy data or fetch real data based on type
        // For MVP, we'll fetch last 10 leads if type is leads
        $data = [];

        if ($type === 'leads') {
            $leads = DB::table('leads')->orderBy('created_at', 'desc')->limit(50)->get();
            $data[] = ['ID', 'Title', 'Value', 'Status', 'Created At'];
            foreach ($leads as $lead) {
                $status = $lead->status ?? ($lead->stage_id ?? 'N/A');
                $data[] = [$lead->id, $lead->title, $lead->lead_value, $status, $lead->created_at];
            }
        } elseif ($type === 'customers' || $type === 'persons') {
            $customers = DB::table('persons')->orderBy('created_at', 'desc')->limit(50)->get();
            $data[] = ['ID', 'Name', 'Emails', 'Contact Numbers', 'Organization ID', 'Created At'];
            foreach ($customers as $customer) {
                // Formatting JSON fields if they are JSON strings
                $emails = $customer->emails;
                if (is_string($customer->emails) && str_starts_with(trim($customer->emails), '[')) {
                    $decoded = json_decode($customer->emails, true);
                    if (is_array($decoded)) {
                        $processed = array_map(function ($item) {
                            return is_array($item) || is_object($item) ? json_encode($item) : (string) $item;
                        }, $decoded);
                        $emails = implode(', ', $processed);
                    }
                }

                $phones = $customer->contact_numbers;
                if (is_string($customer->contact_numbers) && str_starts_with(trim($customer->contact_numbers), '[')) {
                    $decoded = json_decode($customer->contact_numbers, true);
                    if (is_array($decoded)) {
                        $processed = array_map(function ($item) {
                            return is_array($item) || is_object($item) ? json_encode($item) : (string) $item;
                        }, $decoded);
                        $phones = implode(', ', $processed);
                    }
                }

                $data[] = [
                    $customer->id,
                    $customer->name,
                    $emails,
                    $phones,
                    $customer->organization_id ?? 'N/A',
                    $customer->created_at
                ];
            }
        } else {
            $data = [
                ['Message'],
                ['Report type ' . $type . ' not fully implemented yet in auto-generator.']
            ];
        }

        // Anonymous class for Export
        $export = new class ($data) implements FromArray {
            protected $data;
            public function __construct($data)
            {
                $this->data = $data; }
            public function array(): array
            {
                return $this->data; }
        };

        // Store file
        // Note: 'public' disk usually maps to storage/app/public
        Excel::store($export, 'reports/' . $fileName, 'public');

        // Make sure to run 'php artisan storage:link' if not done
        $url = asset('storage/reports/' . $fileName);

        return "Report generated successfully. Download link: " . $url;
    }
}
