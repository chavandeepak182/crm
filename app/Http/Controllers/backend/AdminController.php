<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\User;
use App\Lead;
use App\BranchAddress;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	public function __construct()
    {
         $this->middleware('check_auth');

    }

 public  function index(){
    $user_id=Auth::user()->id;
    $tele=User::OrderBy('id','DESC')->where('role','Telecaller')->get()->count();
    $Sales=User::OrderBy('id','DESC')->where('role','Sales')->get()->count();
    $leads=Lead::OrderBy('id','DESC')->get()->count();
    $todayLeads=Lead::OrderBy('id','DESC')->whereDate('created_at', Carbon::today())->get()->count();
    return view('backend.admin.dashboard',compact('leads','todayLeads','Sales','tele'));
   }

 public  function profile(){

   	return view('backend.admin.profile');

   }

public  function users(){
 $users = User::where('role','!=','Admin')->orderBy('id', 'desc')->get();
 return view('backend.admin.user.users',compact('users'));
}
 public function add_user(){
    $branches = BranchAddress::orderBy('id', 'desc')->get();
    return view('backend.admin.user.add_user',compact('branches'));
  }

 public function add_user_action(Request $request)
  {
   $inputs = $request->except('_token');
   $rules=[
               'username'=>'required',
               'email'=>'required|email|unique:users',
               'password'=>'required|min:4|max:16',
               'address'=>'required',
               'mobile'=>'required',
               'role'=>'required',
               'branch'=>'required',

   ];

       $validation = Validator::make($inputs, $rules);
        if ($validation->fails())
        {
         return redirect()->back()->withErrors($validation)->withInput();

        }else{

            $image = $request->file('profile');
            $slug =  Str::slug($request->input('name'));
            if (isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('admin_media/images/users'))
                {
                    Storage::disk('public')->makeDirectory('admin_media/images/users');
                }
                $postImage = Image::make($image)->resize(128, 128)->stream();
                    Storage::disk('public')->put('admin_media/images/users/'.$imageName, $postImage);
            } else
            {
                $imageName = 'public/admin_media/user.png';

            }

            $MaxPayId = User::get()->max('emp_id');
            if(isset($MaxPayId))  $MaxPayId = $MaxPayId+1;
            else $MaxPayId = 101;

            $User = new User();
            $User->name=$request->input('username');
            $User->email=$request->input('email');
            $User->role=$request->input('role');
            if(!empty($MaxPayId) && isset($MaxPayId)){
                $User->emp_id=$MaxPayId;
            }
            $User->branch_id=$request->input('branch');
            $User->password=Hash::make($request->input('password'));
            $User->mobile=$request->input('mobile');
            $User->address=$request->input('address');
            $User->image=$imageName;
            $User->status= 1;
             if ($User->save()) {
             $request->session()->flash('success', 'User Successfully Created !!');
             }else{
              $request->session()->flash('error', 'Something Went Wrong !!');
             }
            return redirect('/add_user');

        }//end else

   }//end function


public function view_users($user_id){
  $user = User::latest()->where('id', $user_id)->first();
  return view('backend.admin.user.users_view',compact('user'));
}

public function delete_users(Request $request,$user_id){

  $user = User::where('id', $user_id)->delete();
  if ($user) {
   $request->session()->flash('success', 'User Successfully Deleted !!');
   }else{
    $request->session()->flash('error', 'Something Went Wrong !!');
   }
  // Toastr::success('Order has been deleted', 'Success');
  return redirect('/users');
}

public function status_change_user(Request $request,$user_id,$status){
  $status_data = array('status' => $status);
  $condition = array("id" => $user_id);
  $user = User::where($condition)->update($status_data);
  if ($user) {
   $request->session()->flash('success', 'Status change successfully!!');
   }else{
    $request->session()->flash('error', 'Something Went Wrong !!');
   }
  return redirect('/users');

}

public function edit_view_users(Request $request,$user_id){
  $user = User::latest()->where('id', $user_id)->first();
  $branches = BranchAddress::orderBy('id', 'desc')->get();
  return view('backend.admin.user.edit_user',compact('user','branches'));
}

public function update(Request $request){
$inputs = $request->except('_token');
$id=$request->input('userid');
$rules=[
        'username'=>'required',
        'email' => 'required|unique:users,email,'.$id,
        'address'=>'required',
        'mobile'=>'required',
        'role'=>'required',
        'branch'=>'required'
    ];

   $validation = Validator::make($inputs, $rules);
    if ($validation->fails())
    {
        return redirect()->back()->withErrors($validation)->withInput();

    }else{
            $image = $request->file('profile');
            $slug =  Str::slug($request->input('name'));
            $user =  User::find($id);

            if (isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('admin_media/images/users'))
                {
                    Storage::disk('public')->makeDirectory('admin_media/images/users');
                }

                if (Storage::disk('public')->exists('admin_media/images/users/'.$user->image))
                {
                    Storage::disk('public')->delete('admin_media/images/users/'.$user->image);
                }

                $postImage = Image::make($image)->resize(128, 128)->stream();
                    Storage::disk('public')->put('admin_media/images/users/'.$imageName, $postImage);
                } else
                {
                    $imageName = $user->image;
                }

                $user->name=$request->input('username');
                $user->role=$request->input('role');
                $user->email=$request->input('email');
                  if (!empty($request->input('password'))) {
                $user->password=Hash::make($request->input('password'));
                     }
                $user->mobile=$request->input('mobile');
                $user->address=$request->input('address');
                $user->branch_id=$request->input('branch');
                $user->image=$imageName;
                if ($user->save()) {
                 $request->session()->flash('success', 'User Successfully Updated !!');
                  return redirect('/users');
                 }else{
                  $request->session()->flash('error', 'Something Went Wrong !!');
                  redirect($_SERVER['HTTP_REFERER']);

             }

        }

 }

 public function change_password(){
  return view('backend.admin.user.admin_change_password');
 }
 public function changePasswordaction(Request $request){
    $inputs = $request->except('_token');
    $rules=[
      'new_password'     => 'required|min:6',
      'con_password' => 'required|same:new_password'

  ];
  $validation = Validator::make($inputs, $rules);
  if($validation->fails())
  {
  return redirect()->back()->withErrors($validation)->withInput();

  }else{
    $user_id=Auth::user()->id;
    $user = User::where('id', $user_id)->first();
    // return $user;
    $oldPass=Hash::make($request->input('old_password'));
    $newPass=$request->input('new_password');
    $conPass=$request->input('con_password');
        if($newPass != $conPass){
        $request->session()->flash('error', 'Your new password and confirm password did not match !!');
        return redirect('/change_password');
        }else{
        $user=User::find($user_id);
        $user->password=Hash::make($newPass);
        if($user->save()){
            $request->session()->flash('success', 'Your password changed successfully  !!');
        return redirect('/change_password');
        }else{
            $request->session()->flash('error', 'Something Went Wrong !!');
        return redirect('/change_password');
        }

       }
    }
  }

public function lead_list_admin(){
  $leads = Lead::orderBy('id', 'desc')->get();
  return view('backend.admin.lead_list_admin',compact('leads'));
}

 }//End Controller close
