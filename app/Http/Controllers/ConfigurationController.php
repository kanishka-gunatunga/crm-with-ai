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
use App\Models\Configuration;

use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class ConfigurationController extends Controller
{
    public function configuration(Request $request)
    {
        if($request->isMethod('get')){
            $config = Configuration::first();
            return view('configuration.configuration', ['config' => $config]);
         }
        
    }

    public function update_company_logo(Request $request)
    {
        try {
        if ($request->hasFile('company_logo')) {
            $request->validate([
                'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $image = $request->file('company_logo');
           
            $imag_name = time().'-logo-.'.$image->extension();
            $image->move(public_path('uploads/'), $imag_name);
            
            $core =  Configuration::first();;
            $core->logo = $imag_name;
            $core->update();


            return response()->json(['success' => true, 'image' => $imag_name]);
        }

        } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
    }
}



