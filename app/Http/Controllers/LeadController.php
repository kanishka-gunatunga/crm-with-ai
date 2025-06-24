<?php

namespace App\Http\Controllers;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\Pipeline;
use App\Models\PipelineStage;
use App\Models\Source;
use App\Models\Type;
use App\Models\Person;
use App\Models\Organization;
use App\Models\Product;
use App\Models\Lead;
use App\Models\LeadProduct;
use App\Models\LeadNote;
use App\Models\LeadActivity;
use App\Models\SentEmails;
use App\Models\LeadFile;
use App\Models\Quote;
use App\Models\Service;
use App\Models\ActivityHistory;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

use App\Mail\LeadSendEmail;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class LeadController extends Controller
{
    public function leads(Request $request)
{
    if ($request->isMethod('get')) {
        $types = Type::get();

        if (!session()->has('pipeline_id')) {
            $pipeline = Pipeline::where('is_default', 'on')->first();

            if (!$pipeline) {
                $pipeline = Pipeline::first();
            }

            if ($pipeline) {
                session(['pipeline_id' => $pipeline->id]);
            }
        }

        $pipeline = Pipeline::find(session('pipeline_id'));
        $pipelines = Pipeline::get();

        $stages = PipelineStage::where('pipeline_id', $pipeline->id)->get();

        $leadFilters = Lead::query()
            ->where('pipeline', $pipeline->id);

        if ($request->filled('name')) {
            $leadFilters->where('title', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('start_date')) {
            $leadFilters->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $leadFilters->whereDate('created_at', '<=', $request->end_date);
        }

        $filteredLeads = $leadFilters->get();

        $leadsGroupedByStage = $filteredLeads->groupBy('stage');

        return view('leads.leads', [
            'types' => $types,
            'pipeline' => $pipeline,
            'stages' => $stages,
            'pipelines' => $pipelines,
            'leadsGroupedByStage' => $leadsGroupedByStage
        ]);
    }
}
    // public function leads(Request $request)
    // {
    //     if($request->isMethod('get')){
    //         $types = Type::get();
    //         if (!session()->has('pipeline_id')) {
    //             $pipeline = Pipeline::where('is_default', 'on')->first();

    //             if (!$pipeline) {
    //                 $pipeline = Pipeline::first();
    //             }
        
    //             if ($pipeline) {
    //                 session(['pipeline_id' => $pipeline->id]);
    //             }
    //         }
        
    //         $pipeline = Pipeline::find(session('pipeline_id'));
    //         $pipelines = Pipeline::get();

    //         $stages = PipelineStage::where('pipeline_id', $pipeline->id)->get();
            
    //         return view('leads.leads', ['types' => $types,'pipeline' => $pipeline,'stages' => $stages,'pipelines' => $pipelines]);
    //      }
        
    // }
public function update_pipline_session(Request $request)
{
    $request->validate([
        'pipeline_id' => 'required|exists:pipelines,id',
    ]);

    session(['pipeline_id' => $request->pipeline_id]);

    return response()->json(['message' => 'Pipeline session updated.']);
}

    public function create_lead(Request $request)
    {
        $id = session('pipeline_id');

        if ($request->isMethod('get')) {
            $sources = Source::get();
            $types = Type::get();
            $owners = UserDetails::get();
            $persons = Person::get();
            $organizations = Organization::get();
            $products = Product::get();
            $services = Service::get();
            return view('leads.create_lead', ['sources' => $sources,'types' => $types,'owners' => $owners,
            'persons' => $persons,'organizations' => $organizations,'products' => $products,'services' => $services]);
        }
        if($request->isMethod('post')){
            $request->validate([
                'title' => 'required|string',
                'lead_value' => 'required',
                'source' => 'required',
            ]);
            
            if(Person::where("id", $request->person)->exists()){
                $person = Person::findOrFail($id);
                $person->organization = $request->organization;
                if ($request->has('emails')) {
                    $emails = [];
                    foreach ($request->input('emails') as $key => $email) {
                        $emailType = $request->input("email_types.{$key}");
                        $emails[] = [
                            'value' => $email,
                            'label' => $emailType 
                        ];
                    }
                    $person->emails = $emails;
                }
        
                if ($request->has('contact_numbers')) {
                    $contactNumbers = [];
                    foreach ($request->input('contact_numbers') as $key => $contactNumber) {
                        $numberType = $request->input("number_types.{$key}");
                        $contactNumbers[] = [
                            'value' => $contactNumber,
                            'label' => $numberType 
                        ];
                    }
                    $person->contact_numbers = $contactNumbers;
                }
                $person->update();
            }
            else{
                $person = new Person();
                $person->name = $request->person;
                $person->organization = $request->organization;
                if ($request->has('emails')) {
                    $emails = [];
                    foreach ($request->input('emails') as $key => $email) {
                        $emailType = $request->input("email_types.{$key}");
                        
                        $emails[] = [
                            'value' => $email,
                            'label' => $emailType 
                        ];
                    }
                    
                    $person->emails = $emails;
                }
                
                if ($request->has('contact_numbers')) {
                    $contactNumbers = [];
                    foreach ($request->input('contact_numbers') as $key => $contactNumber) {
                        $numberType = $request->input("number_types.{$key}");
                        
                        $contactNumbers[] = [
                            'value' => $contactNumber,
                            'label' => $numberType 
                        ];
                    }
                    
                    $person->contact_numbers =$contactNumbers;
                }
                
                $person->save();
            }

            $lead =  new Lead();
            $lead->title = $request->title;
            $lead->lead_value = $request->lead_value;
            $lead->source = $request->source;
            $lead->type = $request->type;
            $lead->sales_owner = $request->sales_owner;
            $lead->start_date = $request->start_date;
            $lead->closing_date = $request->closing_date;
            $lead->description = $request->description;
            $lead->priority = $request->priority;
            $lead->status = 'active';
            $lead->category = 'qualified';
            $lead->pipeline = $id;
            $lead->stage = PipelineStage::where('id',$id)->where('name', 'New')->value('id');
            $lead->person = $person->id;
            $lead->save();

            if ($request->has('products')) {
            foreach ($request->products as $index => $product_id) {
                $values = explode('||', $product_id);
                $type = $values[0]; 
                $product = $values[1];

                LeadProduct::create([
                    'lead_id' => $lead->id,
                    'type' => $type,
                    'product_id' => $product,
                    'price' => $request->prices[$index],
                    'quantity' => $request->quantities[$index],
                    'amount' => $request->amounts[$index],
                ]);
            }
        }

        $activity_history =  new ActivityHistory();
        $activity_history->lead_id = $lead->id;
        $activity_history->user_id = Auth::user()->id;
        $activity_history->action = "Lead created";
        $activity_history->save();

        return redirect()->back()->with('success', 'Lead created successfully!');
        }
    }


    public function edit_lead($id,Request $request)
    {
        $lead = Lead::where('id',$id)->first();

        if ($request->isMethod('get')) {
            $sources = Source::get();
            $types = Type::get();
            $owners = UserDetails::get();
            $persons = Person::get();
            $organizations = Organization::get();
            $products = Product::get();
            $services = Service::get();

            $lead_products = LeadProduct::where('lead_id',$id)->get();

            return view('leads.edit_lead', ['sources' => $sources,'types' => $types,'owners' => $owners,
            'persons' => $persons,'organizations' => $organizations,'products' => $products,'lead' => $lead,'lead_products' => $lead_products
            ,'services' => $services]);
        }
        if($request->isMethod('post')){
            $request->validate([
                'title' => 'required|string',
                'lead_value' => 'required',
                'source' => 'required',
            ]);
            
            if(Person::where("id", $request->person)->exists()){
                $person = Person::findOrFail($id);
                $person->organization = $request->organization;
                if ($request->has('emails')) {
                    $emails = [];
                    foreach ($request->input('emails') as $key => $email) {
                        $emailType = $request->input("email_types.{$key}");
                        $emails[] = [
                            'value' => $email,
                            'label' => $emailType 
                        ];
                    }
                    $person->emails = $emails;
                }
        
                if ($request->has('contact_numbers')) {
                    $contactNumbers = [];
                    foreach ($request->input('contact_numbers') as $key => $contactNumber) {
                        $numberType = $request->input("number_types.{$key}");
                        $contactNumbers[] = [
                            'value' => $contactNumber,
                            'label' => $numberType 
                        ];
                    }
                    $person->contact_numbers = $contactNumbers;
                }
                $person->update();
            }
            else{
                $person = new Person();
                $person->name = $request->person;
                $person->organization = $request->organization;
                if ($request->has('emails')) {
                    $emails = [];
                    foreach ($request->input('emails') as $key => $email) {
                        $emailType = $request->input("email_types.{$key}");
                        
                        $emails[] = [
                            'value' => $email,
                            'label' => $emailType 
                        ];
                    }
                    
                    $person->emails = $emails;
                }
                
                if ($request->has('contact_numbers')) {
                    $contactNumbers = [];
                    foreach ($request->input('contact_numbers') as $key => $contactNumber) {
                        $numberType = $request->input("number_types.{$key}");
                        
                        $contactNumbers[] = [
                            'value' => $contactNumber,
                            'label' => $numberType 
                        ];
                    }
                    
                    $person->contact_numbers =$contactNumbers;
                }
                
                $person->save();
            }

            $lead->title = $request->title;
            $lead->lead_value = $request->lead_value;
            $lead->source = $request->source;
            $lead->type = $request->type;
            $lead->sales_owner = $request->sales_owner;
            $lead->start_date = $request->start_date;
            $lead->closing_date = $request->closing_date;
            $lead->description = $request->description;
            $lead->priority = $request->priority;
            $lead->person = $person->id;
            $lead->update();

            LeadProduct::where('lead_id',$id)->delete();

            if ($request->has('products')) {
            foreach ($request->products as $index => $product_id) {
                $values = explode('||', $product_id);
                $type = $values[0]; 
                $product = $values[1];
                
                LeadProduct::create([
                    'lead_id' => $id,
                    'type' => $type,
                    'product_id' => $product,
                    'price' => $request->prices[$index],
                    'quantity' => $request->quantities[$index],
                    'amount' => $request->amounts[$index],
                ]);
            }
            }
            $activity_history =  new ActivityHistory();
            $activity_history->lead_id = $id;
            $activity_history->user_id = Auth::user()->id;
            $activity_history->action = "Lead updated";
            $activity_history->save();

            return redirect()->back()->with('success', 'Lead updated successfully!');
        }
    }
    public function delete_type($id,Request $request)
    {
        if($request->isMethod('get')){
            Type::where('id',$id)->delete();
            return redirect()->back()->with('success', 'Type deleted successfully!');
         }
    }
    public function view_lead($id, Request $request)
{
    if ($request->isMethod('get')) {
        $sources = Source::get();
        $types = Type::get();
        $owners = UserDetails::get();
        $persons = Person::get();
        $organizations = Organization::get();
        $products = Product::get();
        $lead = Lead::where('id',$id)->first();
        $lead_products = LeadProduct::where('lead_id',$id)->get();
        $pipeline = Pipeline::where('id', $lead->pipeline)->first();
        $stages = PipelineStage::where('pipeline_id', $pipeline->id)->get();
        $notes = LeadNote::where('lead_id',$id)->get();
        $actvities = LeadActivity::where('lead_id',$id)->get();
        $lead_emails = SentEmails::where('lead_id',$id)->get();
        $files = LeadFile::where('lead_id',$id)->get();
        $quotes = Quote::where('lead',$id)->get();
        $activity_logs = ActivityHistory::orderBy('id', 'DESC')->where('lead_id',$id)->get();

        $allItems = [];

        foreach ($notes as $note) {
            $allItems[] = [
                'type' => 'note',
                'created_at' => $note->created_at,
                'note' => $note
            ];
        }

        foreach ($actvities as $actvity) {
            $allItems[] = [
                'type' => strtolower($actvity->type),
                'created_at' => $actvity->created_at,
                'activity' => $actvity
                
            ];
        }

        foreach ($files as $file) {
            $allItems[] = [
                'type' => 'file',
                'created_at' => $file->created_at,
                'file' => $file
            ];
        }

        usort($allItems, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']); 
        });

        return view('leads.view_lead', ['sources' => $sources,'types' => $types,'owners' => $owners,
        'persons' => $persons,'organizations' => $organizations,'products' => $products,'lead' => $lead,'lead_products' => $lead_products
        ,'stages' => $stages,'notes' => $notes,'actvities' => $actvities,'lead_emails' => $lead_emails,'files' => $files,'quotes' => $quotes
        ,'allItems' => $allItems,'activity_logs' => $activity_logs]);
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

public function get_contact_person_details($id,Request $request)
    {
        if ($request->isMethod('get')) {
            $person = Person::find($id);
            if($person){
                $organization_name=Organization::where('id', $person->organization)->value('name');
            }
            else{
                $organization_name=null;
            }
            return response()->json([
                'organization' => $person->organization ?? null,
                'organization_name' => $organization_name,
                'emails' => $person->emails ?? [],
                'contact_numbers' => $person->contact_numbers ?? []
            ]);
        }
        
}

public function update_lead_stage(Request $request)
{
    $lead = Lead::find($request->lead_id);
    if ($lead) {
        $old_stage = $lead->stage;
        $old_stage_name = PipelineStage::where('id',$old_stage)->value('name');
        $new_stage_name = PipelineStage::where('id',$request->new_stage_id)->value('name');


        $lead->stage = $request->new_stage_id;
        $lead->won_value = $request->won_value;
        $lead->closed_date = $request->closed_date;
        $lead->reason = $request->reason;
        $lead->save();

        $activity_history = new ActivityHistory();
        $activity_history->lead_id = $request->lead_id;
        $activity_history->user_id = Auth::id();
        $activity_history->action = "Lead stage changed from {$old_stage_name} to {$new_stage_name}";
        $activity_history->save();
    

        return response()->json(['success' => true, 'message' => 'Stage updated successfully']);
    }

    return response()->json(['success' => false, 'message' => 'Lead not found']);
    
}

public function add_lead_note($id,Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'note' => 'required|string',
            ]);
    
            $lead_note =  new LeadNote();
            $lead_note->lead_id = $id;
            $lead_note->note = $request->note;
            $lead_note->save();

            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $id;
            $activity_history->source = 'note';
            $activity_history->source_id = $lead_note->id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "A note (#{$lead_note->id}) has been added.";
            $activity_history->save();
    
            return redirect()->back()->with('success', 'Note {$old_stage_name} created successfully!');
        }
    }
    public function edit_note($id,Request $request)
    {
        $note = LeadNote::where('id',$id)->first();
        if($request->isMethod('get')){

            return view('leads.notes.edit_note', ['note' => $note]);

        }
        if($request->isMethod('post')){
            $request->validate([
                'note' => 'required|string',
            ]);
    
            $note->note = $request->note;
            $note->update();
            
            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $note->lead_id;
            $activity_history->source = 'note';
            $activity_history->source_id = $id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "Note (#{$id}) has been updated.";
            $activity_history->save();

            return redirect()->back()->with('success', 'Note updated successfully!');
        }
    }
   public function delete_note($id, Request $request)
{
    if ($request->isMethod('get')) {

        $note = LeadNote::find($id);

        if ($note) {
            $lead_id = $note->lead_id;

            $note->delete();

            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $lead_id;
            $activity_history->source = 'note';
            $activity_history->source_id = $id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "Note (#{$id}) has been deleted.";
            $activity_history->save();

            return redirect()->back()->with('success', 'Note deleted successfully!');
        }

        return redirect()->back()->with('error', 'Note not found.');
    }
}

    public function add_lead_activity($id,Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'title' => 'required',
                'type' => 'required',
                'from' => 'required',
                'to' => 'required',
            ]);
    
            $lead_activity =  new LeadActivity();
            $lead_activity->lead_id = $id;
            $lead_activity->title = $request->title;
            $lead_activity->type = $request->type;
            $lead_activity->from = $request->from;
            $lead_activity->to = $request->to;
            $lead_activity->location = $request->location;
            $lead_activity->description = $request->description;
            $lead_activity->created_by = Auth::user()->id;

            $participants = [];
            if ($request->has('participants')) {
                foreach ($request->participants as $participant) {
                    list($type, $id) = explode('||', $participant);

                    $participants[] = [
                        'type' => $type,
                        'id'   => (int) $id
                    ];
                }
            }
            $lead_activity->participants = $participants;
            $lead_activity->is_completed =0;
            $lead_activity->save();
    
            $this->addEventToGoogleCalendar($lead_activity);

            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $id;
            $activity_history->source = $request->type;
            $activity_history->source_id = $lead_activity->id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "{$request->type} (#{$lead_activity->id}) has been added.";
            $activity_history->save();

            return redirect()->back()->with('success', 'Activity created successfully!');
        }
        
    }
    public function edit_activity($id,Request $request)
    {
        $lead_activity = LeadActivity::where('id',$id)->first();
        if($request->isMethod('get')){
            $owners = UserDetails::get();
            $persons = Person::get();
            $leads = Lead::get();
            return view('leads.activities.edit_activity', ['activity' => $lead_activity,'owners' => $owners,'persons' => $persons,'leads' => $leads]);

        }
        if($request->isMethod('post')){
            $request->validate([
                'title' => 'required',
                'type' => 'required',
                'from' => 'required',
                'to' => 'required',
                'lead' => 'required',
            ]);
    
            $lead_activity->lead_id =$request->lead;
            $lead_activity->title = $request->title;
            $lead_activity->type = $request->type;
            $lead_activity->from = $request->from;
            $lead_activity->to = $request->to;
            $lead_activity->location = $request->location;
            $lead_activity->description = $request->description;

            $participants = [];
            if ($request->has('participants')) {
                foreach ($request->participants as $participant) {
                    list($type, $id) = explode('||', $participant);

                    $participants[] = [
                        'type' => $type,
                        'id'   => (int) $id
                    ];
                }
            }
            $lead_activity->participants = $participants;
            $lead_activity->update();
            
            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $lead_activity->lead_id;
            $activity_history->source = $request->type;
            $activity_history->source_id = $id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "{$request->type} (#{$id}) has been updated.";
            $activity_history->save();

            return redirect()->back()->with('success', 'Activity updated successfully!');
        }
    }

