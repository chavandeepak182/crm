@include('backend.sales.layout.header')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Lead</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

               <div class="row">
                 @if ($message = Session::get('success'))
                 <div class="alert alert-success alert-block" id="flassMessage">
                  <!-- <button type="button" class="close">×</button>  -->
                  <strong>{{ $message }}</strong>
                  </div>
                 @endif

                 @if ($message = Session::get('error'))
                 <div class="alert alert-danger alert-block" id="flassMessage">
                  <!-- <button type="button" class="close">×</button>  -->
                  <strong>{{ $message }}</strong>
                  </div>
                 @endif

              <div class="col-md-12 ">

             <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Lead <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    {{-- <form id="demo-form" action="{{ url('add_lead_action')}}" method="POST" enctype="multipart/form-data"> --}}
                        <form id="demo-form" action="{{ url('add_lead_action_sales')}}" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-12 ">
                        <div class="col-md-6">
                            <label for="role">Purpose Of Loan * :</label>
                            <select name="purpose_of_loan" required id="purpose_of_loan" class="form-control">
                            <option value="">Purpose Of Loan </option>
                            <option value="PL">PL</option>
                            <option value="BL">BL</option>
                            <option value="HL">HL</option>
                            <option value="LAP">LAP</option>
                            <option value="CREDITCARD">CREDIT CARD</option>
                            <option value="CARLOAN">CAR LOAN</option>
                        </select>
                            @error('purpose_of_loan')
                            <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                        </div>
                            <div class="col-md-6">
                                <label for="full_name">Full Name * :</label>
                                <input type="text" id="full_name" required class="form-control" placeholder="Full Name" name="full_name" value="{{old('full_name')}}" autocomplete="off" />
                                @error('full_name')
                                <div class="alert alert-danger" id="error">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>

                    <div class="col-sm-12 ">
                        <br>
                        <div class="col-md-6">
                            <label for="mobile_number">Mobile Number* :</label>
                            <input type="text" id="mobile_number" required class="form-control" placeholder="Mobile No" name="mobile_number" value="{{old('mobile_number')}}" autocomplete="off" />
                                @error('mobile_number')
                            <div class="alert alert-danger" id="error">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email  :</label>
                            <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}" autocomplete="off" />
                            @error('email')
                            <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <br>
                        <div class="col-md-6">
                            <label for="deduction">Date Of Birth  :</label>
                            <input type="date" id="date_of_birth" class="form-control" placeholder="dd/mm/yyyy" name="date_of_birth" value="{{old('date_of_birth')}}" autocomplete="off" />
                            @error('date_of_birth')
                            <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="mobile_number">Pan Card Number :</label>
                            <input type="text" id="pan_no" class="form-control" name="pan_no" placeholder="PanCard Number" value="{{old('pan_no')}}" autocomplete="off" />
                                @error('pan_no')
                            <div class="alert alert-danger" id="error">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 ">
                        <br>
                        <div class="col-md-6">
                            <label for="mother_name">Mother Name  :</label>
                            <input type="mother_name" id="mother_name" class="form-control" placeholder="Mother Name" name="mother_name" value="{{old('mother_name')}}" autocomplete="off" />
                            @error('mother_name')
                            <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                        </div>
                            <div class="col-md-6">
                                <label for="spouse_details">Spouse Details  :</label>
                                <input type="text" id="spouse_details" class="form-control" placeholder="Spouse Details" name="spouse_details" value="{{old('spouse_details')}}" autocomplete="off" />
                                @error('spouse_details')
                                <div class="alert alert-danger" id="error">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>
                    <div class="col-sm-12 ">
                        <br>
                        <div class="col-md-6">
                            <label for="spouse_dob">Spouse dob :</label>
                            <input type="date" id="spouse_dob" class="form-control" name="spouse_dob" placeholder="dd/mm/yyyy" value="{{old('spouse_dob')}}" autocomplete="off" />
                                @error('spouse_dob')
                            <div class="alert alert-danger" id="error">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="res_address">Residence Address :</label>
                            <textarea id="res_address" class="form-control" name="res_address" rows="3" placeholder="Residence address" value="{{old('res_address')}}" autocomplete="off" /></textarea>
                                @error('res_address')
                            <div class="alert alert-danger" id="error">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 ">
                      <br>
                      <div class="col-md-6">
                        <label for="pincode">Pincode :</label>
                        <input type="text" id="pincode" class="form-control" name="pincode" placeholder="Pincode " value="{{old('pincode')}}" autocomplete="off" />
                            @error('pincode')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>

                      <div class="col-md-6">
                          <label for="state">State :</label>
                          <input type="text" id="state" class="form-control" name="state" placeholder="State " value="{{old('state')}}" autocomplete="off" />
                              @error('state')
                          <div class="alert alert-danger" id="error">{{ $message }}</div>
                              @enderror
                      </div>
                  </div>
                  <div class="col-sm-12 ">
                    <br>
                    <div class="col-md-6">
                        <label for="city">City :</label>
                        <input type="text" id="city" class="form-control" name="city" placeholder="City " value="{{old('city')}}" autocomplete="off" />
                            @error('city')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="landmark">Landmark :</label>
                        <input type="text" id="landmark" class="form-control" name="landmark" placeholder="Landmark " value="{{old('landmark')}}" autocomplete="off" />
                            @error('landmark')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <br>
                    <h2>Permanent Address</h2><br>
                    <div class="col-md-6">
                        <label for="per_address">Permanent Address :</label>
                        <input type="text" id="per_address" class="form-control" name="per_address" placeholder="Permanent Address " value="{{old('per_address')}}" autocomplete="off" />
                            @error('per_address')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="per_state">Permanent State :</label>
                        <input type="text" id="per_state" class="form-control" name="per_state" placeholder="Permanent State" value="{{old('per_state')}}" autocomplete="off" />
                            @error('per_state')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-12 ">
                    <br>
                    <div class="col-md-6">
                        <label for="per_city">Permanent City :</label>
                        <input type="text" id="per_city" class="form-control" name="per_city" placeholder="Permanent City " value="{{old('per_city')}}" autocomplete="off" />
                            @error('per_city')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="per_landmark">Permanent Landmark :</label>
                        <input type="text" id="per_landmark" class="form-control" name="per_landmark" placeholder="Permanent Landmark " value="{{old('per_landmark')}}" autocomplete="off" />
                            @error('per_landmark')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                </div>

                <div class="col-sm-12">
                    <br>
                    <h2>Company Details</h2><br>
                    <div class="col-md-6">
                        <label for="company_name">Company  Name* :</label>
                        <input type="text" id="company_name" required class="form-control" name="company_name" placeholder="Company Name " value="{{old('company_name')}}" autocomplete="off" />
                            @error('company_name')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="disignation">Designation* :</label>
                        <input type="text" id="disignation" required class="form-control" name="disignation" placeholder="Designation " value="{{old('disignation')}}" autocomplete="off" />
                            @error('disignation')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <br>
                    <div class="col-md-6">
                        <label for="gross_salary">Gross Salary :</label>
                        <input type="text" id="gross_salary" class="form-control" name="gross_salary" placeholder="Gross Salary" value="{{old('gross_salary')}}" autocomplete="off" />
                            @error('gross_salary')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="net_salary">Net Salary :</label>
                        <input type="text" id="net_salary" class="form-control" name="net_salary" placeholder="Net Salary " value="{{old('net_salary')}}" autocomplete="off" />
                            @error('net_salary')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                </div>

                <div class="col-sm-12 ">
                    <br>
                    <div class="col-md-6">
                        <label for="deduction_gpf">Deduction GPF :</label>
                        <input type="text" id="deduction_gpf" class="form-control" name="deduction_gpf" placeholder="Deduction GPF " value="{{old('deduction_gpf')}}" autocomplete="off" />
                        @error('deduction_gpf')
                    <div class="alert alert-danger" id="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="deduction_soc_emi">Deduction SOC EMI :</label>
                        <input type="text" id="deduction_soc_emi" class="form-control" name="deduction_soc_emi" placeholder="Deduction SOC EMI" value="{{old('deduction_soc_emi')}}" autocomplete="off" />
                            @error('deduction_soc_emi')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                </div>

                <div class="col-sm-12">
                    <br>
                    <div class="col-md-6">
                        <label for="deduction_other">Deduction Other :</label>
                        <input type="text" id="deduction_other" class="form-control" name="deduction_other" placeholder="Deduction Other" value="{{old('deduction_other')}}" autocomplete="off" />
                            @error('deduction_other')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="already_active_loan">Already Active Loan  :</label>
                        <select name="already_active_loan" id="already_active_loan" value="" class="form-control">
                            <option value="">Alredy Active Loan </option>
                            <option value="HLEMI">HL EMI</option>
                            <option value="PLEMI">PL EMI</option>
                            <option value="OTHEREMI">OTHER EMI</option>
                        </select>
                        @error('already_active_loan')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-12">
                    <br>
                    <h2>Reference Details Friends</h2><br>
                    <div class="col-md-6">
                        <label for="ref_name">Reference  Name :</label>
                        <input type="text" id="ref_name" class="form-control" name="ref_name" placeholder="Reference Name " value="{{old('ref_name')}}" autocomplete="off" />
                            @error('ref_name')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="ref_mobile">Reference  Mobile:</label>
                        <input type="text" id="ref_mobile" class="form-control" name="ref_mobile" placeholder="Reference Mobile " value="{{old('ref_mobile')}}" autocomplete="off" />
                            @error('ref_mobile')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>

                </div>
                <div class="col-sm-12">
                    <br>
                    <div class="col-md-6">
                        <label for="ref_pincode">Reference Pincode  :</label>
                        <input type="text" id="ref_pincode" class="form-control" name="ref_pincode" placeholder="Pincode " value="{{old('ref_pincode')}}" autocomplete="off" />
                            @error('ref_pincode')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="ref_address">Address :</label>
                        <input type="text" id="ref_address" class="form-control" name="ref_address" placeholder="Address " value="{{old('ref_address')}}" autocomplete="off" />
                            @error('ref_address')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <br>
                    <h2>Reference Relative</h2><br>
                    <div class="col-md-6">
                        <label for="ref_name_one">Reference  Name :</label>
                        <input type="text" id="ref_name_one" class="form-control" name="ref_name_one" placeholder="Reference Name " value="{{old('ref_name_one')}}" autocomplete="off" />
                            @error('ref_name_one')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="ref_mobile_one">Reference  Mobile:</label>
                        <input type="text" id="ref_mobile_one" class="form-control" name="ref_mobile_one" placeholder="Reference Mobile " value="{{old('ref_mobile_one')}}" autocomplete="off" />
                            @error('ref_mobile_one')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>

                </div>
                <div class="col-sm-12">
                    <br>

                    <div class="col-md-6">
                        <label for="ref_pincode_one">Reference Pincode  :</label>
                        <input type="text" id="ref_pincode_one" class="form-control" name="ref_pincode_one" placeholder="Pincode " value="{{old('ref_pincode_one')}}" autocomplete="off" />
                            @error('ref_pincode_one')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="ref_address_one">Address :</label>
                        <input type="text" id="ref_address_one" class="form-control" name="ref_address_one" placeholder="Address " value="{{old('ref_address_one')}}" autocomplete="off" />
                            @error('ref_address_one')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <br>
                    <div class="col-md-6">
                        <label for="senior_name">Senior Name :</label>
                        <input type="text" id="senior_name" class="form-control" name="senior_name" placeholder="Senior Name " value="{{old('senior_name')}}" autocomplete="off" />
                            @error('senior_name')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="senior_mobile">Senior Mobile  :</label>
                        <input type="text" id="senior_mobile" class="form-control" name="senior_mobile" placeholder="Senior Mobile " value="{{old('senior_mobile')}}" autocomplete="off" />
                            @error('senior_mobile')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <br>
                    <div class="col-md-6">
                        <label for="senior_designation">Senior Designation :</label>
                        <input type="text" id="senior_designation" class="form-control" name="senior_designation" placeholder="Senior Designation " value="{{old('senior_designation')}}" autocomplete="off" />
                            @error('senior_designation')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>

                </div>
                <div class="col-sm-12 ">
                    <br>
                        <div class="col-md-6">
                            <label for="role">Client Type * :</label>
                            <select name="client_type" required id="client_type" class="form-control">
                            <option value="">Client Type </option>
                            <option value="PL">Positive</option>
                            <option value="BL">Negative</option>
                            <option value="HL">Out Of Reach</option>

                        </select>
                            @error('client_type')
                            <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                        </div>
                            <div class="col-md-6">
                                <label for="req_loan_amt">Required Loan Amount :</label>
                                <input type="text" id="req_loan_amt"  class="form-control" placeholder="Required Loan Amount" name="req_loan_amt" value="{{old('req_loan_amt')}}" autocomplete="off" />
                                @error('req_loan_amt')
                                <div class="alert alert-danger" id="error">{{ $message }}</div>
                                @enderror
                            </div>
                </div>
                       <div class="col-sm-12 ">
                           <br>
                        <div class="col-md-6">
                        <label for="branch_allote">Branch Allocate * :</label>
                        <select name="branch_allote" required id="branch_allote" onchange="getSeales(this.value)" class="form-control">
                        <option value="">Branch Allocate </option>
                        @if ($branches->isNotEmpty())
                            @foreach ( $branches as $branch )
                            <option value="{{$branch->id}}">{{$branch->branch_address}}</option>
                            @endforeach
                       @endif
                        </select>
                        @error('branch_allote')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="lead_allote">Lead Allocate  * :</label>
                        <select name="lead_allote" required id="lead_allote" class="form-control">
                        </select>
                        @error('lead_allote')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    </div>

                <div class="col-sm-12 ">
                    <br>
                    <div class="col-md-6">
                        <label for="cibil_score">Cibil Score :</label>
                        <input type="text" id="cibil_score" class="form-control" name="cibil_score" rows="3" placeholder="Cibil Score" value="{{old('cibil_score')}}" autocomplete="off" />
                            @error('cibil_score')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="narration">Narration :</label>
                        <textarea id="narration" class="form-control" name="narration" rows="3" placeholder="Narration" value="{{old('narration')}}" autocomplete="off" /></textarea>
                            @error('narration')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-12 ">
                    <br>
                    <div class="col-md-6">
                        <label for="query_fix">Query Solve Or Not*:</label>
                        <select name="query_fix" required id="query_fix" class="form-control">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        @error('query_fix')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="document_collected">Document Collected *:</label>
                        <select name="document_collected"  required id="document_collected" class="form-control">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        @error('document_collected')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            <div class="col-sm-12 ">
                    <br>
                    <div class="col-md-6">
                        <label for="image">Visit Photo :</label>
                        <input type="file" id="image" class="form-control" name="image" autocomplete="off" />
                            @error('image')
                        <div class="alert alert-danger" id="error">{{ $message }}</div>
                            @enderror
                    </div>
                  <div class="col-md-6">
                    <label for="image">Document Photo :</label>
                    <input type="file" id="doc_image" class="form-control" name="doc_image" autocomplete="off" />
                    @error('doc_image')
                    <div class="alert alert-danger" id="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
                     <div class="col-md-4">
                        <br>
                        {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" name="submit" >
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@include('backend.sales.layout.footer')
<!-- <script src="{{('admin_media/form_validation/add_user.js')}}"></script> -->

<script type="text/javascript">
setTimeout(function() {
    $('#error,#email_error,#flassMessage').fadeOut("slow");
}, 3000); //

var url="{{url('')}}";
function getSeales(id)
{

        // $('select[name="branch_allote"]').on('change', function() {
            if(id) {
                $.ajax({
                    url: url+'/get_sales_branches_sales/'+id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $('select[name="lead_allote"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="lead_allote"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });


                    }
                });
            }else{
                $('select[name="lead_allote"]').empty();
            }
        // });

}



</script>
