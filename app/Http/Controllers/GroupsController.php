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
use App\Models\Group;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class GroupsController extends Controller
{
    public function groups(Request $request)
    {
        if($request->isMethod('get')){

            $query = Group::query();

            if ($request->filled('id')) {
                $query->where('id', $request->id);
            }

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            $groups = $query->get();

            return view('settings.groups.groups', [
                'groups' => $groups,
                'request' => $request->all()
            ]);
         }
        
    }
    public function create_group(Request $request)
    {

        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|string',
            ]);
    
            $group =  new Group();
            $group->name = $request->name;
            $group->description = $request->description;
            $group->save();
    
            return redirect()->back()->with('success', 'Group created successfully!');
        }else{
            return view('settings.groups.create_group');
        }
    }
    public function delete_group($id,Request $request)
    {
        if($request->isMethod('get')){
            Group::where('id',$id)->delete();
            return redirect()->back()->with('success', 'Group deleted successfully!');
         }
    }
    public function edit_group($id, Request $request)
{
    if ($request->isMethod('get')) {
        $group = Group::where('id', $id)->first();
        return view('settings.groups.edit_group', ['group' => $group]);
    }

    if ($request->isMethod('post')) {
        $request->validate([
            'name' => 'required|string',
        ]);

        $group =  Group::where('id', $id)->first();;
        $group->name = $request->name;
        $group->description = $request->description;
        $group->update();

       return redirect()->back()->with('success', 'Group updated successfully!');

    }
}
public function delete_selected_groups(Request $request)
{
    $gropIds = $request->input('selected_groups', []);
    
    if (!empty($gropIds)) {
        Group::whereIn('id', $gropIds)->delete();
        return back()->with('success', 'Selected groups deleted successfully.');
    }

    return back()->with('error', 'No attributes selected.');
}
}



