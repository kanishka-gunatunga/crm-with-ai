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
            if ($user->role == 3) {
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
        $lead = Lead::where('id', $id)->first();

        if ($request->isMethod('get')) {
            $lead_products = LeadProduct::where('lead_id', $id)->get();
            $products = Product::get();
            $services = Service::get();
            $authenticatedUser = Auth::user()->userDetails;
            $persons = Person::where('id', $lead->person)->first() ?? [];
            return view('quotes.create_lead_quote', ['lead' => $lead, 'products' => $products, 'authenticatedUser' => $authenticatedUser, 'services' => $services, 'lead_products' => $lead_products, 'persons' => $persons]);
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
    }
    public function delete_quote($id, Request $request)
    {
        if ($request->isMethod('get')) {

            Quote::where('id', $id)->delete();
            QuoteProduct::where('quote_id', $id)->delete();
            return redirect()->back()->with('success', 'Quote deleted successfully!');
        }
    }

    public function create_quote(Request $request)
    {

        if ($request->isMethod('get')) {
            $owners = UserDetails::with('user')->get();
            // $owners2 = User::get();
            $persons = Person::get();
            $products = Product::get();
            $leads = Lead::get();
            $services = Service::get();
            $authenticatedUser = Auth::user()->userDetails;
            return view('quotes.create_quote', ['owners' => $owners, 'authenticatedUser' => $authenticatedUser, 'persons' => $persons, 'products' => $products, 'leads' => $leads, 'services' => $services]);
        }
        if ($request->isMethod('post')) {

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
    }

    public function edit_quote($id, Request $request)
    {
        $quote = Quote::where('id', $id)->first();

        if ($request->isMethod('get')) {
            $owners = UserDetails::get();
            $persons = Person::get();
            $products = Product::get();
            $leads = Lead::get();
            $quote_products = QuoteProduct::where('quote_id', $id)->get();
            $services = Service::get();
            return view('quotes.edit_quote', [
                'owners' => $owners,
                'persons' => $persons,
                'products' => $products,
                'leads' => $leads,
                'quote_products' => $quote_products,
                'quote' => $quote,
                'services' => $services
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
    }
    public function delete_selected_quotes(Request $request)
    {
        $quoteIds = $request->input('selected_quotes', []);

        if (!empty($quoteIds)) {
            Quote::whereIn('id', $quoteIds)->delete();
            QuoteProduct::whereIn('quote_id', $quoteIds)->delete();
            return back()->with('success', 'Selected quotes deleted successfully.');
        }

        return back()->with('error', 'No quotes selected.');
    }


    public function getLeads(Request $request)
    {
        $role   = $request->input('role');
        $userId = $request->input('user_id');
        $salesOwnerId = $request->input('sales_owner_id');

        if ($role == 3) {
            // Role 3: show only logged user's leads
            $leads = Lead::where('sales_owner', $userId)->get(['id', 'title']);
        } elseif ($role == 2) {
            // Role 2: show leads based on selected sales_owner
            $leads = Lead::where('sales_owner', $salesOwnerId)->get(['id', 'title']);
        } else {
            $leads = collect(); // return empty if role not matched
        }

        return response()->json($leads);
    }
}
