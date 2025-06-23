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
use App\Models\EmailTemplate;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class EmailTemplateController extends Controller
{
    public function email_templates(Request $request)
    {
        if($request->isMethod('get')){

            $query = EmailTemplate::query();

            if ($request->filled('id')) {
                $query->where('id', $request->id);
            }

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('subject')) {
                $query->where('subject', 'like', '%' . $request->subject . '%');
            }
            $templates = $query->get();

            return view('settings.email_templates.email_templates', [
                'templates' => $templates,
                'request' => $request->all()
            ]);
         }
        
    }
    public function create_email_template(Request $request)
    {
        if($request->isMethod('get')){
            return view('settings.email_templates.create_email_template');
        }
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required',
                'subject' => 'required',
                'content' => 'required',
            ]);
    
            $template =  new EmailTemplate();
            $template->name = $request->name;
            $template->subject = $request->subject;
            $template->content = $request->content;
            $template->save();
    
            return redirect()->back()->with('success', 'Template created successfully!');
        }
    }
    public function delete_email_template($id,Request $request)
    {
        if($request->isMethod('get')){
            EmailTemplate::where('id',$id)->delete();
            return redirect()->back()->with('success', 'Template deleted successfully!');
         }
    }
    public function edit_email_template($id, Request $request)
{
    if ($request->isMethod('get')) {
        $template = EmailTemplate::where('id', $id)->first();
        return view('settings.email_templates.edit_email_template', ['template' => $template]);
    }

    if ($request->isMethod('post')) {
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'content' => 'required',
        ]);

        $template =  EmailTemplate::where('id', $id)->first();;
        $template->name = $request->name;
        $template->subject = $request->subject;
        $template->content = $request->content;
        $template->update();

       return redirect()->back()->with('success', 'Template updated successfully!');

    }
}
public function delete_selected_templates(Request $request)
{
    $tempalteIds = $request->input('selected_templates', []);
    
    if (!empty($tempalteIds)) {
        EmailTemplate::whereIn('id', $tempalteIds)->delete();
        return back()->with('success', 'Selected templates deleted successfully.');
    }

    return back()->with('error', 'No attributes selected.');
}
}



