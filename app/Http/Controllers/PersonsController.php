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
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\OtherUserDetails;
use App\Models\Pipeline;
use App\Models\PipelineStage;
use App\Models\Source;
use App\Models\Type;
use App\Models\Person;
use App\Models\Organization;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class PersonsController extends Controller
{
    public function persons(Request $request)
{
    if ($request->isMethod('get')) {
        $query = Person::query();

        if ($request->has('id') && $request->get('id') != '') {
            $query->where('id', $request->get('id'));
        }

        if ($request->has('name') && $request->get('name') != '') {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->has('email') && $request->get('email') != '') {
            $query->whereJsonContains('emails->value', $request->get('email'));
        }

        if ($request->has('contact_number') && $request->get('contact_number') != '') {
            $query->whereJsonContains('contact_numbers->value', $request->get('contact_number'));
        }

        if ($request->has('organization') && $request->get('organization') != '') {
            $query->where('organization', $request->get('organization'));
        }
        $persons = $query->get();
        $organizations = Organization::all();

        return view('contacts.persons.persons', [
            'persons' => $persons,
            'organizations' => $organizations,
            'filters' => $request->all() 
        ]);
    }
}

    public function create_person(Request $request)
    {
        if ($request->isMethod('get')) {
            $organizations = Organization::get();
            return view('contacts.persons.create_person', ['organizations' => $organizations]);
        }
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|string|max:255',
                'emails.*' => 'required|email',
                'contact_numbers.*' => 'required|string',
                'email_types.*' => 'required|in:work,home',
                'number_types.*' => 'required|in:work,home',
            ]);
            $file_name = null;
            if($request->picture){
            $file_name = time().'-.'.$request->picture->extension();
            $request->picture->move(public_path('uploads/persons/pictures'), $file_name);
            }

            $person = new Person();
            $person->name = $request->name;
            $person->dob = $request->dob;
            $person->organization = $request->organization;
            $person->picture = $file_name;
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
    
            return redirect()->back()->with('success', 'Person created successfully!');
        }
    }
    public function delete_person($id,Request $request)
    {
        if($request->isMethod('get')){
            Person::where('id',$id)->delete();
            return redirect()->back()->with('success', 'Person deleted successfully!');
         }
    }
    public function edit_person($id, Request $request)
{
    $person = Person::findOrFail($id);

    if ($request->isMethod('get')) {
        $organizations = Organization::get();
        return view('contacts.persons.edit_person', ['person' => $person,'organizations' => $organizations]);
    }
    if ($request->isMethod('post')) {
        $request->validate([
            'name' => 'required|string|max:255',
            'emails.*' => 'required|email',
            'contact_numbers.*' => 'required|string',
            'email_types.*' => 'required|in:work,home',
            'number_types.*' => 'required|in:work,home',
        ]);
        $file_name =$person->picture;
        if($request->picture){
        $file_name = time().'-.'.$request->picture->extension();
        $request->picture->move(public_path('uploads/persons/pictures'), $file_name);
        }
        $person->name = $request->name;
        $person->organization = $request->organization;
        $person->dob = $request->dob;
        $person->picture = $file_name;
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

        $person->save();

        return redirect()->back()->with('success', 'Person updated successfully!');
    }
}
public function delete_selected_persons(Request $request)
{
    $personIds = $request->input('selected_persons', []);
    
    if (!empty($personIds)) {
        Person::whereIn('id', $personIds)->delete();
        return back()->with('success', 'Selected persons deleted successfully.');
    }

    return back()->with('error', 'No persons selected.');
    
}
public function import_persons(Request $request)
{
    if ($request->isMethod('post')) {

        $request->validate([
            'persons' => 'required|mimes:xls,xlsx,csv',
        ]);

        $data = Excel::toArray([], $request->file('persons'));

        $rows = $data[0]; 
        $header = array_shift($rows);

        foreach ($rows as $row) {

            if (empty(array_filter($row))) {
                continue;
            }
            $record = array_combine($header, $row);

            if(!Person::where("name", $record['Name'])->whereJsonContains("emails->value", $record['Email'])
            ->whereJsonContains("contact_numbers->value", $record['Number'])->exists()){
                $emails = [];
                $contactNumbers = [];

                $person = new Person();
                $person->name = $record['Name'] ?? null;
                $emails[] = [ 
                    'value' => $record['Email'],
                    'label' => 'work'
                ];
                $contactNumbers[] = [
                    'value' => $record['Number'],
                    'label' => 'work'
                ];
                $person->emails = $emails;
                $person->contact_numbers =$contactNumbers;
                $person->save();
           
            }
            
        }

        return back()->with('success', 'Persons Successfully Imported');
    }
}
}



