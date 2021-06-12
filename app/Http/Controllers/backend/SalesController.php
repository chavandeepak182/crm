<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\User;
use App\Lead;
use App\BranchAddress;
use App\Bank;

use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class SalesController extends Controller
{
    //
    public function __construct()
    {
         $this->middleware('sales_auth');

    }


    public  function index(){
        $user_id=Auth::user()->id;
        $leads=Lead::OrderBy('id','DESC')->where('lead_allocate',$user_id)->get()->count();
        $todayLeads=Lead::OrderBy('id','DESC')->where('lead_allocate',$user_id)->whereDate('created_at', Carbon::today())->get()->count();
//        $leadsLoginLoad=Lead::where('cibil_submitted','cibil')->orWhere('send_to_login',1)->whereDate('created_at', Carbon::today())->count();
//        $leadsTotal=Lead::where('cibil_submitted','cibil')->orWhere('send_to_login',1)->count();
        //return $leadsLogin;
        return view('backend.sales.sales_dashboard',compact('leads','todayLeads'));
     }

     public  function profile_sales(){

        return view('backend.sales.profile');

    }

    public function change_password_sales(){

        return view('backend.sales.change_password');
    }

    public function changePasswordactionSales(Request $request){
        $inputs = $request->except('_token');
        $rules=[
          'new_password'     => 'required|min:6',
          'con_password' => 'required|same:new_password'

      ];
      $validation = Validator::make($inputs, $rules);
      if($validation->fails())
      {
        $request->session()->flash('error', ' Something went wronge  !!');
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
            return redirect('/change_password_sales');
            }else{
            $user=User::find($user_id);
            $user->password=Hash::make($newPass);
            if($user->save()){
                $request->session()->flash('success', 'Your password changed successfully  !!');
            return redirect('/change_password_sales');
            }else{
                $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect('/change_password_sales');
            }

           }
        }
      }

    public function get_sales_branches_sales(Request $request,$id){
        $sales = User::where("branch_id",$id)->where('role','Sales')->get();
        return json_encode($sales);
    }
      public function leads_list(){
        $user_id=Auth::user()->id;

        $leads=Lead::OrderBy('id','DESC')->where('lead_allocate',$user_id)->get();
        $leads->load('get_added');
        return view('backend.sales.leads_list',compact('leads'));
    }
    public function add_lead(){
        $branches = BranchAddress::orderBy('id', 'desc')->get();
        // $sales=User::select('id','name')->where('role','Sales')->get();
        return view('backend.sales.add_lead',compact('branches'));
    }
    public function delete_lead_sales(Request $request,$lead_id){
        $user = Lead::where('id', $lead_id)->delete();
        if ($user) {
         $request->session()->flash('success', 'Lead Successfully Deleted !!');
         }else{
          $request->session()->flash('error', 'Something Went Wrong !!');
         }
        return redirect('/leads_list_seals');
      }

    public function add_lead_action_sales(Request $request){
        $inputs = $request->except('_token');
        $rules=[
            'purpose_of_loan' =>'required',
            'full_name'     => 'required',
            'mobile_number' => 'required',
            'company_name'  => 'required',
            'disignation'   =>'required',
            'branch_allote' => 'required',
            'lead_allote'   => 'required'
        ];

       $validation = Validator::make($inputs, $rules);
       if($validation->fails())
       {
        $request->session()->flash('error', ' Something went wronge  !!');
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
            $lead->lead_id = 'L'.$MaxCode;
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
            $lead->is_query = $request->query_fix;
            $lead->is_document = $request->document_collected;
            $lead->narration = $request->narration;
            $lead->cibil_score = $request->cibil_score;
            $lead->who_added = $user_id;
            $lead->seals_submitted = "seals";
            $lead->save();
            $request->session()->flash('success', 'Your lead generated successfully  !!');
            return redirect('/leads_list_seals');
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
        return view('backend.sales.edit_view_lead',compact('lead','branches'));
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
        $request->session()->flash('error', ' Something went wronge  !!');
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
            $lead->is_query = $request->query_fix;
            $lead->is_document = $request->document_collected;
            $lead->narration = $request->narration;
            $lead->cibil_score = $request->cibil_score;
            // $lead->who_added = $user_id;
            $lead->seals_submitted = "seals";
            $lead->save();
            $request->session()->flash('success', ' lead updated successfully  !!');
            return redirect('/leads_list_seals');
        }
        catch(Exception $e){
            $request->session()->flash('error', 'operation failed  !!');
            return redirect()->back();
        }

       }

    }

    public function sendToCibilSeals(Request $request,$id)
    {
        $lead = Lead::find($id);
        $lead->send_to_cibil = 1;
        if ($lead->save()) {
            return response()->json(['status' => true, 'message' => 'Forwarded successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function sendToLogin(Request $request,$id)
    {
        $lead = Lead::find($id);
        $lead->send_to_login = 1;
        if ($lead->save()) {
            return response()->json(['status' => true, 'message' => 'Forwarded successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }


    public function leads_list_cibil(){
        $user_id=Auth::user()->id;
        $leads=Lead::where('seals_submitted','seals')->orWhere('send_to_cibil',1)->OrderBy('id','DESC')->get();
        $leads->load('get_allocated');
        $leads->load('get_added');
        return view('backend.sales.leads_list',compact('leads'));
    }

    public function edit_view_lead_cibil(Request $request,$lead_id){
        $lead = Lead::where('id', $lead_id)->first();
        $lead->load('get_allocated');
        $lead->load('get_added');
        // return $lead;
        $branches = BranchAddress::orderBy('id', 'desc')->get();
        return view('backend.sales.edit_view_lead_cibil',compact('lead','branches'));
      }
      public function updated_cibil_action(Request $request){
        $inputs = $request->except('_token');
        $rules=[
            'pdf_upload' => 'mimes:csv,txt,xlx,xls,pdf|max:2048',
            'file_doable'  => 'required'
        ];

       $validation = Validator::make($inputs, $rules);
       if($validation->fails())
       {
        $request->session()->flash('error', ' Something went wronge  !!');
       return redirect()->back()->withErrors($validation)->withInput();
       }else{
        try{
            $user_id=Auth::user()->id;
            $lead_id=$request->lead_id;
            $lead =Lead::find($lead_id);
            $lead->file_doable = $request->file_doable;
            $lead->cibil_score = $request->cibil_score;
            $lead->narration = $request->narration;
            $lead->pan_no = $request->pan_no;
            $lead->date_of_birth = $request->date_of_birth;
            
            $lead->cibil_submitted = "cibil";
            if($request->hasFile('pdf_upload')){
                $filepath = $request->file('pdf_upload');
                $fileName = 'lead'.round(microtime(true)*10000) . str::random() . uniqid(rand()) . '.' . $filepath->getClientOriginalExtension();
                Storage::disk('public')->put($fileName, File::get($filepath));
                $lead->pdf = $fileName;
            }
            // return $lead;
            $lead->save();
            $request->session()->flash('success', ' lead updated successfully  !!');
            return redirect('/leads_list_cibil');
        }
        catch(Exception $e){
            $request->session()->flash('error', 'operation failed  !!');
            return redirect()->back();
        }

       }

    }

    public function leads_list_login(){
        $user_id=Auth::user()->id;
        $leads=Lead::where('cibil_submitted','cibil')->orWhere('send_to_login',1)->OrderBy('id','DESC')->get();
        $leads->load('get_added');
        return view('backend.sales.login_lead_list',compact('leads'));
    }


    public function login_edit(Request $request,$lead_id){
        $lead = Lead::where('id', $lead_id)->first();
        $banks = Bank::orderBy('bank_name','ASC')->get();
        $lead->load('get_allocated');
        $lead->load('get_added');
        // return $lead;
        $branches = BranchAddress::orderBy('id', 'desc')->get();
        return view('backend.sales.login_edit',compact('lead','branches','banks'));
      }


      public function updated_login_action(Request $request){
        $inputs = $request->except('_token');
        $rules=[
            'application_number' => 'required',
            'los_no'  => 'required',
            'type'  => 'required',
            'file_login'  => 'required',
            'login_bank_name'  => 'required'
        ];

       $validation = Validator::make($inputs, $rules);
       if($validation->fails())
       {
        $request->session()->flash('error', ' Something went wronge  !!');
       return redirect()->back()->withErrors($validation)->withInput();
       }else{
        try{
            $user_id=Auth::user()->id;
            $lead =Lead::find($request->lead_id);
            $lead->application_no = $request->application_number;
            $lead->los_no = $request->los_no;
            $lead->type = $request->type;
            $lead->file_login = $request->file_login;
            $lead->login_bank_name = $request->login_bank_name;
            $lead->logindate = $request->logindate;
            $lead->login_submitted = "login";
            $lead->save();
            $request->session()->flash('success', ' lead updated successfully  !!');
            return redirect('/leads_list_login');
        }
        catch(Exception $e){
            $request->session()->flash('error', 'operation failed  !!');
            return redirect()->back();
        }

       }

    }

    public function leads_list_credit(){
        $user_id=Auth::user()->id;
        $leads=Lead::where('login_submitted','login')->OrderBy('id','DESC')->get();
        $leads->load('get_added');
        return view('backend.sales.leads_list_credit',compact('leads'));
    }

    public function creditLogin(Request $request,$lead_id){
        $lead = Lead::where('id', $lead_id)->first();
        $lead->load('get_allocated');
        $lead->load('get_added');
        // return $lead;
        $branches = BranchAddress::orderBy('id', 'desc')->get();
        return view('backend.sales.credit_edit',compact('lead','branches'));
      }


    //   public function creditLogin_edit(Request $request,$lead_id){
    //     $lead = Lead::where('id', $lead_id)->first();
    //     $lead->load('get_allocated');
    //     $lead->load('get_added');
    //     // return $lead;
    //     $branches = BranchAddress::orderBy('id', 'desc')->get();
    //     return view('backend.sales.login_edit',compact('lead','branches'));
    //   }


      public function updated_creadit_action(Request $request){
        $inputs = $request->except('_token');
        $rules=[

            'file_status'       => 'required',
        ];

       $validation = Validator::make($inputs, $rules);
       if($validation->fails())
       {
        $request->session()->flash('error', ' Something went wronge  !!');
       return redirect()->back()->withErrors($validation)->withInput();
       }else{
        try{
            $user_id=Auth::user()->id;
            $lead =Lead::find($request->lead_id);
            $lead->approved_loan_amount = $request->approved_loan_amount;
            $lead->rate_of_interest = $request->rate_of_interest;
            $lead->disbursed_amount = $request->disbursed_amount;
            $lead->file_status = $request->file_status;
            $lead->save();
            $request->session()->flash('success', ' lead updated successfully  !!');
            return redirect('/leads_list_credit');
        }
        catch(Exception $e){
            $request->session()->flash('error', 'operation failed  !!');
            return redirect()->back();
        }

       }

    }
}
