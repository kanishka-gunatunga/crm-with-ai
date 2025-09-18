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
use App\Models\Role;
use App\Models\Group;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class UsersController extends Controller
{
    public function users(Request $request)
    {
        $query = User::with('userDetails');
    

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('created_start_date')) {
            $query->whereDate('created_at', '>=', $request->created_start_date);
        }
    
        if ($request->filled('created_end_date')) {
            $query->whereDate('created_at', '<=', $request->created_end_date);
        }
    

        if ($request->filled('name')) {
            $query->whereHas('userDetails', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }
    
        $users = $query->get();
    
        return view('settings.users.users', [
            'users' => $users,
            'request' => $request->all(),
        ]);
    }

    public function create_user(Request $request)
    {
        if ($request->isMethod('get')) {
            $roles = Role::get();
            $groups = Group::get();
            return view('settings.users.create_user', ['roles' => $roles,'groups' => $groups]);
        }
        if($request->isMethod('post')){

            $request->validate([
                'name'   => 'required',
                'role'   => 'required',
                'email'   => 'required | unique:users',
                "password" => "required | confirmed | min:6",
               ]);
    

               DB::beginTransaction();
               $user = User::create([
                  "email" => $request->email,
                  "password" => Hash::make($request->password),
                  "role" => $request->role,
                  "status" => $request->status ?? 'active',
               ]);
    
               $userDetails = new UserDetails();
               $userDetails->user_id =$user->id;
               $userDetails->name = $request->name;
               $userDetails->groups = $request->groups;
               $userDetails->save();
               DB::commit();
            
               return back()->with('success', 'User created successfully');
        }
    }
    public function delete_user($id,Request $request)
    {
        if ($request->isMethod('get')) {
            User::where('id',$id)->delete();
            UserDetails::where('user_id',$id)->delete();
            return redirect()->back()->with('success', 'User deleted successfully!');
         }
    }
    public function edit_user($id, Request $request)
{
    $user = User::findOrFail($id);
    $user_details = UserDetails::where('user_id',$id)->first();

    if ($request->isMethod('get')) {
        $roles = Role::get();
        $groups = Group::get();
        return view('settings.users.edit_user', ['user' => $user,'user_details' => $user_details,'roles' => $roles,'groups' => $groups]);
    }
    if ($request->isMethod('post')) {

        $request->validate([
            'name'   => 'required',
            'email'   => 'required',
            'role'  => 'required',
        ]);

    if(!$request->password == null || !$request->password_confirmation == null){
        $request->validate([
            "password" => "required | confirmed | min:6",
           ]);

            if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
                $email = $request->email;
            }
            elseif(User::where("email", "=", $request->email)->exists()){
             return back()->with('fail', 'This email is already in use');
            }
            else{
             $email = $request->email;
            }

            $userDetails =  UserDetails::where('user_id', '=', $id)->first();;
            $userDetails->name = $request->name;
            $userDetails->groups = $request->groups;
            $userDetails->update();
            $user = User::find($id);
            $user->email = $email;
            $user->role =$request->role;
            $user->password = Hash::make($request->input('password'));
            $user->update();
            return back()->with('success', 'User Details Successfully  Updated');
   
    }
    else{
        if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
            $email = $request->email;
        }
        elseif(User::where("email", "=", $request->email)->exists()){
         return back()->with('fail', 'This email is already in use');
        }
        else{
         $email = $request->email;
        }

        $userDetails =  UserDetails::where('user_id', '=', $id)->first();;
        $userDetails->name = $request->name;
        $userDetails->groups = $request->groups;
        $userDetails->update();
        $user = User::find($id);
        $user->email = $email;
        $user->role =$request->role;
        $user->update();
        return back()->with('success', 'Admin Details Successfully  Updated');
    }
    }
}

public function delete_selected_users(Request $request)
{
    $userIds = $request->input('selected_users', []);
    
    if (!empty($userIds)) {
        User::whereIn('id', $userIds)->delete();
        UserDetails::whereIn('user_id', $userIds)->delete();
        return back()->with('success', 'Selected users deleted successfully.');
    }

    return back()->with('error', 'No users selected.');
    
}
}



