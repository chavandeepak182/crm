@include('backend.sales.layout.header')
 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Lead <small>List</small></h3>
              </div>

              <div class="title_right" >

                @if (Auth::user()->role=="Sales")
	             <a href="{{ url('add_lead_sales')}}"><button class="btn btn-primary" data-toggle="tooltip" title="Lead Ganerate" style="float: right;"><i class="fa fa-plus-circle"></i></button></a>
                 @endif
              </div>
             </div>

            <div class="clearfix"></div>

            <div class="row">

                    @if ($message = Session::get('error'))
                     <div class="alert alert-danger alert-block" id="flassMessage">
                      <!-- <button type="button" class="close">×</button>  -->
                      <strong>{{ $message }}</strong>
                      </div>
                     @endif

                      @if ($message = Session::get('success'))
                     <div class="alert alert-success alert-block" id="flassMessage">
                      <!-- <button type="button" class="close">×</button>  -->
                      <strong>{{ $message }}</strong>
                      </div>
                     @endif

              <div class="col-md-12 col-sm-12 ">


                <div class="x_panel">
                  <div class="x_title">
                    <h2>Leads List</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <!--  <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a> -->
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">

                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action" style="width:100%">
                      <thead>
                        <tr>
                          <th>Lead Id</th>
                          @if (Auth::user()->role == "Sales")
                          <!-- <th>Purpose Of Loan</th> -->
                          <th>Name</th>
                          <th>Mobile</th>
                          <th>City</th>
                          <th>Loan Type</th>
                          <th>Required Amount</th>
                          <th>Disbursed Amount</th>
                          <th>Lead Generate By</th>
                          @endif
                          @if (Auth::user()->role == "Cibil")
                          <th>Name</th>
                          <th>Mobile</th>
                          <th>City</th>
                          <th>PanCard No</th>
                          <th>DOB</th>
                          <th>File Doable</th>
                          <th>Lead Allote</th>

                          @endif


                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody>
                       @if(!empty($leads))
                       @php $p=1; @endphp
                        @foreach($leads as $key =>  $led)
                        <tr>
                        <td>{{ ($led->lead_id)?$led->lead_id:'--' }}</td>
                          @if (Auth::user()->role == "Sales")
                          <!-- <td>
                          @if ($led->purpose_of_loan =="CREDITCARD")
                              {{ 'CREDIT CARD' }}
                                @elseif ($led->purpose_of_loan =="CARLOAN")
                                {{'CAR LOAD'}}
                                @else
                                {{$led->purpose_of_loan}}
                          @endif
                        </td> -->

                          <td>{{ ($led->full_name)?$led->full_name:'--' }}</td>
                          <td>{{ ($led->mobile_number)?$led->mobile_number:''}}</td>
                          <td>{{ ($led->city)?$led->city:'--' }}</td>
                          <td>{{ ($led->type)?$led->type:'--' }}</td>
                          <td>{{ ($led->req_loan_amt)?$led->req_loan_amt:'--' }}</td>
                          <td>{{ ($led->disbursed_amount)?$led->disbursed_amount:'--' }}</td>

                          <td>{{ $led->get_added->name ??'--'}}</td>
                          @endif
                          @if (Auth::user()->role == "Cibil")
                          <td>{{ ($led->full_name)?$led->full_name:'--' }}</td>
                          <td>{{ ($led->mobile_number)?$led->mobile_number:''}}</td>
                          <td>{{ ($led->city)?$led->city:'--' }}</td>
                          <td>{{ ($led->pan_no)?$led->pan_no:'--' }}</td>
                          <td>{{ ($led->date_of_birth)?$led->date_of_birth:'--' }}</td>

                          <td>{{ ($led->file_doable)?$led->file_doable:'--' }}</td>
                          <td>{{ $led->get_allocated->name??'--' }}</td>
                          @endif
                          <td>
                            @if (Auth::user()->role == "Cibil")
                            <a  href="{{ url('edit_view_lead_cibil/'.$led->id) }}"><button class="btn btn-info"  title="Edit Lead" data-toggle="tooltip" ><i class="fa fa-pencil"></i></button></a>
                            @endif

                          @if (Auth::user()->role=="Sales")
                          <a  href="{{ url('edit_view_lead_sales/'.$led->id) }}"><button class="btn btn-info"  title="Edit Lead" data-toggle="tooltip" ><i class="fa fa-pencil"></i></button></a>
                          <a onClick="return confirm('Are you sure you want to delete this record ?')" href="{{ url('/delete_lead_sales/'.$led->id) }}"><button class="btn btn-danger" title="Delete Lead" data-toggle="tooltip"><i class="fa fa-trash"></i></button></a>
                            @endif
                           {{-- <a href="{{ url('/view_users/'.$led->id) }}"><button class="btn btn-warning" title="View Lead" data-toggle="tooltip"><i class="fa fa-eye"></i></button></a> --}}
                          </td>

                      </tr>
                      @php $p++; @endphp
                      @endforeach
                      @endif
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
@include('backend.sales.layout.footer')

<script type="text/javascript">
setTimeout(function() {
    $('#flassMessage').fadeOut("slow");
}, 3000); //

</script>
