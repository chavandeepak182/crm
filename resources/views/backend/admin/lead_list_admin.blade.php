@include('backend.admin.layout.header')
 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Lead <small>List</small></h3>
              </div>

              <div class="title_right" >


	             <a href="{{ url('add_lead')}}"><button class="btn btn-primary" data-toggle="tooltip" title="Lead Ganerate" style="float: right;"><i class="fa fa-plus-circle"></i></button></a>

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
                          <!-- <th>Purpose Of Loan</th> -->
                          <th>Name</th>
                          <th>Mobile</th>
                          <th>City</th>
                          <th>Required Amount</th>
                          <th>Disbursed Amount</th>
                          <th>Lead Allocate</th>
                          {{-- <th>Document collected</th> --}}
                          <!-- <th>Actions</th> -->
                        </tr>
                      </thead>


                      <tbody>
                       @if(!empty($leads))
                       @php $p=1; @endphp
                        @foreach($leads as $key =>  $led)
                        <tr>
                          <!-- <td>{{ $key+1 }}</td> -->
                          <!-- <td>
                          @if ($led->purpose_of_loan =="CREDITCARD")
                              {{ 'CREDIT CARD' }}
                                @elseif ($led->purpose_of_loan =="CARLOAN")
                                {{'CAR LOAN'}}
                                @else
                                {{$led->purpose_of_loan}}
                          @endif
                        </td> -->
                          <td>{{ $led->lead_id}}</td>
                          <td>{{ $led->full_name }}</td>
                          <td>{{ $led->mobile_number }}</td>
                          <td>{{ $led->city }}</td>
                          <td>{{ ($led->req_loan_amt)?$led->req_loan_amt:'--' }}</td>
                          <td>{{ ($led->disbursed_amount)?$led->disbursed_amount:'--' }}</td>
                          <td>{{ ($led->get_allocated->name)?$led->get_allocated->name:'--' }}</td>
                          <!-- <td>{{ $led->get_added->name }}</td> -->
                          {{-- <td>{{ $led->get_added->name }}</td> --}}
                          <!-- <td>  <a  href="{{ url('edit_view_lead/'.$led->id) }}"><button class="btn btn-info"  title="Edit Lead" data-toggle="tooltip" ><i class="fa fa-pencil"></i></button></a>

                          <a onClick="return confirm('Are you sure you want to delete this record ?')" href="{{ url('/delete_lead/'.$led->id) }}"><button class="btn btn-danger" title="Delete Lead" data-toggle="tooltip"><i class="fa fa-trash"></i></button></a>

                           {{-- <a href="{{ url('/view_users/'.$led->id) }}"><button class="btn btn-warning" title="View Lead" data-toggle="tooltip"><i class="fa fa-eye"></i></button></a> --}}
                          </td> -->

                      </tr>
                      <!-- @php $p++; @endphp -->
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
@include('backend.telecaller.layout.footer')

<script type="text/javascript">
setTimeout(function() {
    $('#flassMessage').fadeOut("slow");
}, 3000); //

</script>
