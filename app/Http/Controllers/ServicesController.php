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
    $query = Service::query();


        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $services = $query->get();

        return view('services.services', [
            'services' => $services,
            'request' => $request->all()
        ]);
}

    public function create_service(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('services.create_service');
        }
        if($request->isMethod('post')){

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
    }
    public function delete_service($id,Request $request)
    {
        if($request('get')){
            Service::where('id',$id)->delete();
            return redirect()->back()->with('success', 'Service deleted successfully!');
         }
    }
    public function edit_service($id, Request $request)
{
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
}

public function delete_selected_services(Request $request)
{
    $serviceIds = $request->input('selected_services', []);
    
    if (!empty($serviceIds)) {
        Service::whereIn('id', $serviceIds)->delete();
        return back()->with('success', 'Selected services deleted successfully.');
    }

    return back()->with('error', 'No services selected.');
    
}
}



