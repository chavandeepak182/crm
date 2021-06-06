@include('backend.admin.layout.header')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Employee</h3>
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

              <div class="col-md-10 ">

             <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Employee <small></small></h2>
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
                    <form id="demo-form" action="{{ url('add_user_action')}}" method="POST" enctype="multipart/form-data">



                      <label for="fullname">UserName * :</label>
                      <input type="text" id="username" required="" class="form-control" name="username" value="{{old('username')}}" autocomplete="off" />
                       @error('username')
                      <div class="alert alert-danger" id="error">{{ $message }}</div>
                       @enderror
                      {{ csrf_field() }}

                      <label for="email">Email * :</label>
                      <input type="email" id="email" required="" class="form-control" name="email" value="{{old('email')}}" autocomplete="off">
                      @error('email')
                      <div class="alert alert-danger" id="email_error">{{ $message }}</div>
                      @enderror

                       <label for="password">Password * :</label>
                      <input type="password" id="password" required="" class="form-control" name="password" value="{{old('password')}}" autocomplete="off" />
                      @error('password')
                      <div class="alert alert-danger" id="error">{{ $message }}</div>
                      @enderror
                       <label for="mobile">Mobile  * :</label>
                      <input type="text" id="mobile" class="form-control" name="mobile" value="{{old('mobile')}}" autocomplete="off" />
                        @error('mobile')
                      <div class="alert alert-danger" id="error">{{ $message }}</div>
                      @enderror
                      <label for="branch">Select Branch  * :</label>
                      <select name="branch" id="branch" required="" class="form-control">
                        <option value="">Select Branch</option>
                        @if ($branches->isNotEmpty())
                           @foreach ( $branches as $branch )
                           <option value="{{$branch->id}}">{{$branch->branch_address}}</option>
                           @endforeach
                        @endif
                    </select>
                        @error('branch')
                      <div class="alert alert-danger" id="error">{{ $message }}</div>
                      @enderror


                      <label for="role">Select Role  * :</label>
                      <select name="role" id="role" required="" class="form-control">
                        <option value="">Select Role</option>
                        {{-- <option value="Admin">Admin</option> --}}
                        <option value="Telecaller">Telecaller</option>
                        <option value="Sales">Sales</option>
                        <option value="Credit">Credit Department</option>
                        <option value="Cibil">Cibil Department</option>
                        <option value="Login">Login Department</option>
                    </select>
                        @error('role')
                      <div class="alert alert-danger" id="error">{{ $message }}</div>
                      @enderror

                      <label for="address">Address * :</label>
                      <input type="text" id="address" required="" class="form-control" name="address" value="{{old('address')}}" autocomplete="off">
                      @error('address')
                      <div class="alert alert-danger" id="error">{{ $message }}</div>
                      @enderror

                      <label for="profile">Profile * :</label>
                      <input type="file" id="profile"  class="form-control" name="profile" value="{{old('profile')}}">
                       @error('profile')
                      <div class="alert alert-danger" id="error">{{ $message }}</div>
                         @enderror
                          <br/>
                     <input type="submit" class="btn btn-primary" name="submit" >

                    </form>
                  </div>
                </div>



              </div>



            </div>



          </div>
        </div>

@include('backend.admin.layout.footer')
<!-- <script src="{{('admin_media/form_validation/add_user.js')}}"></script> -->

<script type="text/javascript">
setTimeout(function() {
    $('#error,#email_error,#flassMessage').fadeOut("slow");
}, 3000); //

</script>
