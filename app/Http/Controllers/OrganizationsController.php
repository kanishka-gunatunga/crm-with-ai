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

class OrganizationsController extends Controller
{
    public function organizations(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('show-organizations'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {
                $query = Organization::query();

                if ($request->has('id') && $request->id) {
                    $query->where('id', $request->id);
                }

                if ($request->has('name') && $request->name) {
                    $query->where('name', 'like', '%' . $request->name . '%');
                }

                if ($request->has('created_start_date') && $request->created_start_date) {
                    $query->where('created_at', '>=', $request->created_start_date);
                }

                if ($request->has('created_end_date') && $request->created_end_date) {
                    $query->where('created_at', '<=', $request->created_end_date);
                }

                $organizations = $query->get();

                return view('contacts.organizations.organizations', [
                    'organizations' => $organizations,
                    'request' => $request->all()
                ]);
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }

    public function create_organization(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('create-organizations'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {
                return view('contacts.organizations.create_organization');
            }
            if ($request->isMethod('post')) {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'emails.*' => 'required|email',
                    'email_types.*' => 'required|in:work,home',
                ]);

                $organization = new Organization();
                $organization->name = $request->name;
                $organization->address = $request->address;
                $organization->country = $request->country;
                $organization->state = $request->state;
                $organization->city = $request->city;
                $organization->post_code = $request->post_code;

                if ($request->has('emails')) {
                    $emails = [];
                    foreach ($request->input('emails') as $key => $email) {
                        $emailType = $request->input("email_types.{$key}");

                        $emails[] = [
                            'value' => $email,
                            'label' => $emailType
                        ];
                    }

                    $organization->emails = $emails;
                }

                $organization->save();

                return redirect()->back()->with('success', 'Organization created successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function delete_person($id, Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-organizations'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {
                Organization::where('id', $id)->delete();
                return redirect()->back()->with('success', 'Organization deleted successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function edit_organization($id, Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('edit-organizations'), array_map('strtolower', $permissions))) {
            $organization = Organization::findOrFail($id);

            if ($request->isMethod('get')) {
                return view('contacts.organizations.edit_organization', ['organization' => $organization]);
            }
            if ($request->isMethod('post')) {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'emails.*' => 'required|email',
                    'email_types.*' => 'required|in:work,home',
                ]);

                $organization->name = $request->name;
                $organization->address = $request->address;
                $organization->country = $request->country;
                $organization->state = $request->state;
                $organization->city = $request->city;
                $organization->post_code = $request->post_code;

                if ($request->has('emails')) {
                    $emails = [];
                    foreach ($request->input('emails') as $key => $email) {
                        $emailType = $request->input("email_types.{$key}");
                        $emails[] = [
                            'value' => $email,
                            'label' => $emailType
                        ];
                    }
                    $organization->emails = $emails;
                }


                $organization->save();

                return redirect()->back()->with('success', 'Organization updated successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }

    public function delete_selected_organizations(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-organizations'), array_map('strtolower', $permissions))) {
            $organizationIds = $request->input('selected_organizations', []);

            if (!empty($organizationIds)) {
                Organization::whereIn('id', $organizationIds)->delete();
                return back()->with('success', 'Selected organizations deleted successfully.');
            }

            return back()->with('error', 'No organizations selected.');
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function import_organizations(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('import-organizations'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('post')) {

                $request->validate([
                    'organizations' => 'required|mimes:xls,xlsx,csv',
                ]);

                $data = Excel::toArray([], $request->file('organizations'));
                $rows = $data[0] ?? [];
                if (empty($rows)) {
                    return back()->with('error', 'Empty file');
                }

                $header = array_map('trim', $rows[0]); // normalize headers
                array_shift($rows); // remove header

                $seen = [];
                $inserted = 0;
                $skipped = 0;

                foreach ($rows as $row) {
                    if (empty(array_filter($row))) continue;

                    $record = array_combine($header, $row);

                    $name = trim($record['Name'] ?? '');
                    $address = trim($record['Address'] ?? '');
                    $country = trim($record['Country'] ?? '');
                    $state = trim($record['State'] ?? '');
                    $city = trim($record['City'] ?? '');
                    $postCode = trim($record['Post Code'] ?? '');
                    $rawEmails = trim($record['Emails'] ?? '');

                    if (!$name || !$rawEmails) {
                        $skipped++;
                        continue;
                    }

                    // split multiple emails by comma
                    $emailList = array_filter(array_map(fn($e) => strtolower(trim($e)), explode(',', $rawEmails)));

                    if (empty($emailList)) {
                        $skipped++;
                        continue;
                    }

                    // dedupe inside the file (use first email for key)
                    $fileKey = $name . '|' . implode(',', $emailList);
                    if (isset($seen[$fileKey])) {
                        $skipped++;
                        continue;
                    }
                    $seen[$fileKey] = true;

                    // check in DB if same name + any of these emails exist
                    $exists = Organization::where('name', $name)
                        ->where(function ($q) use ($emailList) {
                            foreach ($emailList as $email) {
                                $q->orWhereRaw("JSON_SEARCH(emails, 'one', ?, NULL, '$[*].value') IS NOT NULL", [$email]);
                            }
                        })
                        ->exists();

                    if ($exists) {
                        $skipped++;
                        continue;
                    }

                    // format emails
                    $emails = [];
                    foreach ($emailList as $email) {
                        $emails[] = [
                            'value' => $email,
                            'label' => 'work'
                        ];
                    }

                    // save organization
                    $org = new Organization();
                    $org->name = $name;
                    $org->address = $address;
                    $org->country = $country;
                    $org->state = $state;
                    $org->city = $city;
                    $org->post_code = $postCode;
                    $org->emails = $emails;
                    $org->save();

                    $inserted++;
                }

                return back()->with('success', "Imported: $inserted, Skipped: $skipped");
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
}