public function delete_activity($id, Request $request)
{
    if ($request->isMethod('get')) {

        $activity = LeadActivity::find($id);

        if ($activity) {
            $lead_id = $activity->lead_id;
            $type = $activity->type;

            $activity->delete();

            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $lead_id;
            $activity_history->source = $type;
            $activity_history->source_id = $id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "{$type} (#{$id}) has been deleted.";
            $activity_history->save();

           return redirect()->back()->with('success', 'Activity deleted successfully!');
        }

        return redirect()->back()->with('error', 'Note not found.');
    }
}
public function delete_selected_activities(Request $request)
{
    $activityIds = $request->input('selected_activities', []);

    if (!empty($activityIds)) {
        $activities = LeadActivity::whereIn('id', $activityIds)->get();

        foreach ($activities as $activity) {
            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $activity->lead_id;
            $activity_history->source = $activity->type;
            $activity_history->source_id = $activity->id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "{$activity->type} (#{$activity->id}) has been deleted.";
            $activity_history->save();
        }

        LeadActivity::whereIn('id', $activityIds)->delete();

        return back()->with('success', 'Selected activities deleted successfully.');
    }

    return back()->with('error', 'No activities selected.');
}

public function complete_activity($id,Request $request)
    {
        $lead_activity = LeadActivity::where('id',$id)->first();
        if($request->isMethod('get')){

            $lead_activity->is_completed =1;
            $lead_activity->update();

            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $lead_activity->lead_id;
            $activity_history->source = $lead_activity->type;
            $activity_history->source_id = $lead_activity->id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "{$lead_activity->type} (#{$lead_activity->id}) has been marked as complete.";
            $activity_history->save();

            return redirect()->back()->with('success', 'Activity marked as completed!');
        }
        
    }
    public function add_lead_email($id,Request $request)
    {

        // dd($request->all());
        if($request->isMethod('post')){
            $request->validate([
                'to' => 'required',
                'subject' => 'required|string|max:255',
                'body' => 'required|string',
            ]);
    
            $lead_email =  new SentEmails();
            $lead_email->lead_id = $id;
            $lead_email->to = $request->to;
            $lead_email->cc = $request->cc;
            $lead_email->bcc = $request->bcc;
            $lead_email->subject = $request->subject;
            $lead_email->body = $request->body;

            $attachments = [];
            if ($request->hasFile('attchments')) {
                foreach ($request->file('attchments') as $file) {
                    $filename = time() . '_' . uniqid() . '_.' . $file->extension();
                    $file->move(public_path('uploads/leads/email_attachments'), $filename);
                    $attachments[] = $filename;
                }
            }

            $lead_email->attachments = $attachments;
            $lead_email->save();

            Mail::to($request->to)
            ->cc($request->cc ?? [])
            ->bcc($request->bcc ?? [])
            ->send(new LeadSendEmail($lead_email));

            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $id;
            $activity_history->source = 'email';
            $activity_history->source_id = $lead_email->id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "Email (#{$lead_email->id}) has been sent.";
            $activity_history->save();

            return back()->with('success', 'Lead activity saved and email sent successfully.');
        }
        
    }

