@include('backend.admin.layout.header')
 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Employee <small>List</small></h3>
              </div>

              <div class="title_right" >


	             <a href="{{ url('add_user')}}"><button class="btn btn-primary" data-toggle="tooltip" title="add user" style="float: right;"><i class="fa fa-plus-circle"></i></button></a>

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
                    <h2>Employee list</small></h2>
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
                          <th>Employee Code</th>
                          <th>Emp Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          {{-- <th>Address</th> --}}
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody>
                       @if(!empty($users))
                       @php $p=1; @endphp
                        @foreach($users as $key =>  $user)
                        <tr>
                          <td>{{($user->emp_id)?'DOA'.$user->emp_id:'--' }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->mobile }}</td>
                          {{-- <td>{{ $user->address }}</td> --}}
                          <td>
                         @if($user->status == 1)
                           {{ csrf_field() }}
                           <input type="hidden" name="" value="{{ $status= 2   }}">
                         <a onClick="return confirm('Are you sure you want to change status of this record ?')" href="{{url('/status_change_user/'.$user->id.'/'.$status) }}"><button class="btn btn-success status_button"   title="enable user" data-toggle="tooltip"><i class="fa fa-check"></i></button></a>
                        @else
                            {{ csrf_field() }}
                           <input type="hidden" name="" value="{{ $status= 1   }}">
                            <a onClick="return confirm('Are you sure you want to change status of this record ?')" href="{{url('/status_change_user/'.$user->id.'/'.$status) }}"><button class="btn btn-danger" title="disable user" data-toggle="tooltip"><i class="fa fa-close"></i></button></a>
                        @endif
                    </td>
                          <td>  <a  href="{{ url('edit_view_users/'.$user->id) }}"><button class="btn btn-info"  title="edit user" data-toggle="tooltip" ><i class="fa fa-pencil"></i></button></a>

                          <a onClick="return confirm('Are you sure you want to delete this record ?')" href="{{ url('/delete_users/'.$user->id) }}"><button class="btn btn-danger" title="delet user" data-toggle="tooltip"><i class="fa fa-trash"></i></button></a>

                           <a href="{{ url('/view_users/'.$user->id) }}"><button class="btn btn-warning" title="view user" data-toggle="tooltip"><i class="fa fa-eye"></i></button></a>
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
@include('backend.admin.layout.footer')

<script type="text/javascript">
setTimeout(function() {
    $('#flassMessage').fadeOut("slow");
}, 3000); //

</script>
