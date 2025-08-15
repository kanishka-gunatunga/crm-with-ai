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
    }

    public function create_organization(Request $request)
    {
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
    }
    public function delete_person($id, Request $request)
    {
        if ($request->isMethod('get')) {
            Organization::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Organization deleted successfully!');
        }
    }
    public function edit_organization($id, Request $request)
    {
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
    }

    public function delete_selected_organizations(Request $request)
    {
        $organizationIds = $request->input('selected_organizations', []);

        if (!empty($organizationIds)) {
            Organization::whereIn('id', $organizationIds)->delete();
            return back()->with('success', 'Selected organizations deleted successfully.');
        }

        return back()->with('error', 'No organizations selected.');
    }
    public function import_organizations(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'organizations' => 'required|mimes:xls,xlsx,csv',
            ]);

            $data = Excel::toArray([], $request->file('organizations'));

            $rows = $data[0];
            $header = array_shift($rows);

            foreach ($rows as $row) {
                $record = array_combine($header, $row);

                // Skip if name already exists
                if (!Organization::where("name", $record['Name'])->exists()) {

                    // Process emails (comma-separated)
                    $emails = [];
                    $emailList = explode(',', $record['Emails']);
                    foreach ($emailList as $email) {
                        $emails[] = [
                            'value' => trim($email),
                            'label' => 'work'
                        ];
                    }

                    // Create new organization
                    $organization = new Organization();
                    $organization->name = $record['Name'] ?? null;
                    $organization->address = $record['Address'] ?? null;
                    $organization->country = $record['Country'] ?? null;
                    $organization->state = $record['State'] ?? null;
                    $organization->city = $record['City'] ?? null;
                    $organization->post_code = $record['Post Code'] ?? null;
                    $organization->emails = $emails;
                    $organization->save();
                }
            }

            return back()->with('success', 'Organizations Successfully Imported');
        }
    }
}
