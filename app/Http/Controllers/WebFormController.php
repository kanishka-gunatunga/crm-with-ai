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
use App\Models\Person;
use App\Models\Organization;
use App\Models\Product;
use App\Models\Role;
use App\Models\WebForm;
use Illuminate\Support\Str;

use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class WebFormController extends Controller
{
    public function web_forms(Request $request)
{

    $query = WebForm::query();

    if ($request->filled('id')) {
        $query->where('id', $request->id);
    }

    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    if ($request->filled('id')) {
        $query->where('id', $request->id);
    }

    $forms = $query->get();

    return view('settings.web_forms.web_forms', [
        'forms' => $forms,
        'request' => $request->all()
    ]);
}


    public function create_web_form(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('settings.web_forms.create_web_form');
        }
        if($request->isMethod('post')){

            //  return var_dump($request->input('attribute'));

            $request->validate([
                'title' => 'required|string|max:255',
                'button_lable' => 'required',
                'success_action' => 'required',
            ]);
            $personAttributes = [];
            $leadAttributes = [];

            foreach ($request->input('person_attribute_checked') as $key => $isChecked) {
                if ($isChecked == 1) {
                    $attributeData = [
                        'name' => $request->input('person_attribute')[$key],
                        'parent' => $request->input('person_attribute_parent')[$key],
                        'type' => $request->input('person_attribute_type')[$key],
                        'label' => $request->input('person_attribute_lable')[$key],
                        'placeholder' => $request->input('person_attribute_placeholder')[$key],
                        'required' => isset($request->input('person_attribute_required')[$key]) ? 1 : 0,
                    ];
            
                    $personAttributes[] = $attributeData;
                }
            }

            foreach ($request->input('lead_attribute_checked') as $key => $isChecked) {
                if ($isChecked == 1) {
                    $attributeData = [
                        'name' => $request->input('lead_attribute')[$key],
                        'parent' => $request->input('lead_attribute_parent')[$key],
                        'type' => $request->input('lead_attribute_type')[$key],
                        'label' => $request->input('lead_attribute_lable')[$key],
                        'placeholder' => $request->input('lead_attribute_placeholder')[$key],
                        'required' => isset($request->input('lead_attribute_required')[$key]) ? 1 : 0,
                    ];
            
                    $leadAttributes[] = $attributeData;
                }
            }
            
            // return var_dump($leadAttributes);
            $form = new WebForm();
            $form->uid = Str::uuid()->toString();
            $form->title = $request->title;
            $form->button_lable = $request->button_lable;
            $form->success_action_type = $request->success_action_type;
            $form->success_action = $request->success_action;
            $form->description = $request->description;
            $form->background_color = $request->background_color;
            $form->form_background_color = $request->form_background_color;
            $form->title_color = $request->title_color;
            $form->submit_btn_color = $request->submit_btn_color;
            $form->lable_color = $request->lable_color;
            $form->create_lead_enabled = $request->create_lead_enabled;
            $form->person_attributes = $personAttributes;
            $form->lead_attributes = $leadAttributes;
            $form->save();
    
            return redirect()->back()->with('success', 'Web form created successfully!');
        }
    }
    public function delete_web_form($id,Request $request)
    {
        if($request('get')){
            WebForm::where('id',$id)->delete();
            return redirect()->back()->with('success', 'Web form deleted successfully!');
         }
    }
    public function edit_web_form($id, Request $request)
{
    $form = WebForm::findOrFail($id);

    if ($request->isMethod('get')) {
        return view('settings.web_forms.edit_web_form', ['form' => $form]);
    }
    if ($request->isMethod('post')) {

        $request->validate([
            'title' => 'required|string|max:255',
            'button_lable' => 'required',
            'success_action' => 'required',
        ]);
        
        $personAttributes = [];
        $leadAttributes = [];

        foreach ($request->input('person_attribute_checked') as $key => $isChecked) {
            if ($isChecked == 1) {
                $attributeData = [
                    'name' => $request->input('person_attribute')[$key],
                    'parent' => $request->input('person_attribute_parent')[$key],
                    'type' => $request->input('person_attribute_type')[$key],
                    'label' => $request->input('person_attribute_lable')[$key],
                    'placeholder' => $request->input('person_attribute_placeholder')[$key],
                    'required' => isset($request->input('person_attribute_required')[$key]) ? 1 : 0,
                ];
        
                $personAttributes[] = $attributeData;
            }
        }

        foreach ($request->input('lead_attribute_checked') as $key => $isChecked) {
            if ($isChecked == 1) {
                $attributeData = [
                    'name' => $request->input('lead_attribute')[$key],
                    'parent' => $request->input('lead_attribute_parent')[$key],
                    'type' => $request->input('lead_attribute_type')[$key],
                    'label' => $request->input('lead_attribute_lable')[$key],
                    'placeholder' => $request->input('lead_attribute_placeholder')[$key],
                    'required' => isset($request->input('lead_attribute_required')[$key]) ? 1 : 0,
                ];
        
                $leadAttributes[] = $attributeData;
            }
        }
        
        $form =  WebForm::where('id', $id)->first();;
        $form->title = $request->title;
        $form->button_lable = $request->button_lable;
        $form->success_action_type = $request->success_action_type;
        $form->success_action = $request->success_action;
        $form->description = $request->description;
        $form->background_color = $request->background_color;
        $form->form_background_color = $request->form_background_color;
        $form->title_color = $request->title_color;
        $form->submit_btn_color = $request->submit_btn_color;
        $form->lable_color = $request->lable_color;
        $form->create_lead_enabled = $request->create_lead_enabled;
        $form->person_attributes = $personAttributes;
        $form->lead_attributes = $leadAttributes;
        $form->update();

        return redirect()->back()->with('success', 'Web form updated successfully!');
    }
}

