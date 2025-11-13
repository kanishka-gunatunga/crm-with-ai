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
use App\Models\UserDetails;
use App\Models\Pipeline;
use App\Models\PipelineStage;
use App\Models\Source;
use App\Models\Type;
use App\Models\Person;
use App\Models\Organization;
use App\Models\Product;
use App\Models\Lead;
use App\Models\LeadProduct;
use App\Models\LeadNote;
use App\Models\LeadActivity;
use App\Models\SentEmails;
use App\Models\LeadFile;
use App\Models\Quote;
use App\Models\QuoteProduct;
use App\Models\Service;
use App\Models\Configuration;
use App\Mail\LeadSendEmail;
use App\Models\Attribute;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class QuoteController extends Controller
{

    public function quotes(Request $request)
    {
        if ($request->isMethod('post')) {



            $core = Configuration::first();

            if (!$core) {
                $core = new Configuration();
            }

            $imag_name = $core->quote_logo;

            if ($request->hasFile('quote_logo')) {
                $image = $request->file('quote_logo');
                $imag_name = time() . '-quote-logo-.' . $image->extension();
                $image->move(public_path('uploads/'), $imag_name);
            }

            $core->terms = $request->terms;
            $core->quote_logo = $imag_name;
            $core->save();

            return redirect()->back()->with('success', 'Settings Saved');
        }

        if ($request->isMethod('get')) {
            $quotesQuery = Quote::query();


            if ($request->has('subject') && !empty($request->subject)) {
                $quotesQuery->where('subject', 'like', '%' . $request->subject . '%');
            }

            if ($request->has('owner') && !empty($request->owner)) {
                $quotesQuery->where('owner', $request->owner);
            }

            if ($request->has('person') && !empty($request->person)) {
                $quotesQuery->where('person', $request->person);
            }

            if ($request->has('expire_start_date') && !empty($request->expire_start_date)) {
                $quotesQuery->where('expired_at', '>=', $request->expire_start_date);
            }

            if ($request->has('expire_end_date') && !empty($request->expire_end_date)) {
                $quotesQuery->where('expired_at', '<=', $request->expire_end_date);
            }

            if ($request->has('created_start_date') && !empty($request->created_start_date)) {
                $quotesQuery->where('created_at', '>=', $request->created_start_date);
            }

            if ($request->has('created_end_date') && !empty($request->created_end_date)) {
                $quotesQuery->where('created_at', '<=', $request->created_end_date);
            }

            $user = Auth::user();

            $permissions = session('user_permissions');
            if (in_array(strtolower('quotes-view-own'), array_map('strtolower', $permissions))) {
                $quotesQuery->where('owner', $user->userDetails->user_id);
            }
            $quotes = $quotesQuery->get();
            $owners = UserDetails::get();
            $persons = Person::get();

            // return response()->json([$quotes]);

            return view('quotes.quotes', [
                'quotes' => $quotes,
                'owners' => $owners,
                'persons' => $persons,
                'request' => $request
            ]);



            // return response()->json([
            //     'auth_user' => $user,
            //     'quotes' => $quotes->toArray(),
            //     'owners' => $owners->toArray(),
            //     'persons' => $persons->toArray(),
            //     'filters' => $request->only([
            //         'subject', 'owner', 'person', 
            //         'expire_start_date', 'expire_end_date', 
            //         'created_start_date', 'created_end_date'
            //     ])
            // ], 200, [], JSON_PRETTY_PRINT);
        }
    }

    public function create_lead_quote($id, Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('create-quotes'), array_map('strtolower', $permissions))) {
            $lead = Lead::where('id', $id)->first();

            if ($request->isMethod('get')) {
                $lead_products = LeadProduct::where('lead_id', $id)->get();
                $products = Product::get();
                $services = Service::get();
                $authenticatedUser = Auth::user()->userDetails;
                $persons = Person::where('id', $lead->person)->first() ?? [];
                $quoteAttributes = Attribute::where('entity_type', 'quote')->get();
                $lookupOptions = [];

                foreach ($quoteAttributes as $attribute) {
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
                    } elseif (trim(strtolower($attribute->type)) === 'multiselect' && trim(strtolower($attribute->option_type)) === 'lookups') {
                        switch (trim(strtolower($attribute->lookup_type))) {
                            case 'leads':
                                $lookupOptions[$attribute->code] = Lead::pluck('title', 'id');
                                break;
                            case 'users':
                                $lookupOptions[$attribute->code] = User::with('userDetails')->get()->pluck('userDetails.name', 'id');
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
                    'quotes.create_lead_quote',
                    [
                        'lead' => $lead,
                        'products' => $products,
                        'authenticatedUser' => $authenticatedUser,
                        'services' => $services,
                        'lead_products' => $lead_products,
                        'persons' => $persons,
                        'quoteAttributes' => $quoteAttributes,
                        'lookupOptions' => $lookupOptions,
                    ]
                );
            }
            if ($request->isMethod('post')) {

                // dd($request->all());
                $request->validate([
                    'lead' => 'required|string',
                    'owner' => 'required',
                    'subject' => 'required',
                    'expired_at' => 'required',
                    // 'person' => 'required',
                    'address' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'post_code' => 'required',
                ]);


                $quoteAttributes = Attribute::where('entity_type', 'quote')->get();
                $attributeData = [];

                foreach ($quoteAttributes as $attribute) {
                    $value = null;

                    // Handle file or image uploads
                    if (in_array($attribute->type, ['file', 'image'])) {
                        if ($request->hasFile($attribute->code)) {
                            $file = $request->file($attribute->code);

                            // Create directory if it doesn’t exist
                            $path = public_path('uploads/quotes/custom_attributes');
                            if (!file_exists($path)) {
                                mkdir($path, 0777, true);
                            }

                            // Create unique file name
                            $fileName = time() . '_' . $attribute->code . '.' . $file->getClientOriginalExtension();

                            // Move file to uploads directory
                            $file->move($path, $fileName);

                            // Store only the relative path or filename
                            $value = 'quotes/custom_attributes/' . $fileName;
                        }
                    }
                    // Handle checkboxes or multiselects
                    elseif ($attribute->type === 'checkbox') {
                        $value = $request->input($attribute->code) ?? [];
                    } elseif ($attribute->type === 'multiselect') {
                        $selectedIds = $request->input($attribute->code, []);
                        if (!is_array($selectedIds)) {
                            $selectedIds = [$selectedIds];
                        }

                        $value = [];

                        if ($attribute->option_type === 'lookups' && !empty($selectedIds)) {
                            // dd($selectedIds);
                            foreach ($selectedIds as $id) {
                                switch ($attribute->lookup_type) {
                                    case 'leads':
                                        $value[] = Lead::where('id', $id)->value('title');

                                        break;
                                    case 'lead_sources':
                                        $value[] = Source::where('id', $id)->value('name');
                                        break;
                                    case 'lead_types':
                                        $value[] = Type::where('id', $id)->value('name');
                                        break;
                                    case 'lead_pipelines':
                                        $value[] = Pipeline::where('id', $id)->value('name');
                                        break;
                                    case 'lead_pipeline_stages':
                                        $value[] = PipelineStage::where('id', $id)->value('name');
                                        break;
                                    case 'users':
                                        $value[] = User::with('userDetails')->find($id)?->userDetails?->name;
                                        break;
                                    case 'organizations':
                                        $value[] = Organization::where('id', $id)->value('name');
                                        break;
                                    case 'persons':
                                        $value[] = Person::where('id', $id)->value('name');
                                        break;
                                    default:
                                        $value[] = null;
                                        break;
                                }
                            }

                            //  dd($value);

                            // remove null or empty values
                            $value = array_values(array_filter($value));
                        } else {
                            // Manual options (not lookups)
                            $value = array_values(array_filter($selectedIds, fn($v) => !empty($v)));
                        }
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

                $quote =  new Quote();
                $quote->lead = $lead->id;
                $quote->owner = $lead->sales_owner;
                $quote->subject = $request->subject;
                $quote->expired_at = $request->expired_at;
                $quote->person = $lead->person;
                $quote->description = $request->description;
                $quote->address = $request->address;
                $quote->country =  $request->country;
                $quote->state =  $request->state;
                $quote->city =  $request->city;
                $quote->post_code =  $request->post_code;
                $quote->shipping_address = $request->shipping_address;
                $quote->shipping_country =  $request->shipping_country;
                $quote->shipping_state =  $request->shipping_state;
                $quote->shipping_city =  $request->shipping_city;
                $quote->shipping_post_code =  $request->shipping_post_code;
                $quote->discount_total_amount =  $request->discount_total_amount;
                $quote->tax_total_amount =  $request->tax_total_amount;
                $quote->order_total_input =  $request->order_total_input;
                $quote->custom_attributes = $attributeData;
                $quote->save();

                if ($request->has('products')) {
                    foreach ($request->products as $index => $product_id) {

                        $values = explode('||', $product_id);
                        $type = $values[0];
                        $product = $values[1];

                        QuoteProduct::create([
                            'quote_id' => $quote->id,
                            'type' => $type,
                            'product_id' => $product,
                            'note' =>  $request->note[$index],
                            'quantity' => $request->quantity[$index],
                            'price' => $request->price[$index],
                            'amount' => $request->amount[$index],
                            'discount' => $request->discount[$index],
                            'tax' => $request->tax[$index],
                            'total' => $request->total[$index],
                        ]);
                    }
                }

                $pdf_name = 'quote-' . $quote->id . '-' . time() . '.pdf';
                $pdf = PDF::loadView('pdf.quote', ['quote' => $quote]);
                $pdf->setPaper('a4', 'portrait')->save(public_path('uploads/quotes/') . $pdf_name);

                $quote_update = Quote::where('id', $quote->id)->first();
                $quote_update->pdf =   $pdf_name;
                $quote_update->update();

                return redirect()->back()->with('success', 'Quote created successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function delete_quote($id, Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-quotes'), array_map('strtolower', $permissions))) {
            if ($request->isMethod('get')) {

                Quote::where('id', $id)->delete();
                QuoteProduct::where('quote_id', $id)->delete();
                return redirect()->back()->with('success', 'Quote deleted successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }

    public function create_quote(Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('create-quotes'), array_map('strtolower', $permissions))) {

            if ($request->isMethod('get')) {
                $owners = UserDetails::with('user')->get();
                // $owners2 = User::get();
                $persons = Person::get();
                $products = Product::get();
                $leads = Lead::get();
                $services = Service::get();
                $authenticatedUser = Auth::user()->userDetails;
                $quoteAttributes = Attribute::where('entity_type', 'quote')->get();
                $lookupOptions = [];

                foreach ($quoteAttributes as $attribute) {
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
                    } elseif (trim(strtolower($attribute->type)) === 'multiselect' && trim(strtolower($attribute->option_type)) === 'lookups') {
                        switch (trim(strtolower($attribute->lookup_type))) {
                            case 'leads':
                                $lookupOptions[$attribute->code] = Lead::pluck('title', 'id');
                                break;
                            case 'users':
                                $lookupOptions[$attribute->code] = User::with('userDetails')->get()->pluck('userDetails.name', 'id');
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
                return view('quotes.create_quote', [
                    'owners' => $owners,
                    'authenticatedUser' => $authenticatedUser,
                    'persons' => $persons,
                    'products' => $products,
                    'leads' => $leads,
                    'services' => $services,
                    'quoteAttributes' => $quoteAttributes,
                    'lookupOptions' => $lookupOptions,
                ]);
            }
            if ($request->isMethod('post')) {


                $quoteAttributes = Attribute::where('entity_type', 'quote')->get();
                $attributeData = [];

                foreach ($quoteAttributes as $attribute) {
                    $value = null;

                    // Handle file or image uploads
                    if (in_array($attribute->type, ['file', 'image'])) {
                        if ($request->hasFile($attribute->code)) {
                            $file = $request->file($attribute->code);

                            // Create directory if it doesn’t exist
                            $path = public_path('uploads/quotes/custom_attributes');
                            if (!file_exists($path)) {
                                mkdir($path, 0777, true);
                            }

                            // Create unique file name
                            $fileName = time() . '_' . $attribute->code . '.' . $file->getClientOriginalExtension();

                            // Move file to uploads directory
                            $file->move($path, $fileName);

                            // Store only the relative path or filename
                            $value = 'quotes/custom_attributes/' . $fileName;
                        }
                    }
                    // Handle checkboxes or multiselects
                    elseif ($attribute->type === 'checkbox') {
                        $value = $request->input($attribute->code) ?? [];
                    } elseif ($attribute->type === 'multiselect') {
                        $selectedIds = $request->input($attribute->code, []);
                        if (!is_array($selectedIds)) {
                            $selectedIds = [$selectedIds];
                        }

                        $value = [];

                        if ($attribute->option_type === 'lookups' && !empty($selectedIds)) {
                            // dd($selectedIds);
                            foreach ($selectedIds as $id) {
                                switch ($attribute->lookup_type) {
                                    case 'leads':
                                        $value[] = Lead::where('id', $id)->value('title');

                                        break;
                                    case 'lead_sources':
                                        $value[] = Source::where('id', $id)->value('name');
                                        break;
                                    case 'lead_types':
                                        $value[] = Type::where('id', $id)->value('name');
                                        break;
                                    case 'lead_pipelines':
                                        $value[] = Pipeline::where('id', $id)->value('name');
                                        break;
                                    case 'lead_pipeline_stages':
                                        $value[] = PipelineStage::where('id', $id)->value('name');
                                        break;
                                    case 'users':
                                        $value[] = User::with('userDetails')->find($id)?->userDetails?->name;
                                        break;
                                    case 'organizations':
                                        $value[] = Organization::where('id', $id)->value('name');
                                        break;
                                    case 'persons':
                                        $value[] = Person::where('id', $id)->value('name');
                                        break;
                                    default:
                                        $value[] = null;
                                        break;
                                }
                            }

                            //  dd($value);

                            // remove null or empty values
                            $value = array_values(array_filter($value));
                        } else {
                            // Manual options (not lookups)
                            $value = array_values(array_filter($selectedIds, fn($v) => !empty($v)));
                        }
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


                // dd($request->all());
                $request->validate([
                    'lead' => 'required',
                    'sales_owner' => 'required',
                    'subject' => 'required',
                    'expired_at' => 'required',
                    'person' => 'required',
                    'address' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'post_code' => 'required',
                ]);


                $quote =  new Quote();
                $quote->lead = $request->lead;
                $quote->owner = $request->sales_owner;
                $quote->subject = $request->subject;
                $quote->expired_at = $request->expired_at;
                $quote->person = $request->person;
                $quote->description = $request->description;
                $quote->address = $request->address;
                $quote->country =  $request->country;
                $quote->state =  $request->state;
                $quote->city =  $request->city;
                $quote->post_code =  $request->post_code;
                $quote->shipping_address = $request->shipping_address;
                $quote->shipping_country =  $request->shipping_country;
                $quote->shipping_state =  $request->shipping_state;
                $quote->shipping_city =  $request->shipping_city;
                $quote->shipping_post_code =  $request->shipping_post_code;
                $quote->discount_total_amount =  $request->discount_total_amount;
                $quote->tax_total_amount =  $request->tax_total_amount;
                $quote->order_total_input =  $request->order_total_input;
                $quote->custom_attributes = $attributeData;
                $quote->save();

                if ($request->has('products')) {
                    foreach ($request->products as $index => $product_id) {
                        $values = explode('||', $product_id);
                        $type = $values[0];
                        $product = $values[1];

                        QuoteProduct::create([
                            'quote_id' => $quote->id,
                            'type' => $type,
                            'product_id' => $product,
                            'note' =>  $request->note[$index],
                            'quantity' => $request->quantity[$index],
                            'price' => $request->price[$index],
                            'amount' => $request->amount[$index],
                            'discount' => $request->discount[$index],
                            'tax' => $request->tax[$index],
                            'total' => $request->total[$index],
                        ]);
                    }
                }

                $pdf_name = 'quote-' . $quote->id . '-' . time() . '.pdf';
                $pdf = PDF::loadView('pdf.quote', ['quote' => $quote]);
                $pdf->setPaper('a4', 'portrait')->save(public_path('uploads/quotes/') . $pdf_name);

                $quote_update = Quote::where('id', $quote->id)->first();
                $quote_update->pdf =   $pdf_name;
                $quote_update->update();

                return redirect()->back()->with('success', 'Quote created successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }

    public function edit_quote($id, Request $request)
    {
        $permissions = session('user_permissions', []);

        if (in_array(strtolower('edit-quotes'), array_map('strtolower', $permissions))) {
            $quote = Quote::where('id', $id)->with('leadData', 'personData')->first();

            if ($request->isMethod('get')) {
                $owners = UserDetails::get();
                $persons = Person::get();
                $products = Product::get();
                $leads = Lead::get();
                $quote_products = QuoteProduct::where('quote_id', $id)->get();
                $services = Service::get();

                $quoteAttributes = Attribute::where('entity_type', 'quote')->get();
                // Decode saved JSON data (if any)
                // $customValues = json_decode($quote->custom_attributes, true) ?? [];
                $customValues = is_array($quote->custom_attributes)
                    ? $quote->custom_attributes
                    : (json_decode($quote->custom_attributes, true) ?? []);
                $lookupOptions = [];

                foreach ($quoteAttributes as $attribute) {
                    if (isset($customValues[$attribute->code])) {
                        $customValues[$attribute->code] = $customValues[$attribute->code];
                    } elseif (isset($customValues[$attribute->name])) {
                        $customValues[$attribute->code] = $customValues[$attribute->name];
                    }
                }
                foreach ($quoteAttributes as $attribute) {
                    if (
                        trim(strtolower($attribute->type)) === 'lookup' ||
                        (trim(strtolower($attribute->type)) === 'multiselect' &&
                            trim(strtolower($attribute->option_type)) === 'lookups')
                    ) {

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
                return view('quotes.edit_quote', [
                    'owners' => $owners,
                    'persons' => $persons,
                    'products' => $products,
                    'leads' => $leads,
                    'quote_products' => $quote_products,
                    'quote' => $quote,
                    'services' => $services,
                    'quoteAttributes' => $quoteAttributes,
                    'customValues' => $customValues,
                    'lookupOptions' => $lookupOptions,
                ]);
            }
            if ($request->isMethod('post')) {
                $request->validate([
                    'lead' => 'required|string',
                    'owner' => 'required',
                    'subject' => 'required',
                    'expired_at' => 'required',
                    'person' => 'required',
                    'address' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'post_code' => 'required',
                ]);


                $quoteAttributes = Attribute::where('entity_type', 'quote')->get();

                // Gather dynamic field values again
                $attributeData = [];
                foreach ($quoteAttributes as $attribute) {
                    $value = null;

                    // Handle file or image uploads
                    if (in_array($attribute->type, ['file', 'image'])) {
                        if ($request->hasFile($attribute->code)) {
                            $file = $request->file($attribute->code);

                            // Create directory if it doesn’t exist
                            $path = public_path('uploads/quotes/custom_attributes');
                            if (!file_exists($path)) {
                                mkdir($path, 0777, true);
                            }

                            // Create unique file name
                            $fileName = time() . '_' . $attribute->code . '.' . $file->getClientOriginalExtension();

                            // Move file to uploads directory
                            $file->move($path, $fileName);

                            // Store only the relative path or filename
                            $value = 'quotes/custom_attributes/' . $fileName;
                        }
                    }
                    // Handle checkboxes or multiselects
                    elseif ($attribute->type === 'checkbox') {
                        $value = $request->input($attribute->code) ?? [];
                    } elseif ($attribute->type === 'multiselect') {
                        $selectedIds = $request->input($attribute->code, []);
                        if (!is_array($selectedIds)) {
                            $selectedIds = [$selectedIds];
                        }

                        $value = [];

                        if ($attribute->option_type === 'lookups' && !empty($selectedIds)) {
                            foreach ($selectedIds as $id) {
                                switch ($attribute->lookup_type) {
                                    case 'leads':
                                        $value[] = Lead::where('id', $id)->value('title');
                                        break;
                                    case 'lead_sources':
                                        $value[] = Source::where('id', $id)->value('name');
                                        break;
                                    case 'lead_types':
                                        $value[] = Type::where('id', $id)->value('name');
                                        break;
                                    case 'lead_pipelines':
                                        $value[] = Pipeline::where('id', $id)->value('name');
                                        break;
                                    case 'lead_pipeline_stages':
                                        $value[] = PipelineStage::where('id', $id)->value('name');
                                        break;
                                    case 'users':
                                        $value[] = User::with('userDetails')->find($id)?->userDetails?->name;
                                        break;
                                    case 'organizations':
                                        $value[] = Organization::where('id', $id)->value('name');
                                        break;
                                    case 'persons':
                                        $value[] = Person::where('id', $id)->value('name');
                                        break;
                                }
                            }
                            // remove nulls
                            $value = array_values(array_filter($value));
                        } else {
                            // Manual multiselect
                            $value = array_values(array_filter($selectedIds, fn($v) => !empty($v)));
                        }
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

                $quote->lead = $request->lead;
                $quote->owner = $request->owner;
                $quote->subject = $request->subject;
                $quote->expired_at = $request->expired_at;
                $quote->person = $request->person;
                $quote->description = $request->description;
                $quote->address = $request->address;
                $quote->country =  $request->country;
                $quote->state =  $request->state;
                $quote->city =  $request->city;
                $quote->post_code =  $request->post_code;
                $quote->shipping_address = $request->shipping_address;
                $quote->shipping_country =  $request->shipping_country;
                $quote->shipping_state =  $request->shipping_state;
                $quote->shipping_city =  $request->shipping_city;
                $quote->shipping_post_code =  $request->shipping_post_code;
                $quote->discount_total_amount =  $request->discount_total_amount;
                $quote->tax_total_amount =  $request->tax_total_amount;
                $quote->order_total_input =  $request->order_total_input;
                $quote->custom_attributes = $attributeData;
                $quote->update();

                QuoteProduct::where('quote_id', $id)->delete();
                if ($request->has('products')) {
                    foreach ($request->products as $index => $product_id) {
                        $values = explode('||', $product_id);
                        $type = $values[0];
                        $product = $values[1];

                        QuoteProduct::create([
                            'quote_id' => $id,
                            'type' => $type,
                            'product_id' => $product,
                            'note' =>  $request->note[$index],
                            'quantity' => $request->quantity[$index],
                            'price' => $request->price[$index],
                            'amount' => $request->amount[$index],
                            'discount' => $request->discount[$index],
                            'tax' => $request->tax[$index],
                            'total' => $request->total[$index],
                        ]);
                    }
                }

                $pdf_name = 'quote-' . $quote->id . '-' . time() . '.pdf';
                $pdf = PDF::loadView('pdf.quote', ['quote' => $quote]);
                $pdf->setPaper('a4', 'portrait')->save(public_path('uploads/quotes/') . $pdf_name);

                $quote_update = Quote::where('id', $quote->id)->first();
                $quote_update->pdf =   $pdf_name;
                $quote_update->update();

                return redirect()->back()->with('success', 'Quote updated successfully!');
            }
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }
    public function delete_selected_quotes(Request $request)
    {

        $permissions = session('user_permissions', []);

        if (in_array(strtolower('delete-quotes'), array_map('strtolower', $permissions))) {
            $quoteIds = $request->input('selected_quotes', []);

            if (!empty($quoteIds)) {
                Quote::whereIn('id', $quoteIds)->delete();
                QuoteProduct::whereIn('quote_id', $quoteIds)->delete();
                return back()->with('success', 'Selected quotes deleted successfully.');
            }

            return back()->with('error', 'No quotes selected.');
        } else {
            // Option A: Hard stop
            abort(403, 'Unauthorized');
        }
    }


    public function getLeads(Request $request)
    {
        $role   = $request->input('role');
        $userId = $request->input('user_id');
        $salesOwnerId = $request->input('sales_owner_id');


        $permissions = session('user_permissions', []);



        if (in_array(strtolower('create-own-leads'), array_map('strtolower', $permissions))) {
            //show only logged user's leads
            $leads = Lead::where('sales_owner', $userId)->get(['id', 'title']);
        } elseif (in_array(strtolower('create-any-leads'), array_map('strtolower', $permissions))) {
            // show leads based on selected sales_owner
            $leads = Lead::where('sales_owner', $salesOwnerId)->get(['id', 'title']);
        } else {
            $leads = collect(); // Empty collection if no permissions
        }

        return response()->json($leads);
    }
}
