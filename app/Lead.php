<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{

    protected $fillable = [
        'purpose_of_loan', 'full_name', 'mobile_number', 'email', 'date_of_birth', 'pan_no', 'mother_name', 'spouse_details', 'spouse_dob',
        'res_address', 'landmark', 'city','city','pincode','per_state','per_address', 'per_landmark', 'per_city', 'company_name', 'disignation', 'gross_salary',
        'deduction_gpf', 'deduction_soc_emi', 'deduction_other', 'net_salary', 'already_active_loan', 'ref_name', 'ref_address', 'ref_mobile',
        'ref_pincode', 'ref_name_one', 'ref_address_one', 'ref_mobile_one', 'ref_pincode_one', 'senior_name', 'senior_mobile', 'senior_designation',
        'lead_allocate', 'branch_allocate', 'cibil_score', 'pdf', 'req_loan_amt', 'client_type','narration','who_added','is_query','is_document','file_doable',
        'application_no','los_no','login_bank_name','type','file_login','logindate',
        'approved_loan_amount','rate_of_interest','disbursed_amount','file_status','who_submitted',
        'seals_submitted','cibil_submitted','login_submitted','send_to_cibil','send_to_login','lead_id','image'
    ];

    public function get_allocated(){
        return $this->belongsTo('App\User', 'lead_allocate', 'id')->select('id','name');
    }
    public function get_added(){
        return $this->belongsTo('App\User', 'who_added', 'id')->select('id','name');
    }
}
