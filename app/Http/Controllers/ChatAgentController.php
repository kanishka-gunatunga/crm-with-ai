<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIAgentService;

class ChatAgentController extends Controller
{
    protected $agentService;

    public function __construct(OpenAIAgentService $agentService)
    {
        $this->agentService = $agentService;
    }

    public function chat(Request $request)
    {
        $request->validate([
            'messages' => 'required|array',
        ]);

        $messages = $request->input('messages');

        // Basic history limit/sanitization could go here

        $response = $this->agentService->chat($messages);

        return response()->json($response);
    }
}
