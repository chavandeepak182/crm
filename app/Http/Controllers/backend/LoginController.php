<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use User_auth;
use Redirect;
use Auth;
use AuthenticatesUsers;

use App\Login;
use App\User;

class LoginController extends Controller
{

    public function __construct()
    {
        // if (Auth::guard($guard)->check() && Auth::user()->role == "Admin") {
        //     return redirect()->route('admin.dashboard');
        // } elseif(Auth::guard($guard)->check() && Auth::user()->role == "Telecaller"){
        //     return redirect()->route('dashboard');
        // } elseif(Auth::guard($guard)->check() && Auth::user()->role == "Sales") {
        //     return redirect()->route('dashboard');
        // }else{

        // }
    }
    public function index()
    {
    	 return view("backend.login");
    }

    public function auth_check(Request $request)
    {
       $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:15|min:4'
        ]);
        //  $username=$request->username;
        //  $password=sha1($request->password);
         $userdata = array(
            'email' => $request->email ,
            'password' => $request->password
          );

        //  $userData = Login::check_login($username,$password);
        if(Auth::attempt($userdata))
        {
         $user=Auth::user();
         if ($user->status == 1) {
         if($user->role == "Admin"){
            $request->session()->flash('status', 'loggin successfully !');
            return redirect('dashboard');
         }elseif($user->role=="Sales" || $user->role=="Credit" || $user->role=="Cibil" || $user->role=="Login"){
            $request->session()->flash('status', 'loggin successfully !');
            return redirect('sales-dashboard');
         }elseif($user->role=="Telecaller"){
            $request->session()->flash('status', 'loggin successfully !');
            return redirect('telecaller-dashboard');
         }
        }

        else{
            $request->session()->flash('status', 'User inactive contact to admin !');
            return redirect('admin');
        }

        }
        else
        {
        // validation not successful, send back to form
        $request->session()->flash('status', 'Username and password incorrect !');
        return Redirect::to('admin');

        }

    }

public function logout(Request $request){
    $request->session()->flush();
    Auth::logout();
    // $request->session()->forget('key');
    return redirect('admin');
}

}
