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
use App\Models\Source;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class SourceController extends Controller
{
    public function sources(Request $request)
    {
        if($request->isMethod('get')){
            $sources = Source::get();
            return view('settings.sources.sources', ['sources' => $sources]);
         }
        
    }
    public function create_source(Request $request)
    {

        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|string',
            ]);
    
            $source =  new Source();
            $source->name = $request->name;
            $source->save();
    
            return redirect()->back()->with('success', 'Source created successfully!');
        }else{
            return view('settings.sources.create_source');
        }
    }
    public function delete_source($id,Request $request)
    {
        if($request->isMethod('get')){
            Source::where('id',$id)->delete();
            return redirect()->back()->with('success', 'Source deleted successfully!');

         }
        
    }
    public function edit_source($id, Request $request)
{
    if ($request->isMethod('get')) {
        $source = Source::where('id', $id)->first();
        return view('settings.sources.edit_source', ['source' => $source]);
    }

    if ($request->isMethod('post')) {
        $request->validate([
            'name' => 'required|string',
        ]);

        $source =  Source::where('id', $id)->first();;
        $source->name = $request->name;
        $source->update();

       return redirect()->back()->with('success', 'Source updated successfully!');

    }
}
public function delete_stage($id,Request $request)
{
    if($request->isMethod('get')){

        PipelineStage::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Stage deleted successfully!');

     }
    
}
public function delete_selected_sources(Request $request)
{
    $sourceIds = $request->input('selected_sources', []);
    
    if (!empty($sourceIds)) {
        Source::whereIn('id', $sourceIds)->delete();
        return back()->with('success', 'Selected soruces deleted successfully.');
    }

    return back()->with('error', 'No attributes selected.');
}
}



