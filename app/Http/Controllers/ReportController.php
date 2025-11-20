<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Pipeline;
use App\Models\PipelineStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFormat;


class ReportController extends Controller
{
    //

    public function reports()
    {

        $pipelines = Pipeline::all();

        return view('reports.reports', [
            'pipelines' => $pipelines,
        ]);
    }


    public function getPipelineStages($pipelineId)
    {
        // Example relationship: Pipeline hasMany PipelineStage
        $pipelineStages = PipelineStage::where('pipeline_id', $pipelineId)->get();

        return response()->json($pipelineStages);
    }



    public function generateReport(Request $request)
    {

        // dd($request->all());
        // get all input values
        $reportType = $request->report_type;
        $pipelineId = $request->pipeline;
        $pipelineStageId = $request->pipeline_stage;
        $timePeriod = $request->time_period;

        // start query
        $query = Lead::query()->with(['pipeline']);

        $permissions = session('user_permissions', []);
        if (in_array(strtolower('lead-view-own'), array_map('strtolower', $permissions))) {
            $query->where('sales_owner', Auth::id());
        }

        // filter by report type
        if ($reportType == 'leads') {
            // no special filter yet, but here for future upgrades
        }

        // filter by pipeline
        if (!empty($pipelineId)) {
            $query->where('pipeline', $pipelineId);
        }

        // filter by pipeline stage
        if (!empty($pipelineStageId)) {
            $query->where('stage', $pipelineStageId);
        }

        // filter by time period
        if ($timePeriod == 'last_month') {
            $query->where('created_at', '>=', now()->subMonth());
        }

        if ($timePeriod == 'last_3_months') {
            $query->where('created_at', '>=', now()->subMonths(3));
        }

        if ($timePeriod == 'last_6_months') {
            $query->where('created_at', '>=', now()->subMonths(6));
        }

        if ($timePeriod == 'all_time') {
            // no filter applied
        }

        // get final results
        $results = $query->orderBy('id', 'DESC')->get();



        // calculate additional fields
        $totalLeadValue = $results->sum('lead_value');

        // build excel rows
        $data = [];

        // add headings
        $data[] = [
            'ID',
            'Title',
            'Lead Value',
            'Source',
            'Type',
            'Sales Owner',
            'Start Date',
            'Closing Date',
            'Description',
            'Contact Person',
            'Priority',
            'Pipeline',
            'Stage',
            'Created Date',
        ];

        // dd($results);

        // add each lead row
        foreach ($results as $lead) {
            $pipeline = $lead->pipeline()->first();
            $source = $lead->source()->first();
            $type = $lead->type()->first();
            $salesOwner = $lead->salesOwner()->first();
            $contact_person = $lead->person()->first();
            $data[] = [
                $lead->id,
                $lead->title ?? 'N/A',
                $lead->lead_value ?? 0,
                $source->name ?? 'N/A',
                $type->name ?? 'N/A',
                $salesOwner->name ?? 'N/A',
                $lead->start_date ?? 'N/A',
                $lead->closing_date ?? 'N/A',
                $lead->description ?? 'N/A',
                $contact_person->name ?? 'N/A',
                $lead->priority ?? 'N/A',
                $pipeline->name ?? 'N/A',
                $lead->stage ?? 'N/A',
                $lead->created_at->toDateString() ?? 'N/A',
            ];
        }

        // dd($data);

        // add summary row
        $data[] = ['', '', 'Total Value', $totalLeadValue, ''];
        return Excel::download(
            new class($data) implements \Maatwebsite\Excel\Concerns\FromArray
            {
                protected $data;

                // this is the part you asked about
                public function __construct($data)
                {
                    $this->data = $data;
                }

                public function array(): array
                {
                    return $this->data;
                }
            },
            'leads_report.xlsx'
        );



        // return to view with results
        // return view('admin.reports.results', compact('results'));
    }
}
