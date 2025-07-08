<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OtherUserDetails;
use App\Models\Pipeline;
use App\Models\PipelineStage;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class PipelineController extends Controller
{
    public function pipelines(Request $request)
    {
        if($request->isMethod('get')){
            $pipelines = Pipeline::get();
            return view('settings.pipelines.pipelines', ['pipelines' => $pipelines]);
         }
        
    }
    public function create_pipeline(Request $request)
    {
        if($request->isMethod('get')){
           
            return view('settings.pipelines.create_pipeline');
        }
        if($request->isMethod('post')){
            // dd($request->all());
            $request->validate([
                'name' => 'required|string',
                'rotting_days' => 'required|integer',
                'stages' => 'required|array',
                'stages.*' => 'required|string',
                'probabilities' => 'required|array',
                'probabilities.*' => 'required|integer',
            ]);
            $pipelines = Pipeline::get();

            $shouldBeDefault = $request->has('is_default') || $pipelines->isEmpty();

            if ($shouldBeDefault) {
            Pipeline::where('is_default', 'on')->update(['is_default' => 'off']);
            }

            $pipeline = Pipeline::create([
            'name' => $request->name,
            'rotting_days' => $request->rotting_days,
            'is_default' => $shouldBeDefault ? 'on' : 'off',
            ]);
           
            foreach ($request->stages as $index => $stageName) {
                PipelineStage::create([
                    'pipeline_id' => $pipeline->id,
                    'name' => $stageName,
                    'probability' => $request->probabilities[$index],
                ]);
            }
    
            return redirect()->back()->with('success', 'Pipeline created successfully!');
        }
    }
    public function delete_pipeline($id,Request $request)
    {
        if($request->isMethod('get')){
            Pipeline::where('id',$id)->delete();
            PipelineStage::where('pipeline_id',$id)->delete();

            return redirect()->back()->with('success', 'Pipeline deleted successfully!');

         }
        
    }
//     public function edit_pipeline($id, Request $request)
// {
//     if ($request->isMethod('get')) {
//         $pipeline = Pipeline::where('id', $id)->with('stages')->first();
//         return view('settings.pipelines.edit_pipeline', ['pipeline' => $pipeline]);
//     }

//     if ($request->isMethod('post')) {
//         $request->validate([
//             'name' => 'required|string',
//             'rotting_days' => 'required|integer',
//             'stages' => 'required|array',
//             'stages.*' => 'required|string',
//             'probabilities' => 'required|array',
//             'probabilities.*' => 'required|integer',
//         ]);
        
//         $pipelines = Pipeline::get();
//             if($request->has('is_default')){
//                 foreach($pipelines as $pipeline){
//                     $pipeline_update =  Pipeline::where('id', $pipeline->id)->first();
//                     $pipeline_update->is_default ='off';
//                     $pipeline_update->update();
//                 }
//             }
//             if($pipelines->isEmpty()){
//                 $pipeline =  Pipeline::where('id', $id)->first();;
//                 $pipeline->name = $request->name;
//                 $pipeline->rotting_days = $request->rotting_days;
//                 $pipeline->is_default ='on';
//                 $pipeline->update();
//             }
//             else{
//                 $pipeline =  Pipeline::where('id', $id)->first();;
//                 $pipeline->name = $request->name;
//                 $pipeline->rotting_days = $request->rotting_days;
//                 $pipeline->is_default =$request->has('is_default') ? 'on' : 'off';
//                 $pipeline->update();
//             }
        

//         foreach ($request->stages as $index => $stageName) {

//             if ($request->id[$index] == 'new') {
//                 $stage =  new PipelineStage();
//                 $stage->pipeline_id = $id;
//                 $stage->name = $stageName;
//                 $stage->probability =$request->probabilities[$index];
//                 $stage->save();
//             } else {
//                 $stage =  PipelineStage::where('id', $request->id[$index])->first();;
//                 $stage->name = $stageName;
//                 $stage->probability =$request->probabilities[$index];
//                 $stage->update();
//             }
//         }

//        return redirect()->back()->with('success', 'Pipeline updated successfully!');

//     }
// }
public function edit_pipeline($id, Request $request)
{
    if ($request->isMethod('get')) {
        $pipeline = Pipeline::with('stages')->findOrFail($id);
        return view('settings.pipelines.edit_pipeline', ['pipeline' => $pipeline]);
    }

    if ($request->isMethod('post')) {

        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'rotting_days' => 'required|integer',
            'stages' => 'required|array',
            'stages.*' => 'required|string',
            'probabilities' => 'required|array',
            'probabilities.*' => 'required|integer',
        ]);

        $pipeline = Pipeline::findOrFail($id);
        $allPipelines = Pipeline::all();

        $shouldBeDefault = $request->has('is_default') || $allPipelines->count() == 1;

        if ($shouldBeDefault) {
            Pipeline::where('is_default', 'on')->where('id', '!=', $id)->update(['is_default' => 'off']);
        }

        $pipeline->update([
            'name' => $request->name,
            'rotting_days' => $request->rotting_days,
            'is_default' => $shouldBeDefault ? 'on' : 'off',
        ]);

        foreach ($request->stages as $index => $stageName) {
            $stageId = $request->id[$index];

            if ($stageId === 'New') {
                PipelineStage::create([
                    'pipeline_id' => $pipeline->id,
                    'name' => $stageName,
                    'probability' => $request->probabilities[$index],
                ]);
            } else {
                $stage = PipelineStage::find($stageId);
                if ($stage) {
                    $stage->update([
                        'name' => $stageName,
                        'probability' => $request->probabilities[$index],
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Pipeline updated successfully!');
    }
}

public function delete_stage($id,Request $request)
{
    if($request->isMethod('get')){

        PipelineStage::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Stage deleted successfully!');

     }
    
}
public function delete_selected_pipelines(Request $request)
{
    $pipeIds = $request->input('selected_pipelines', []);
    
    if (!empty($pipeIds)) {
        Pipeline::whereIn('id', $pipeIds)->delete();
        PipelineStage::whereIn('pipeline_id',$pipeIds)->delete();
        return back()->with('success', 'Selected pipelines deleted successfully.');
    }

    return back()->with('error', 'No attributes selected.');
}
}