public function view_web_form($uid)
{
    $form = WebForm::where('uid', $uid)->firstOrFail();
    return view('public_web_form.view', compact('form'));
}
public function serveEmbedScript($uid)
{
    $form = WebForm::where('uid', $uid)->firstOrFail();
    $formUrl = url("/view-web-form/{$uid}");

    $script = <<<EOT
        document.write('<iframe src="{$formUrl}" width="100%" height="600" frameborder="0"></iframe>');
    EOT;

    return response($script, 200)->header('Content-Type', 'application/javascript');
}
public function web_form_submit($uid)
{
    $form = WebForm::where('uuid', $uuid)->firstOrFail();

    $emails = [];
    $contactNumbers = [];

    $person = new Person();
    $person->name = $request->person_name;
    $person->organization = $request->person_organization;
    $emails[] = [ 
        'value' => $request->person_email,
        'label' => 'work'
    ];
    $contactNumbers[] = [
        'value' => $request->person_phone,
        'label' => 'work'
    ];
    $person->emails = $emails;
    $person->contact_numbers =$contactNumbers;
    $person->save();

    if($form->create_lead_enabled == on){
        $pipeline = Pipeline::where('is_default', 'on')->first();
        $lead =  new Lead();
        $lead->title = $request->lead_title;
        $lead->lead_value = $request->lead_value;
        $lead->description = $request->lead_description;
        $lead->source = $request->lead_source;
        $lead->type = $request->lead_type;
        $lead->sales_owner = $request->lead_owner;
        $lead->closing_date = $request->lead_closing_date;
        $lead->status = 'active';
        $lead->category = 'qualified';
        $lead->pipeline = $pipeline->id;
        $lead->stage = PipelineStage::where('id',$pipeline->id)->where('name', 'New')->value('id');
        $lead->person = $person->id;
        $lead->save();
    }

    if ($form->success_action_type === 'redirect') {
        return redirect($form->success_action);
    }

    return response($form->success_action);
}
}



