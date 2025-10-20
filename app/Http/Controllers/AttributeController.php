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
use App\Models\Attribute;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class AttributeController extends Controller
{
    public function attributes(Request $request)
    {
        if ($request->isMethod('get')) {

            $query = Attribute::query();

            if ($request->filled('id')) {
                $query->where('id', $request->id);
            }

            if ($request->filled('code')) {
                $query->where('code', 'like', '%' . $request->code . '%');
            }

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->filled('entity_type')) {
                $query->where('entity_type', 'like', '%' . $request->entity_type . '%');
            }

            if ($request->filled('type')) {
                $query->where('type', 'like', '%' . $request->type . '%');
            }

            $attributes = $query->get();

            return view('settings.attributes.attributes', [
                'attributes' => $attributes,
                'request' => $request->all()
            ]);
        }
    }

    public function create_attribute(Request $request)
    {

        $permissions = session('user_permissions', []);

        if (in_array(strtolower('create-attributes'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {

                return view('settings.attributes.create_attribute');
            }
            if ($request->isMethod('post')) {

                $validated = $request->validate([
                    'code' => 'required|string|max:255|unique:attributes,code',
                    'name' => 'required|string|max:255',
                    'entity_type' => 'required|string',
                    'type' => 'required|string',
                    'is_required' => 'required|string',
                    'is_unique' => 'required|string',

                ]);

                $attribute = new Attribute();
                $attribute->code = $request->code;
                $attribute->name = $request->name;
                $attribute->entity_type = $request->entity_type;
                $attribute->type = $request->type;
                $attribute->is_required = $request->is_required;
                $attribute->is_unique = $request->is_unique;
                $attribute->input_validation = $request->input_validation;
                $attribute->option_type = $request->option_type;
                $attribute->lookup_type = $request->lookup_type;
                $attribute->options = $request->options;
                $attribute->save();

                return redirect()->back()->with('success', 'Attribute created successfully!');
            }
        } else {

            abort(403, 'Unauthorized');
        }
    }
    public function delete_attribute($id, Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-attributes'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {
                Attribute::where('id', $id)->delete();
                return redirect()->back()->with('success', 'Attribute deleted successfully!');
            }
        } else {

            abort(403, 'Unauthorized');
        }
    }
    public function edit_attribute($id, Request $request)
    {

        $permissions = session('user_permissions', []);

        if (in_array(strtolower('edit-attributes'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {
                $attribute = Attribute::where('id', $id)->first();
                return view('settings.attributes.edit_attribute', ['attribute' => $attribute]);
            }

            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'entity_type' => 'required|string',
                    'type' => 'required|string',
                    'is_required' => 'required|string',
                    'is_unique' => 'required|string',

                ]);


                $attribute =  Attribute::where('id', $id)->first();;
                $attribute->name = $request->name;
                $attribute->entity_type = $request->entity_type;
                $attribute->type = $request->type;
                $attribute->is_required = $request->is_required;
                $attribute->is_unique = $request->is_unique;
                $attribute->input_validation = $request->input_validation;
                $attribute->option_type = $request->option_type;
                $attribute->lookup_type = $request->lookup_type;
                $attribute->options = $request->options;
                $attribute->update();

                return redirect()->back()->with('success', 'Attribute updated successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function delete_selected_attributes(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-attributes'), array_map('strtolower', $permissions))) {
            $attributeIds = $request->input('selected_attributes', []);

            if (!empty($attributeIds)) {
                Attribute::whereIn('id', $attributeIds)->delete();
                return back()->with('success', 'Selected attributes deleted successfully.');
            }

            return back()->with('error', 'No attributes selected.');
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
}