public function delete_email($id, Request $request)
{
    if ($request->isMethod('get')) {

        $email = SentEmails::find($id);

        if ($email) {
            $lead_id = $email->lead_id;

            $email->delete();

            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $lead_id;
            $activity_history->source = 'email';
            $activity_history->source_id = $id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "Email (#{$id}) has been deleted.";
            $activity_history->save();

            return redirect()->back()->with('success', 'Email deleted successfully!');
        }

        return redirect()->back()->with('error', 'Note not found.');
    }
}
    public function add_lead_file($id,Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required',
                'file' => 'required',
            ]);
            
            $file_name = time().'-.'.$request->file->extension();
            $request->file->move(public_path('uploads/leads/files'), $file_name);

            $lead_file =  new LeadFile();
            $lead_file->lead_id = $id;
            $lead_file->name = $request->name;
            $lead_file->description = $request->description;
            $lead_file->file = $file_name;
            $lead_file->save();

            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $id;
            $activity_history->source = 'file';
            $activity_history->source_id = $lead_file->id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "File (#{$lead_file->id}) has been added.";
            $activity_history->save();

            return back()->with('success', 'Lead file successfully added.');
        }
        
    }
    public function edit_file($id,Request $request)
    {
        $lead_file = LeadFile::where('id',$id)->first();
        if($request->isMethod('get')){
            $owners = UserDetails::get();
            $persons = Person::get();
            $leads = Lead::get();
            return view('leads.files.edit_file', ['file' => $lead_file,'owners' => $owners,'persons' => $persons,'leads' => $leads]);

        }
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required',
            ]);
            
            if (!$request->hasFile('file')) {
                $file_name = $lead_file->file;
            }
            else{
                $file_name = time().'-.'.$request->file->extension();
                $request->file->move(public_path('uploads/leads/files'), $file_name);
            }

            $lead_file->name = $request->name;
            $lead_file->description = $request->description;
            $lead_file->file = $file_name;
            $lead_file->update();
            
            $activity_history = new ActivityHistory();
            $activity_history->lead_id = $lead_file->lead_id;
            $activity_history->source = 'file';
            $activity_history->source_id = $id;
            $activity_history->user_id = Auth::id();
            $activity_history->action = "File (#{$id}) has been updated.";
            $activity_history->save();

            return redirect()->back()->with('success', 'File updated successfully!');
        }
    }
