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
use App\Models\Service;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class ServicesController extends Controller
{

    public function services(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('show-services'), array_map('strtolower', $permissions))) {
            $query = Service::query();


            if ($request->has('name') && $request->name) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            $services = $query->get();

            return view('services.services', [
                'services' => $services,
                'request' => $request->all()
            ]);
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }

    public function create_service(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('create-services'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {
                return view('services.create_service');
            }
            if ($request->isMethod('post')) {

                $request->validate([
                    'name' => 'required|string|max:255',
                    'cost' => 'required',
                ]);

                $service = new Service();
                $service->name = $request->name;
                $service->cost = $request->cost;
                $service->description = $request->description;
                $service->save();

                return redirect()->back()->with('success', 'Service created successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function delete_service($id, Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-services'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {
                Service::where('id', $id)->delete();
                return redirect()->back()->with('success', 'Service deleted successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function edit_service($id, Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('edit-services'), array_map('strtolower', $permissions))) {
            $service = Service::findOrFail($id);

            if ($request->isMethod('get')) {
                return view('services.edit_service', ['service' => $service]);
            }
            if ($request->isMethod('post')) {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'cost' => 'required',
                ]);

                $service->name = $request->name;
                $service->cost = $request->cost;
                $service->description = $request->description;

                $service->update();

                return redirect()->back()->with('success', 'Service updated successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }

    public function delete_selected_services(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-services'), array_map('strtolower', $permissions))) {
            $serviceIds = $request->input('selected_services', []);

            if (!empty($serviceIds)) {
                Service::whereIn('id', $serviceIds)->delete();
                return back()->with('success', 'Selected services deleted successfully.');
            }

            return back()->with('error', 'No services selected.');
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
}
