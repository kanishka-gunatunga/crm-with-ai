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
use App\Models\User;
use App\Models\OtherUserDetails;
use App\Models\Pipeline;
use App\Models\PipelineStage;
use App\Models\Source;
use App\Models\Type;
use App\Models\Person;
use App\Models\Organization;
use App\Models\Product;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class ProductsController extends Controller
{
    public function products(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('show-products'), array_map('strtolower', $permissions))) {
            $query = Product::query();

            if ($request->has('sku') && $request->sku) {
                $query->where('sku', $request->sku);
            }

            if ($request->has('name') && $request->name) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            $products = $query->get();

            return view('products.products', [
                'products' => $products,
                'request' => $request->all()
            ]);
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }

    public function create_product(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('create-products'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {
                $productAttributes = Attribute::where('entity_type', 'product')->get();
                $lookupOptions = [];
                foreach ($productAttributes as $attribute) {
                    if (trim(strtolower($attribute->type)) === 'lookup') {
                        switch (trim(strtolower($attribute->lookup_type))) {
                            case 'leads':
                                $lookupOptions[$attribute->code] = Lead::pluck('title', 'id');
                                break;
                            case 'lead_sources':
                                $lookupOptions[$attribute->code] = Source::pluck('name', 'id');
                                break;
                            case 'lead_types':
                                $lookupOptions[$attribute->code] = Type::pluck('name', 'id');
                                break;
                            case 'lead_pipelines':
                                $lookupOptions[$attribute->code] = Pipeline::pluck('name', 'id');
                                break;
                            case 'lead_pipeline_stages':
                                $lookupOptions[$attribute->code] = PipelineStage::pluck('name', 'id');
                                break;
                            case 'users':
                                $lookupOptions[$attribute->code] = User::with('userDetails')
                                    ->get()
                                    ->pluck('userDetails.name', 'id');
                                break;
                            case 'organizations':
                                $lookupOptions[$attribute->code] = Organization::pluck('name', 'id');
                                break;
                            case 'persons':
                                $lookupOptions[$attribute->code] = Person::pluck('name', 'id');
                                break;
                            default:
                                $lookupOptions[$attribute->code] = collect();
                                break;
                        }
                    }
                }

                return view(
                    'products.create_product',
                    [
                        'productAttributes' => $productAttributes,
                        'lookupOptions' => $lookupOptions,
                    ]
                );
            }
            if ($request->isMethod('post')) {

                $request->validate([
                    'name' => 'required|string|max:255',
                    'sku' => 'required|string',
                    'quantity' => 'required',
                    'cost' => 'required',
                ]);

                $productAttributes = Attribute::where('entity_type', 'product')->get();
                $attributeData = [];

                foreach ($productAttributes as $attribute) {
                    $value = null;

                    // Handle file or image uploads
                    if (in_array($attribute->type, ['file', 'image'])) {
                        if ($request->hasFile($attribute->code)) {
                            $file = $request->file($attribute->code);

                            // Create directory if it doesn’t exist
                            $path = public_path('uploads/products/custom_attributes');
                            if (!file_exists($path)) {
                                mkdir($path, 0777, true);
                            }

                            // Create unique file name
                            $fileName = time() . '_' . $attribute->code . '.' . $file->getClientOriginalExtension();

                            // Move file to uploads directory
                            $file->move($path, $fileName);

                            // Store only the relative path or filename
                            $value = 'products/custom_attributes/' . $fileName;
                        }
                    }
                    // Handle checkboxes or multiselects
                    elseif (in_array($attribute->type, ['checkbox', 'multiselect'])) {
                        $value = $request->input($attribute->code) ?? [];
                    } elseif ($attribute->type == 'lookup') {
                        $selectedId = $request->input($attribute->code);

                        if ($selectedId) {
                            switch ($attribute->lookup_type) {
                                case 'leads':
                                    $value = Lead::where('id', $selectedId)->value('title');
                                    break;
                                case 'lead_sources':
                                    $value = Source::where('id', $selectedId)->value('name');
                                    break;
                                case 'lead_types':
                                    $value = Type::where('id', $selectedId)->value('name');
                                    break;
                                case 'lead_pipelines':
                                    $value = Pipeline::where('id', $selectedId)->value('name');
                                    break;
                                case 'lead_pipeline_stages':
                                    $value = PipelineStage::where('id', $selectedId)->value('name');
                                    break;
                                case 'users':
                                    $value = User::with('userDetails')->find($selectedId)?->userDetails?->name;
                                    break;
                                case 'organizations':
                                    $value = Organization::where('id', $selectedId)->value('name');
                                    break;
                                case 'persons':
                                    $value = Person::where('id', $selectedId)->value('name');
                                    break;
                                default:
                                    $value = null;
                                    break;
                            }
                        }
                    }
                    // Handle all other types (text, email, number, select, etc.)
                    else {
                        $value = $request->input($attribute->code);
                    }


                    $attributeData[$attribute->name] = $value;
                }

                $product = new Product();
                $product->name = $request->name;
                $product->sku = $request->sku;
                $product->quantity = $request->quantity;
                $product->cost = $request->cost;
                $product->description = $request->description;
                $product->custom_attributes = $attributeData;
                $product->save();

                return redirect()->back()->with('success', 'Product created successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function delete_product($id, Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-products'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {
                Product::where('id', $id)->delete();
                return redirect()->back()->with('success', 'Product deleted successfully!');
            }

            return redirect()->back();
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function edit_product($id, Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('edit-products'), array_map('strtolower', $permissions))) {
            $product = Product::findOrFail($id);

            if ($request->isMethod('get')) {
                $productAttributes = Attribute::where('entity_type', 'product')->get();
                // Decode saved JSON data (if any)
                $customValues = is_array($product->custom_attributes)
                    ? $product->custom_attributes
                    : (json_decode($product->custom_attributes, true) ?? []);
                $lookupOptions = [];
                foreach ($productAttributes as $attribute) {
                    if (trim(strtolower($attribute->type)) === 'lookup') {
                        switch (trim(strtolower($attribute->lookup_type))) {
                            case 'leads':
                                $lookupOptions[$attribute->code] = Lead::pluck('title', 'id');
                                break;
                            case 'lead_sources':
                                $lookupOptions[$attribute->code] = Source::pluck('name', 'id');
                                break;
                            case 'lead_types':
                                $lookupOptions[$attribute->code] = Type::pluck('name', 'id');
                                break;
                            case 'lead_pipelines':
                                $lookupOptions[$attribute->code] = Pipeline::pluck('name', 'id');
                                break;
                            case 'lead_pipeline_stages':
                                $lookupOptions[$attribute->code] = PipelineStage::pluck('name', 'id');
                                break;
                            case 'users':
                                $lookupOptions[$attribute->code] = User::with('userDetails')
                                    ->get()
                                    ->pluck('userDetails.name', 'id');
                                break;
                            case 'organizations':
                                $lookupOptions[$attribute->code] = Organization::pluck('name', 'id');
                                break;
                            case 'persons':
                                $lookupOptions[$attribute->code] = Person::pluck('name', 'id');
                                break;
                            default:
                                $lookupOptions[$attribute->code] = collect();
                                break;
                        }
                    }
                }
                return view('products.edit_product', [
                    'product' => $product,
                    'productAttributes' => $productAttributes,
                    'customValues' => $customValues,
                    'lookupOptions' => $lookupOptions,
                ]);
            }
            if ($request->isMethod('post')) {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'emails.*' => 'required|email',
                    'email_types.*' => 'required|in:work,home',
                ]);

                $productAttributes = Attribute::where('entity_type', 'product')->get();

                // Gather dynamic field values again
                $attributeData = [];
                foreach ($productAttributes as $attribute) {
                    $value = null;

                    // Handle file or image uploads
                    if (in_array($attribute->type, ['file', 'image'])) {
                        if ($request->hasFile($attribute->code)) {
                            $file = $request->file($attribute->code);

                            // Create directory if it doesn’t exist
                            $path = public_path('uploads/products/custom_attributes');
                            if (!file_exists($path)) {
                                mkdir($path, 0777, true);
                            }

                            // Create unique file name
                            $fileName = time() . '_' . $attribute->code . '.' . $file->getClientOriginalExtension();

                            // Move file to uploads directory
                            $file->move($path, $fileName);

                            // Store only the relative path or filename
                            $value = 'products/custom_attributes/' . $fileName;
                        }
                    }
                    // Handle checkboxes or multiselects
                    elseif (in_array($attribute->type, ['checkbox', 'multiselect'])) {
                        $value = $request->input($attribute->code) ?? [];
                    } elseif ($attribute->type == 'lookup') {
                        $selectedId = $request->input($attribute->code);

                        if ($selectedId) {
                            switch ($attribute->lookup_type) {
                                case 'leads':
                                    $value = Lead::where('id', $selectedId)->value('title');
                                    break;
                                case 'lead_sources':
                                    $value = Source::where('id', $selectedId)->value('name');
                                    break;
                                case 'lead_types':
                                    $value = Type::where('id', $selectedId)->value('name');
                                    break;
                                case 'lead_pipelines':
                                    $value = Pipeline::where('id', $selectedId)->value('name');
                                    break;
                                case 'lead_pipeline_stages':
                                    $value = PipelineStage::where('id', $selectedId)->value('name');
                                    break;
                                case 'users':
                                    $value = User::with('userDetails')->find($selectedId)?->userDetails?->name;
                                    break;
                                case 'organizations':
                                    $value = Organization::where('id', $selectedId)->value('name');
                                    break;
                                case 'persons':
                                    $value = Person::where('id', $selectedId)->value('name');
                                    break;
                                default:
                                    $value = null;
                                    break;
                            }
                        }
                    }
                    // Handle all other types (text, email, number, select, etc.)
                    else {
                        $value = $request->input($attribute->code);
                    }


                    $attributeData[$attribute->name] = $value;
                }

                $product->name = $request->name;
                $product->sku = $request->sku;
                $product->quantity = $request->quantity;
                $product->cost = $request->cost;
                $product->description = $request->description;
                $product->custom_attributes = $attributeData;
                $product->update();

                return redirect()->back()->with('success', 'Product updated successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }

    public function delete_selected_products(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-products'), array_map('strtolower', $permissions))) {
            $productIds = $request->input('selected_products', []);

            if (!empty($productIds)) {
                Product::whereIn('id', $productIds)->delete();
                return back()->with('success', 'Selected products deleted successfully.');
            }

            return back()->with('error', 'No products selected.');
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
}
