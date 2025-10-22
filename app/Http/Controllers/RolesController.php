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
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class RolesController extends Controller
{
    public function roles(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('show-roles'), array_map('strtolower', $permissions))) {

            $query = Role::query();

            if ($request->filled('id')) {
                $query->where('id', $request->id);
            }

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->filled('permission_type')) {
                $query->where('permission_type', $request->permission_type);
            }

            $roles = $query->get();

            return view('settings.roles.roles', [
                'roles' => $roles,
                'request' => $request->all()
            ]);
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }


    public function create_role(Request $request)
    {

        $permissions = session('user_permissions', []);

        if (in_array(strtolower('create-roles'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {
                return view('settings.roles.create_role');
            }
            if ($request->isMethod('post')) {



                $request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'required',
                    'permission_type' => 'required',
                ]);

                $role = new Role();
                $role->name = $request->name;
                $role->description = $request->description;
                $role->permission_type = $request->permission_type;
                $role->permissions = $request->permissions;
                $role->save();

                return redirect()->back()->with('success', 'Role created successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function delete_role($id, Request $request)
    {

        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-roles'), array_map('strtolower', $permissions))) {
            if ($request('get')) {
                Role::where('id', $id)->delete();
                return redirect()->back()->with('success', 'Role deleted successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function edit_role($id, Request $request)
    {

        $permissions = session('user_permissions', []);

        if (in_array(strtolower('edit-roles'), array_map('strtolower', $permissions))) {
            $role = Role::findOrFail($id);

            if ($request->isMethod('get')) {
                return view('settings.roles.edit_role', ['role' => $role]);
            }
            if ($request->isMethod('post')) {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'emails.*' => 'required|email',
                    'email_types.*' => 'required|in:work,home',
                ]);

                $role->name = $request->name;
                $role->description = $request->description;
                $role->permission_type = $request->permission_type;
                $role->permissions = $request->permissions;
                $role->save();

                return redirect()->back()->with('success', 'Role updated successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }

    public function delete_selected_roles(Request $request)
    {

        $permissions = session('delete-roles', []);

        if (in_array(strtolower('show-services'), array_map('strtolower', $permissions))) {
            $roleIds = $request->input('selected_roles', []);

            if (!empty($roleIds)) {
                Role::whereIn('id', $roleIds)->delete();
                return back()->with('success', 'Selected roles deleted successfully.');
            }

            return back()->with('error', 'No attributes selected.');
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
}