public function delete_file($id,Request $request)
{
    if($request->isMethod('get')){

        LeadFile::where('id',$id)->delete();
        return redirect()->back()->with('success', 'File deleted successfully!');

     }
    
}

public function delete_lead($id,Request $request)
{
    if($request->isMethod('get')){

        Lead::where('id',$id)->delete();
        LeadActivity::where('lead_id',$id)->delete();
        SentEmails::where('lead_id',$id)->delete();
        LeadFile::where('lead_id',$id)->delete();
        LeadNote::where('lead_id',$id)->delete();
        LeadProduct::where('lead_id',$id)->delete();
        Quote::where('lead',$id)->delete();

        $activity_history = new ActivityHistory();
        $activity_history->lead_id = $id;
        $activity_history->user_id = Auth::id();
        $activity_history->action = "Lead has been deleted.";
        $activity_history->save();
        return redirect('leads')->with('success', 'Lead deleted successfully!');

     }
    
}

public function activities(Request $request)
{
    if ($request->isMethod('get')) {

        $query = LeadActivity::query();
        
        if ($request->has('title') && $request->title != '') {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        
        if ($request->has('is_done') && $request->is_done !== '') {
            $query->where('is_completed', $request->is_done);
        }
        
        if ($request->has('created_by') && $request->created_by != '') {
            $query->where('created_by', $request->created_by);
        }
        
        if ($request->has('lead') && $request->lead != '') {
            $query->where('lead_id', $request->lead);
        }
        
        if ($request->has('shedule_start_date') && $request->shedule_start_date != '') {
            $query->where('from', '>=', $request->shedule_start_date);
        }
        
        if ($request->has('shedule_end_date') && $request->shedule_end_date != '') {
            $query->where('to', '<=', $request->shedule_end_date);
        }
        
        if ($request->has('created_start_date') && $request->created_start_date != '') {
            $query->where('created_at', '>=', $request->created_start_date);
        }
        
        if ($request->has('created_end_date') && $request->created_end_date != '') {
            $query->where('created_at', '<=', $request->created_end_date);
        }

        $activities = $query->get();

        $owners = UserDetails::get();
        $leads = Lead::get();
        
        return view('leads.activities.activities', [
            'activities' => $activities,
            'owners' => $owners,
            'leads' => $leads
        ]);
    }
}

public function export_leads($format,Request $request){
    $leads = Lead::where('pipeline',session('pipeline_id'))->get();
    $data = [];
    
        $data[] = [
            'Lead Title',
            'Person Name',
            'Email',
            'Phone',
            'Description',
            'Lead Source',
            'Lead Type',
            'Lead Pipeline',
            'Lead Stage',
            'Lead Value',
            'Created At',
        ];
        
        foreach ($leads as $lead) {
        $person = Person::where('id', $lead->person)->first();
            $data[] = [
                $lead->title,
                $person->name ?? '',
                $person->emails[0]['value'] ?? '',
                $person->contact_numbers[0]['value'] ?? '',
                $lead->description,
                Source::where('id', $lead->source)->value('name') ?? '-',
                Type::where('id', $lead->type)->value('name') ?? '-',
                Pipeline::where('id', $lead->pipeline)->value('name') ?? '-',
                PipelineStage::where('id', $lead->stage)->value('name') ?? '-',
                $lead->lead_value,
                $lead->created_at->format('Y-m-d'),
            ];
        }
    
        $export = new class($data) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;
            public function __construct(array $data)
            {
                $this->data = $data;
            }
    
            public function array(): array
            {
                return $this->data;
            }
        };
        if ($format === 'csv') {
            return Excel::download($export, 'leads.csv', \Maatwebsite\Excel\Excel::CSV);
        } else {
            return Excel::download($export, 'leads.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
       
    }
public function update_activity_status(Request $request)
{
    $activity = LeadActivity::find($request->activity_id);

    if ($activity) {
        $activity->is_completed = $request->status;
        $activity->update();

        $statusText = $request->status == 1 ? 'complete' : 'incomplete';

        $activity_history = new ActivityHistory();
        $activity_history->lead_id = $activity->lead_id;
        $activity_history->source = $activity->type;
        $activity_history->source_id = $activity->id;
        $activity_history->user_id = Auth::id();
        $activity_history->action = "{$activity->type} (#{$activity->id}) has been marked as {$statusText}.";
        $activity_history->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}



public function import_leads(Request $request)
{
    if ($request->isMethod('post')) {

        $request->validate([
            'leads' => 'required|mimes:xls,xlsx,csv',
        ]);

        $data = Excel::toArray([], $request->file('leads'));

        $rows = $data[0]; 
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $record = array_combine($header, $row);

            if(Person::where("name", $record['Contact Person Name'])->whereJsonContains("emails->value", $record['Contact Person Email'])
            ->whereJsonContains("contact_numbers->value", $record['Contact Person Number'])->exists()){
                $person = Person::where("name", $record['Contact Person Name'])->whereJsonContains("emails->value", $record['Contact Person Email'])->whereJsonContains("contact_numbers->value", $record['Contact Person Number'])->first();
            }
            else{
                $emails = [];
                $contactNumbers = [];

                $person = new Person();
                $person->name = $record['Contact Person Name'] ?? null;
                $emails[] = [ 
                    'value' => $record['Contact Person Email'],
                    'label' => 'work'
                ];
                $contactNumbers[] = [
                    'value' => $record['Contact Person Number'],
                    'label' => 'work'
                ];
                $person->emails = $emails;
                $person->contact_numbers =$contactNumbers;
                $person->save();
            }

            $id = session('pipeline_id');

            $rawDate = $record['Expected Closing Date'] ?? null;
            $closingDate = null;

            if ($rawDate) {
                if (is_numeric($rawDate)) {
                    $closingDate = \Carbon\Carbon::instance(ExcelDate::excelToDateTimeObject($rawDate))->format('Y-m-d');
                } else {
                    $closingDate = \Carbon\Carbon::parse($rawDate)->format('Y-m-d');
                }
            }

            $lead =  new Lead();
            $lead->title = $record['Lead Title'] ?? null;
            $lead->lead_value = $record['Lead Value'] ?? null;
            $lead->sales_owner = Auth::user()->id;
            $lead->closing_date = $closingDate;
            $lead->description = $record['Description'] ?? null;
            $lead->status = 'active';
            $lead->category = 'qualified';
            $lead->pipeline = $id;
            $lead->stage = PipelineStage::where('id',$id)->where('name', 'New')->value('id');
            $lead->person = $person->id;
            $lead->save();

            $activity_history =  new ActivityHistory();
            $activity_history->lead_id = $lead->id;
            $activity_history->user_id = Auth::user()->id;
            $activity_history->action = "Lead created";
            $activity_history->save();
        }

        return back()->with('success', 'Leads Successfully Imported');
    }
}


public function create_lead_api(Request $request)
{
    try {

         if(Person::where("name", $request->title)->whereJsonContains("emails->value",  $request->email)
        ->whereJsonContains("contact_numbers->value", $request->phone)->exists()){
            $person = Person::where("name", $request->title)->whereJsonContains("emails->value",  $request->email)->whereJsonContains("contact_numbers->value", $request->phone)->first();
        }
        else{
            $emails = [];
            $contactNumbers = [];

            $person = new Person();
            $person->name = $request->title ?? null;
            $emails[] = [ 
                'value' => $request->email, 
                'label' => 'work'
            ];
            $contactNumbers[] = [
                'value' => $request->phone,
                'label' => 'work'
            ];
            $person->emails = $emails;
            $person->contact_numbers =$contactNumbers;
            $person->save();
        }
 
        $pipeline = Pipeline::where('is_default', 'on')->first();

        if (!$pipeline) {
            $pipeline = Pipeline::first();
        }
        

        $lead =  new Lead();
        $lead->title = 'Lead for - ' . $request->title;
        $lead->lead_value =  $request->lead_value ?? null;
        $lead->description = $request->description;
        $lead->status = 'active';
        $lead->category =  $request->category;
        $lead->pipeline = $pipeline->id;
        $lead->stage = PipelineStage::where('id',$pipeline->id)->where('name', 'New')->value('id');
        $lead->person = $person->id;
        $lead->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Lead created successfully',
            'data' => $lead,
        ], 201);

    } catch (\Exception $e) {
        Log::error('Lead creation failed: ' . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while creating the lead',
            'error' => $e->getMessage(),
        ], 500);
    }
}
function addEventToGoogleCalendar($lead_activity)
{
    $client = new Google_Client();
    $client->setAuthConfig(storage_path('app/google-calendar/client-credentials.json')); 
    $client->addScope(Google_Service_Calendar::CALENDAR);
    $client->useApplicationDefaultCredentials();

    $service = new Google_Service_Calendar($client);

    $event = new Google_Service_Calendar_Event([
        'summary' => $lead_activity->title,
        'location' => $lead_activity->location,
        'description' => $lead_activity->description,
        'start' => [
            'dateTime' => \Carbon\Carbon::parse($lead_activity->from)->toRfc3339String(),
            'timeZone' => 'Asia/Colombo',
        ],
        'end' => [
            'dateTime' => \Carbon\Carbon::parse($lead_activity->to)->toRfc3339String(),
            'timeZone' => 'Asia/Colombo',
        ],
    ]);

    $calendarId = 'kodetechapi@gmail.com'; 
    $event = $service->events->insert($calendarId, $event);

    return $event->htmlLink; 
}

public function update_lead_priority(Request $request)
{
    $request->validate([
        'lead_id' => 'required|exists:leads,id',
        'priority' => 'required|in:High,Medium,Low',
    ]);

    $lead = Lead::find($request->lead_id);

    if ($lead) {
        $old_priority = $lead->priority;

        $lead->priority = $request->priority;
        $lead->save();

        $activity_history = new ActivityHistory();
        $activity_history->lead_id = $request->lead_id;
        $activity_history->user_id = Auth::id();
        $activity_history->action = "Lead priority changed from {$old_priority} to {$request->priority}";
        $activity_history->save();

    }

    return response()->json(['status' => 'success']);
}
}



