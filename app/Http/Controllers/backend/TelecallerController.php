<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use App\User;
use App\BranchAddress;
use App\Lead;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class TelecallerController extends Controller
{
    public function __construct()
    {
         $this->middleware('telecaller_auth');

    }

    public  function index(){
        $user_id=Auth::user()->id;
        $leads=Lead::OrderBy('id','DESC')->where('who_added',$user_id)->get()->count();
        return view('backend.telecaller.tele_dashboard',compact('leads'));
     }


    public  function profile_telecaller(){

        return view('backend.telecaller.profile');

    }

    public function change_password_telecaller(){

        return view('backend.telecaller.change_password');
    }

    public function change_password_tel(){
        return view('backend.admin.user.admin_change_password');
       }

    public function changePasswordactiontele(Request $request){
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
        $oldPass=Hash::make($request->input('old_password'));
        $newPass=$request->input('new_password');
        $conPass=$request->input('con_password');
            if($newPass != $conPass){
            $request->session()->flash('error', 'Your new password and confirm password did not match !!');
            return redirect('/change_password_telecaller');
            }else{
            $user=User::find($user_id);
            $user->password=Hash::make($newPass);
            if($user->save()){
                $request->session()->flash('success', 'Your password changed successfully  !!');
            return redirect('/change_password_telecaller');
            }else{
                $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect('/change_password_telecaller');
            }

           }
        }
      }


    public function get_sales_branches(Request $request,$id){
        $sales = User::where("branch_id",$id)->where('role','Sales')->get();
        return json_encode($sales);
    }
    public function sendToCibil(Request $request,$id){
    $lead=Lead::find($id);
    $lead->send_to_cibil=1;
    if($lead->save()){
        return response()->json(['status'=>true,'message'=>'Forwarded successfully']);
    }else{
        return response()->json(['status'=>false,'message'=>'Something went wrong']);
    }

    }
    public function leads_list(){
        $user_id=Auth::user()->id;
        $leads=Lead::OrderBy('id','DESC')->where('who_added',$user_id)->get();
        $leads->load('get_allocated');
        $leads->load('get_added');

        return view('backend.telecaller.leads_list',compact('leads'));
    }
    public function add_lead(){
        $branches = BranchAddress::orderBy('id', 'desc')->get();
        // $sales=User::select('id','name')->where('role','Sales')->get();
        return view('backend.telecaller.add_lead',compact('branches'));
    }
    public function delete_lead(Request $request,$lead_id){
        $user = Lead::where('id', $lead_id)->delete();
        if ($user) {
         $request->session()->flash('success', 'Lead Successfully Deleted !!');
         }else{
          $request->session()->flash('error', 'Something Went Wrong !!');
         }
        return redirect('/leads_list');
      }

    public function add_lead_action(Request $request){
        $inputs = $request->except('_token');
        $rules=[
            'purpose_of_loan'=>'required',
            'full_name'  => 'required',
            'mobile_number'  => 'required',
            'company_name'  => 'required',
            'disignation'=>'required',
            'branch_allote' => 'required',
            'lead_allote' => 'required'
        ];

       $validation = Validator::make($inputs, $rules);
       if($validation->fails())
       {
       return redirect()->back()->withErrors($validation)->withInput();

       }else{

        try{
            $MaxCode1 = Lead::select('lead_id')->orderBy('id','Desc')->get();
            if(count($MaxCode1)>0)
            {
                if($MaxCode1[0]->lead_id !="") {
                    $MaxCode = substr($MaxCode1[0]->lead_id, -7);
                    $MaxCode = $MaxCode + 1;
                }else{
                    $MaxCode = 1000001;
                }
            }
            else $MaxCode = 1000001;
        
                if (isset($request->image) && !empty($request->image)) {
                    $validator = Validator::make(['image' => $request->image], ["image" => "mimes:jpeg,jpg,png,bmp,gif|max:4096"]);
                    if ($validator->fails()) $request->session()->flash('error', 'Error: Invalid Image File Format!');
                    else {
                        $logoFileName = round(microtime(true) * 10000) . str::random() . uniqid(rand()) . '.' . $request->image->getClientOriginalExtension();
                        Storage::disk('public')->put($logoFileName, File::get($request->image));

                    }
                }
            $user_id=Auth::user()->id;
            $lead = new Lead;
            if(!empty($logoFileName)){
                $lead->image = $logoFileName;     
            }
            $lead->purpose_of_loan = $request->purpose_of_loan;
            $lead->lead_id = 'L'.$MaxCode;
            $lead->full_name = $request->full_name;
            $lead->mobile_number = $request->mobile_number;
            $lead->email = $request->email;
            $lead->date_of_birth = $request->date_of_birth;
            $lead->pan_no = $request->pan_no;
            $lead->mother_name = $request->mother_name;
            $lead->spouse_details = $request->spouse_details;
            $lead->spouse_dob = $request->spouse_dob;
            $lead->res_address = $request->res_address;
            $lead->pincode = $request->pincode;
            $lead->state = $request->state;
            $lead->city = $request->city;
            $lead->landmark = $request->landmark;
            $lead->per_address = $request->per_address;
            $lead->per_state = $request->per_state;
            $lead->per_city = $request->per_city;
            $lead->per_landmark = $request->per_landmark;
            $lead->company_name = $request->company_name;
            $lead->disignation = $request->disignation;
            $lead->gross_salary = $request->gross_salary;
            $lead->net_salary = $request->net_salary;
            $lead->deduction_gpf = $request->deduction_gpf;
            $lead->deduction_soc_emi = $request->deduction_soc_emi;
            $lead->deduction_other = $request->deduction_other;
            $lead->already_active_loan = $request->already_active_loan;
            $lead->ref_name = $request->ref_name;
            $lead->ref_mobile = $request->ref_mobile;
            $lead->ref_pincode = $request->ref_pincode;
            $lead->ref_address = $request->ref_address;
            $lead->ref_name_one = $request->ref_name_one;
            $lead->ref_mobile_one = $request->ref_mobile_one;
            $lead->ref_pincode_one = $request->ref_pincode_one;
            $lead->ref_address_one = $request->ref_address_one;
            $lead->senior_name = $request->senior_name;
            $lead->senior_mobile = $request->senior_mobile;
            $lead->senior_designation = $request->senior_designation;
            $lead->client_type = $request->client_type;
            $lead->req_loan_amt = $request->req_loan_amt;
            $lead->branch_allocate = $request->branch_allote;
            $lead->lead_allocate = $request->lead_allote;
            $lead->narration = $request->narration;
            $lead->cibil_score = $request->cibil_score;
            $lead->who_added = $user_id;
           
            $lead->save();
            $request->session()->flash('success', 'Your lead generated successfully  !!');
            return redirect('/leads_list');
        }
        catch(Exception $e){
            $request->session()->flash('error', 'operation failed  !!');
            return redirect('/add_lead');
        }

       }

    }


    public function edit_view_lead(Request $request,$lead_id){
        $lead = Lead::where('id', $lead_id)->first();
        $lead->load('get_allocated');
        $lead->load('get_added');
        // return $lead;
        $branches = BranchAddress::orderBy('id', 'desc')->get();
        return view('backend.telecaller.edit_view_lead',compact('lead','branches'));
      }
      public function updated_lead_action(Request $request){
        $inputs = $request->except('_token');
        $rules=[
            'purpose_of_loan'=>'required',
            'full_name'  => 'required',
            'mobile_number'  => 'required',
            'company_name'  => 'required',
            'disignation'=>'required',
            'branch_allote' => 'required',
            'lead_allote' => 'required'
        ];

       $validation = Validator::make($inputs, $rules);
       if($validation->fails())
       {
       return redirect()->back()->withErrors($validation)->withInput();

       }else{

        try{
            
            if (isset($request->image) && !empty($request->image)) {
                $validator = Validator::make(['image' => $request->image], ["image" => "mimes:jpeg,jpg,png,bmp,gif|max:4096"]);
                if ($validator->fails()) $request->session()->flash('error', 'Error: Invalid Image File Format!');
                else {
                    $logoFileName = round(microtime(true) * 10000) . str::random() . uniqid(rand()) . '.' . $request->image->getClientOriginalExtension();
                    Storage::disk('public')->put($logoFileName, File::get($request->image));

                }
            }
            $user_id=Auth::user()->id;
            $lead_id=$request->lead_id;
            $lead =Lead::find($lead_id);
            if(!empty($logoFileName)){
                $lead->image = $logoFileName;     
            }
            $lead->purpose_of_loan = $request->purpose_of_loan;
            $lead->full_name = $request->full_name;
            $lead->mobile_number = $request->mobile_number;
            $lead->email = $request->email;
            $lead->date_of_birth = $request->date_of_birth;
            $lead->pan_no = $request->pan_no;
            $lead->mother_name = $request->mother_name;
            $lead->spouse_details = $request->spouse_details;
            $lead->spouse_dob = $request->spouse_dob;
            $lead->res_address = $request->res_address;
            $lead->pincode = $request->pincode;
            $lead->state = $request->state;
            $lead->city = $request->city;
            $lead->landmark = $request->landmark;
            $lead->per_address = $request->per_address;
            $lead->per_state = $request->per_state;
            $lead->per_city = $request->per_city;
            $lead->per_landmark = $request->per_landmark;
            $lead->company_name = $request->company_name;
            $lead->disignation = $request->disignation;
            $lead->gross_salary = $request->gross_salary;
            $lead->net_salary = $request->net_salary;
            $lead->deduction_gpf = $request->deduction_gpf;
            $lead->deduction_soc_emi = $request->deduction_soc_emi;
            $lead->deduction_other = $request->deduction_other;
            $lead->already_active_loan = $request->already_active_loan;
            $lead->ref_name = $request->ref_name;
            $lead->ref_mobile = $request->ref_mobile;
            $lead->ref_pincode = $request->ref_pincode;
            $lead->ref_address = $request->ref_address;
            $lead->ref_name_one = $request->ref_name_one;
            $lead->ref_mobile_one = $request->ref_mobile_one;
            $lead->ref_pincode_one = $request->ref_pincode_one;
            $lead->ref_address_one = $request->ref_address_one;
            $lead->senior_name = $request->senior_name;
            $lead->senior_mobile = $request->senior_mobile;
            $lead->senior_designation = $request->senior_designation;
            $lead->client_type = $request->client_type;
            $lead->req_loan_amt = $request->req_loan_amt;
            $lead->branch_allocate = $request->branch_allote;
            $lead->lead_allocate = $request->lead_allote;
            $lead->narration = $request->narration;
            $lead->cibil_score = $request->cibil_score;
            $lead->who_added = $user_id;
            $lead->save();
            $request->session()->flash('success', ' lead updated successfully  !!');
            return redirect('/leads_list');
        }
        catch(Exception $e){
            $request->session()->flash('error', 'operation failed  !!');
            return redirect()->back();
        }

       }

    }

}
