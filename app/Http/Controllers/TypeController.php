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
use App\Models\Type;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class TypeController extends Controller
{
    public function types(Request $request)
    {
        if($request->isMethod('get')){
            $types = Type::get();
            return view('settings.types.types', ['types' => $types]);
         }
        
    }
    public function create_type(Request $request)
    {

        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|string',
            ]);
    
            $type =  new Type();
            $type->name = $request->name;
            $type->save();
    
            return redirect()->back()->with('success', 'Type created successfully!');
        }else{
            return view('settings.types.create_type');
        }
    }
    public function delete_type($id,Request $request)
    {
        if($request->isMethod('get')){
            Type::where('id',$id)->delete();
            return redirect()->back()->with('success', 'Type deleted successfully!');
         }
    }
    public function edit_type($id, Request $request)
{
    if ($request->isMethod('get')) {
        $type = Type::where('id', $id)->first();
        return view('settings.types.edit_type', ['type' => $type]);
    }

    if ($request->isMethod('post')) {
        $request->validate([
            'name' => 'required|string',
        ]);

        $type =  Type::where('id', $id)->first();;
        $type->name = $request->name;
        $type->update();

       return redirect()->back()->with('success', 'Type updated successfully!');

    }
}
public function delete_stage($id,Request $request)
{
    if($request->isMethod('get')){

        PipelineStage::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Stage deleted successfully!');

     }
    
}
public function delete_selected_types(Request $request)
{
    $typeIds = $request->input('selected_types', []);
    
    if (!empty($typeIds)) {
        Type::whereIn('id', $typeIds)->delete();
        return back()->with('success', 'Selected types deleted successfully.');
    }

    return back()->with('error', 'No attributes selected.');
}
}



