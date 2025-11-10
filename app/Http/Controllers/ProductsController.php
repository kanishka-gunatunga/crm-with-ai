<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
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
                return view('products.create_product', ['productAttributes' => $productAttributes]);
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
                    $attributeData[$attribute->name] = $request->input($attribute->name);
                }

                $product = new Product();
                $product->name = $request->name;
                $product->sku = $request->sku;
                $product->quantity = $request->quantity;
                $product->cost = $request->cost;
                $product->description = $request->description;
                $product->custom_attributes = json_encode($attributeData);
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
                $customValues = json_decode($product->custom_attributes, true) ?? [];
                return view('products.edit_product', ['product' => $product, 'productAttributes' => $productAttributes, 'customValues' => $customValues]);
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
                    $attributeData[$attribute->name] = $request->input($attribute->name);
                }

                $product->name = $request->name;
                $product->sku = $request->sku;
                $product->quantity = $request->quantity;
                $product->cost = $request->cost;
                $product->description = $request->description;
                $product->custom_attributes = json_encode($attributeData);
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
