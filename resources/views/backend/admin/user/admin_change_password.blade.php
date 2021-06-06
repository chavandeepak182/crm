@include('backend.admin.layout.header')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Change Password</h3>
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
                    <h2>Change Password <small></small></h2>
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
                    <form id="demo-form" action="{{ url('changePasswordaction')}}" method="POST" enctype="multipart/form-data">

                      {{ csrf_field() }}

                      <label for="email">New Password * :</label>
                      <input type="password" id="new_password" autocomplete="off" class="form-control" name="new_password" value="{{old('new_password')}}" autocomplete="off">
                      @error('new_password')
                      <div class="alert alert-danger" id="email_error">{{ $message }}</div>
                      @enderror

                       <label for="password">Confirm Password * :</label>
                      <input type="password" id="con_password"  autocomplete="off" class="form-control" name="con_password" value="{{old('con_password')}}" autocomplete="off" />
                      @error('con_password')
                      <div class="alert alert-danger" id="error">{{ $message }}</div>
                      @enderror

                          <br/>
                     <input type="submit" class="btn btn-primary" name="submit" value="change password" >

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
