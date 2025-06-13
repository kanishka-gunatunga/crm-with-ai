<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OtherUserDetails;
use App\Models\Pipeline;
use App\Models\PipelineStage;
use App\Models\Lead;
use App\Models\LeadActivity;
use App\Models\Person;
use App\Models\Product;
use File;
use Illuminate\Support\Facades\Crypt;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class MainController extends Controller
{
    public function index(Request $request)
    {
        if($request->isMethod('get')){
            // return view('index');
            return view('welcome');
         }
         if($request->isMethod('post')){
            $request->validate([
                'email'   => 'required',
                'password'  => 'required'
               ]);

               $user_data = array(
                'email'  => $request->get('email'),
                'status'  => "active",
                'password' => $request->get('password')
               );
               if(Auth::attempt($user_data))
               {
                return redirect('dashboard');
               }
               else
               {
                return back()->with('fail', 'Wrong Login Details');
               }
        }
    }

    function logout()
    {
     Auth::logout();
     return redirect('/');
    }

    public function dashboard(Request $request)
    {
        if($request->isMethod('get')){
            $weeklyLeads = Lead::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%u') as week"),
                DB::raw("COUNT(*) as total")
            )
            ->groupBy('week')
            ->orderBy('week', 'ASC')
            ->get();
        
        $weeks = [];
        $totals = [];

        $wonWeeks = [];
        $wonTotals = [];
        
        foreach ($weeklyLeads as $lead) {
            $weeks[] = $lead->week; 
            $totals[] = $lead->total;
        }

        foreach ($weeklyLeads as $lead) {
        if(PipelineStage::where('id',$lead->stage)->value('name') == "Won"){ 
            $wonWeeks[] = $lead->week; 
            $wonTotals[] = $lead->total;
        }
        }
        
        $customerWeeks = [];
        $customerTotals = [];

        $weeklyCustomers = Person::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%u') as week"),
            DB::raw("COUNT(*) as total")
        )
        ->groupBy('week')
        ->orderBy('week', 'ASC')
        ->get();

        foreach ($weeklyCustomers as $weeklyCustomer) {
            $customerWeeks[] = $weeklyCustomer->week; 
            $customerTotals[] = $weeklyCustomer->total;
        }


        $productWeeks = [];
        $productTotals = [];

        $weeklyProducts= Product::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%u') as week"),
            DB::raw("COUNT(*) as total")
        )
        ->groupBy('week')
        ->orderBy('week', 'ASC')
        ->get();

        foreach ($weeklyProducts as $weeklyProduct) {
            $productWeeks[] = $weeklyProduct->week; 
            $productTotals[] = $weeklyProduct->total;
        }

        

            $pipelines = Pipeline::get();
            $meetings = LeadActivity::where('type','Meeting')->get();
            $calls = LeadActivity::where('type','Call')->get();
            $lunches = LeadActivity::where('type','Lunch')->get();
            $top_leads = Lead::orderBy('lead_value','DESC')->take(3)->get();
            $all_leads = Lead::orderBy('lead_value','DESC')->get();
            $top_customers = Lead::select('person', DB::raw('COUNT(*) as lead_count'))
            ->groupBy('person')
            ->orderByDesc('lead_count')
            ->take(6)
            ->get();

            foreach( $pipelines as $pipeline) {
                $stages =   PipelineStage::where('pipeline_id', $pipeline->id)->get();
                $total_leads = 0;
                $completed_leads = 0;
                foreach($stages as $stage){
                    $total_leads = $total_leads+Lead::where('stage', $stage->id)->count();
                    if($stage->name == "Lost" || $stage->name == "Won"){
                        $completed_leads = $completed_leads+Lead::where('stage', $stage->id)->count();
                    }
                }
                $pipeline->total_leads = $total_leads;
                $pipeline->completed_leads = $completed_leads;
            }
            
            return view('dashboard', ['pipelines' => $pipelines,'meetings' => $meetings,'calls' => $calls,'lunches' => $lunches
            ,'top_leads' => $top_leads,'top_customers' => $top_customers,'weeks' => $weeks,'totals' => $totals,'wonWeeks' => $wonWeeks,'wonTotals' => $wonTotals
            ,'customerWeeks' => $customerWeeks,'customerTotals' => $customerTotals,'productWeeks' => $productWeeks,'productTotals' => $productTotals]);
         }
        
    }
    public function forgot_password(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('forgot_password');
        }
        if ($request->isMethod('post')) {

            if (User::where("email", $request->email)->exists()) {
                $login_details = User::where('email', $request->email)->first();
            } else {
                return back()->with('fail', 'Please Enter A Valid Email Address');
            }

            $details  = [

                'title' => "CRM Password Rest",
                'body' => "Please Click On The Link Below To Rest Your Password",
                'link1' => Crypt::encryptString($login_details->id),
                'link2' => "reset",


            ];
            Mail::to($request->email)->send(new \App\Mail\ForgotPassword($details));

            return back()->with(['success' => 'Password reset link has been sent to your email']);
        }
    }

    public function reset_password($id, $email, Request $request)
    {
        if ($request->isMethod('get')) {
            return view('reset_password');
        }
        if ($request->isMethod('post')) {

            $user_id = Crypt::decryptString($id);

            $this->validate($request, [
                "password" => "required | min:6 | confirmed",
            ]);
            $password = User::find($user_id);
            $password->password = Hash::make($request->input('password'));
            $password->update();
            return back()->with('success', 'Password successfully updated');
        }
    }
}



