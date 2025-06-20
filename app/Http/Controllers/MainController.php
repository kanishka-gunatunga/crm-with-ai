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
use App\Models\Service;
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
           
            $pipelines = Pipeline::orderBy('id', 'DESC')->get();

            $leadCounts = DB::table('leads')
                ->select('pipeline', DB::raw('count(*) as total'))
                ->groupBy('pipeline')
                ->pluck('total', 'pipeline'); 

            foreach ($pipelines as $pipeline) {
                $pipeline->leads_count = $leadCounts->get($pipeline->id, 0);
            }

            $pieChartData = [
                'labels' => $pipelines->pluck('name'),
                'data' => $pipelines->pluck('leads_count'),
            ];
     
            $all_customers = Person::orderBY('id','DESC')->get();
            $this_month_customers = $all_customers->filter(function ($customer) {
                return $customer->created_at->month === Carbon::now()->month &&
                    $customer->created_at->year === Carbon::now()->year;
            });

            $all_products = Product::orderBY('id','DESC')->get();
            $this_month_products = $all_products->filter(function ($product) {
                return $product->created_at->month === Carbon::now()->month &&
                    $product->created_at->year === Carbon::now()->year;
            });
            
            $all_services = Service::orderBY('id','DESC')->get();
            $this_month_services = $all_services->filter(function ($service) {
                return $service->created_at->month === Carbon::now()->month &&
                    $service->created_at->year === Carbon::now()->year;
            });

            $all_leads = Lead::orderBY('id','DESC')->get();
            $this_month_leads = $all_leads->filter(function ($lead) {
                return $lead->created_at->month === Carbon::now()->month &&
                    $lead->created_at->year === Carbon::now()->year;
            });

            $all_new_leads = $all_leads->filter(function ($lead) {
                return PipelineStage::where('id', $lead->stage)->value('name') === "New";
            });

            $this_month_new_leads = $all_new_leads->filter(function ($lead) {
                return $lead->created_at->month === Carbon::now()->month &&
                    $lead->created_at->year === Carbon::now()->year;
            });

            
            $all_won_leads = $all_leads->filter(function ($lead) {
                return PipelineStage::where('id', $lead->stage)->value('name') === "Won";
            });

            $allLeadsCount = $all_leads->count();
            $wonLeadsCount = $all_won_leads->count();

            $overallSuccessRate = ($allLeadsCount > 0) ? round(($wonLeadsCount / $allLeadsCount) * 100) : 0;

            $now = Carbon::now();

            $monthlyLabels = [];
            $monthlyAllLeadsData = array_fill(0, 12, 0);
            $monthlyWonLeadsData = array_fill(0, 12, 0);

            for ($i = 0; $i < 12; $i++) {
            $month = $now->copy()->subMonthsNoOverflow(11 - $i);
            $monthlyLabels[] = $month->format('M');

            $startOfMonth = $month->copy()->startOfMonth();
            $endOfMonth = $month->copy()->endOfMonth();

            $leadsInThisMonth = $all_leads->filter(function ($lead) use ($startOfMonth, $endOfMonth) {
                $createdAt = Carbon::parse($lead->created_at);
                return $createdAt->between($startOfMonth, $endOfMonth);
            });

            $monthlyAllLeadsData[$i] = $leadsInThisMonth->count();
            $monthlyWonLeadsData[$i] = $all_won_leads->filter(function ($lead) use ($startOfMonth, $endOfMonth) {
                $createdAt = Carbon::parse($lead->created_at);
                return $createdAt->between($startOfMonth, $endOfMonth);
            })->count();
            }

            $weeklyLabels = [];
            $weeklyAllLeadsData = array_fill(0, 7, 0);
            $weeklyWonLeadsData = array_fill(0, 7, 0);

            for ($i = 0; $i < 7; $i++) {

                $week = $now->copy()->subWeeks(6 - $i); 

                $startOfWeek = $week->copy()->startOfWeek(Carbon::MONDAY);
                $endOfWeek = $week->copy()->endOfWeek(Carbon::SUNDAY);

                $weeklyLabels[] = 'Wk ' . $startOfWeek->weekOfYear . ' (' . $startOfWeek->format('M d') . ')';

                $leadsInThisWeek = $all_leads->filter(function ($lead) use ($startOfWeek, $endOfWeek) {
                    $createdAt = Carbon::parse($lead->created_at);
                    return $createdAt->between($startOfWeek, $endOfWeek);
                });

                $weeklyAllLeadsData[$i] = $leadsInThisWeek->count();
                $weeklyWonLeadsData[$i] = $all_won_leads->filter(function ($lead) use ($startOfWeek, $endOfWeek) {
                    $createdAt = Carbon::parse($lead->created_at);
                    return $createdAt->between($startOfWeek, $endOfWeek);
                })->count();
            }

            $yearlyLabels = [];
            $yearlyAllLeadsData = array_fill(0, 5, 0);
            $yearlyWonLeadsData = array_fill(0, 5, 0);

            for ($i = 0; $i < 5; $i++) {
                $year = $now->copy()->subYearsNoOverflow(4 - $i);
                $yearlyLabels[] = $year->format('Y');

                $startOfYear = $year->copy()->startOfYear();
                $endOfYear = $year->copy()->endOfYear();

                $leadsInThisYear = $all_leads->filter(function ($lead) use ($startOfYear, $endOfYear) {
                    $createdAt = Carbon::parse($lead->created_at);
                    return $createdAt->between($startOfYear, $endOfYear);
                });

                $yearlyAllLeadsData[$i] = $leadsInThisYear->count();
                $yearlyWonLeadsData[$i] = $all_won_leads->filter(function ($lead) use ($startOfYear, $endOfYear) {
                    $createdAt = Carbon::parse($lead->created_at);
                    return $createdAt->between($startOfYear, $endOfYear);
                })->count();
            }
            return view('dashboard', ['all_customers' => $all_customers,'this_month_customers' => $this_month_customers,'all_products' => $all_products,'this_month_products' => $this_month_products
            ,'all_services' => $all_services,'this_month_services' => $this_month_services,'all_leads' => $all_leads,'this_month_leads' => $this_month_leads
            ,'all_new_leads' => $all_new_leads,'this_month_new_leads' => $this_month_new_leads,'all_won_leads' => $all_won_leads,'overallSuccessRate' => $overallSuccessRate,
            'wonLeadsCount' => $wonLeadsCount,'monthlyLabels' => $monthlyLabels,'monthlyAllLeadsData' => $monthlyAllLeadsData,'monthlyWonLeadsData' => $monthlyWonLeadsData
            ,'weeklyLabels' => $weeklyLabels,'weeklyAllLeadsData' => $weeklyAllLeadsData,'weeklyWonLeadsData' => $weeklyWonLeadsData,'yearlyLabels' => $yearlyLabels,'yearlyAllLeadsData' => $yearlyAllLeadsData
            ,'yearlyWonLeadsData' => $yearlyWonLeadsData,'pipelines' => $pipelines,'pieChartData' => $pieChartData]);
         }
        
    }
public function get_events($date)
{
     $events = LeadActivity::whereDate('from', $date)->get();

    return response()->json($events->map(function ($event) {
        return [
            'title' => $event->title ?? 'No Title',
            'time' => \Carbon\Carbon::parse($event->from)->format('g:i A'),
            'is_complete' => $event->is_completed ?? 0,
        ];
    }));
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



