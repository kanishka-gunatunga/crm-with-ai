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
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class ProductsController extends Controller
{
    public function products(Request $request)
{
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
}

    public function create_product(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('products.create_product');
        }
        if($request->isMethod('post')){

            $request->validate([
                'name' => 'required|string|max:255',
                'sku' => 'required|string',
                'quantity' => 'required',
                'cost' => 'required',
            ]);

            $product = new Product();
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->quantity = $request->quantity;
            $product->cost = $request->cost;
            $product->description = $request->description;
            $product->save();
    
            return redirect()->back()->with('success', 'Product created successfully!');
        }
    }
    public function delete_product($id,Request $request)
    {
        if($request('get')){
            Product::where('id',$id)->delete();
            return redirect()->back()->with('success', 'Product deleted successfully!');
         }
    }
    public function edit_product($id, Request $request)
{
    $product = Product::findOrFail($id);

    if ($request->isMethod('get')) {
        return view('products.edit_product', ['product' => $product]);
    }
    if ($request->isMethod('post')) {
        $request->validate([
            'name' => 'required|string|max:255',
            'emails.*' => 'required|email',
            'email_types.*' => 'required|in:work,home',
        ]);

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->quantity = $request->quantity;
        $product->cost = $request->cost;
        $product->description = $request->description;

        $product->update();

        return redirect()->back()->with('success', 'Product updated successfully!');
    }
}

public function delete_selected_products(Request $request)
{
    $productIds = $request->input('selected_products', []);
    
    if (!empty($productIds)) {
        Product::whereIn('id', $productIds)->delete();
        return back()->with('success', 'Selected products deleted successfully.');
    }

    return back()->with('error', 'No products selected.');
    
}
}



