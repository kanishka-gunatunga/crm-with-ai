<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Lead;
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

        $permissions = session('user_permissions', []);

        if (in_array(strtolower('show-persons'), array_map('strtolower', $permissions))) {
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
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }

    public function create_person(Request $request)
    {

        $permissions = session('user_permissions', []);

        if (in_array(strtolower('create-persons'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {
                $organizations = Organization::get();
                $personAttributes = Attribute::where('entity_type', 'person')->get();
                return view('contacts.persons.create_person', ['organizations' => $organizations, 'personAttributes' => $personAttributes]);
            }
            if ($request->isMethod('post')) {
                
                $request->validate([
                    'name' => 'required|string|max:255',
                    'emails.*' => 'required|email',
                    'contact_numbers.*' => 'required|string',
                    'email_types.*' => 'required|in:work,home',
                    'number_types.*' => 'required|in:work,home',
                ]);

                $personAttributes = Attribute::where('entity_type', 'person')->get();
                $attributeData = [];

                foreach ($personAttributes as $attribute) {
                    $attributeData[$attribute->name] = $request->input($attribute->name);
                }
                $file_name = null;
                if ($request->picture) {
                    $file_name = time() . '-.' . $request->picture->extension();
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

                    $person->contact_numbers = $contactNumbers;
                }

                $person->custom_attributes = json_encode($attributeData);

                $person->save();

                return redirect()->back()->with('success', 'Person created successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    // public function delete_person($id,Request $request)
    // {
    //     if($request->isMethod('get')){
    //         Person::where('id',$id)->delete();
    //         return redirect()->back()->with('success', 'Person deleted successfully!');
    //     }
    // }

    public function deleteAndAssign($personToDeleteId, $personToAssignId)
    {

        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-persons'), array_map('strtolower', $permissions))) {

            // dd('Functionality to delete person with ID ' . $personToDeleteId . ' and reassign responsibilities to person with ID ' . $personToAssignId . ' is not yet implemented.');

            Lead::where('person', $personToDeleteId)
                ->update(['person' => $personToAssignId]);

            // Delete the old person
            Person::where('id', $personToDeleteId)->delete();

            return redirect()->back()->with('success', 'Person deleted and reassigned successfully!');
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }




    public function edit_person($id, Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('edit-persons'), array_map('strtolower', $permissions))) {
            $person = Person::findOrFail($id);

            if ($request->isMethod('get')) {
                $organizations = Organization::get();
                $personAttributes = Attribute::where('entity_type', 'person')->get();
                // Decode saved JSON data (if any)
                $customValues = json_decode($person->custom_attributes, true) ?? [];
                return view('contacts.persons.edit_person', ['person' => $person, 'organizations' => $organizations, 'personAttributes' => $personAttributes, 'customValues' => $customValues]);
            }
            if ($request->isMethod('post')) {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'emails.*' => 'required|email',
                    'contact_numbers.*' => 'required|string',
                    'email_types.*' => 'required|in:work,home',
                    'number_types.*' => 'required|in:work,home',
                ]);
                $file_name = $person->picture;
                if ($request->picture) {
                    $file_name = time() . '-.' . $request->picture->extension();
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

                $personAttributes = Attribute::where('entity_type', 'person')->get();

                // Gather dynamic field values again
                $attributeData = [];
                foreach ($personAttributes as $attribute) {
                    $attributeData[$attribute->name] = $request->input($attribute->name);
                }

                $person->custom_attributes = json_encode($attributeData);

                $person->save();

                return redirect()->back()->with('success', 'Person updated successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function delete_selected_persons(Request $request)
    {

        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-persons'), array_map('strtolower', $permissions))) {
            $personIds = $request->input('selected_persons', []);

            if (!empty($personIds)) {
                Person::whereIn('id', $personIds)->delete();
                return back()->with('success', 'Selected persons deleted successfully.');
            }

            return back()->with('error', 'No persons selected.');
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function import_persons(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('import-persons'), array_map('strtolower', $permissions))) {
            $request->validate([
                'persons' => 'required|mimes:xls,xlsx,csv',
            ]);

            $data = Excel::toArray([], $request->file('persons'));
            $rows = $data[0] ?? [];

            if (empty($rows)) {
                return back()->with('error', 'Empty file');
            }

            $header = array_map('trim', $rows[0]); // first row: Name, Email, Number
            array_shift($rows); // remove header

            $seen = []; // track duplicates inside file
            $inserted = 0;
            $skipped = 0;

            foreach ($rows as $row) {
                if (empty(array_filter($row))) continue;

                $record = array_combine($header, $row);

                $name = trim($record['Name'] ?? '');
                $email = strtolower(trim($record['Email'] ?? ''));
                $number = preg_replace('/\D+/', '', $record['Number'] ?? ''); // keep only digits

                if (!$email || !$number) {
                    $skipped++;
                    continue;
                }

                // dedupe inside the uploaded file
                $fileKey = $email . '|' . $number;
                if (isset($seen[$fileKey])) {
                    $skipped++;
                    continue;
                }
                $seen[$fileKey] = true;

                // check DB if already exists
                $exists = Person::whereRaw("JSON_SEARCH(emails, 'one', ?, NULL, '$[*].value') IS NOT NULL", [$email])
                    ->whereRaw("JSON_SEARCH(contact_numbers, 'one', ?, NULL, '$[*].value') IS NOT NULL", [$number])
                    ->exists();

                if ($exists) {
                    $skipped++;
                    continue;
                }

                // create person
                $person = new Person();
                $person->name = $name;
                $person->emails = [['value' => $email, 'label' => 'work']];
                $person->contact_numbers = [['value' => $number, 'label' => 'work']];
                $person->save();

                $inserted++;
            }

            return back()->with('success', "Imported: $inserted, Skipped: $skipped");
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
}
