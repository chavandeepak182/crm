@include('backend.admin.layout.header')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Admin Setting</h3>
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
                    <h2>Admin Setting <small></small></h2>
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
                    <form id="demo-form" action="{{ url('/admin_setting_update')}}" method="POST" enctype="multipart/form-data">

                      <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Site Name * :</label>
                      <input type="text" id="site_name" class="form-control" name="site_name" value="{{ $setting->site_name }}" autocomplete="off">
                      <input type="hidden" id="page_id" class="form-control" name="page_id" value="{{ $setting->id }}" autocomplete="off">
                         {{ csrf_field() }}
                      </div>

                      <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Working Time   * :</label>
                      <input type="text" id="working_time" class="form-control" name="working_time" value="{{ $setting->working_time }}" autocomplete="off" />
                      </div>

                       <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Contact Number First * :</label>
                      <input type="text" id="contact_number_one" class="form-control" name="contact_number_one" value="{{ $setting->contact_number_one }}" autocomplete="off">
                      </div>

                      <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Contact Number Second * :</label>
                      <input type="text" id="contact_number_second" class="form-control" name="contact_number_second" value="{{ $setting->contact_number_second }}" autocomplete="off" />
                      </div>

                       <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Conatct Email First * :</label>
                      <input type="text" id="contact_email_one" class="form-control" name="contact_email_one" value="{{ $setting->contact_email_one }}" autocomplete="off">
                      </div>

                      <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Conatct Email Second * :</label>
                      <input type="text" id="contact_email_second" class="form-control" name="contact_email_second" value="{{ $setting->contact_email_second }}" autocomplete="off" />
                      </div>

                       <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Address * :</label>
                      <input type="text" id="address" class="form-control" name="address" value="{{ $setting->address }}" autocomplete="off">
                      </div>

                      <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Linkedin  * :</label>
                      <input type="text" id="linkedin" class="form-control" name="linkedin" value="{{ $setting->linkedin }}" autocomplete="off" />
                      </div>

                       <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Instagram * :</label>
                      <input type="text" id="instagram" class="form-control" name="instagram" value="{{ $setting->instagram }}" autocomplete="off">
                      </div>

                      <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Facebook * :</label>
                      <input type="text" id="facebook" class="form-control" name="facebook" value="{{ $setting->facebook }}" autocomplete="off" />
                      </div>

                       <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Twitter * :</label>
                      <input type="text" id="twitter" class="form-control" name="twitter" value="{{ $setting->twitter }}" autocomplete="off">
                      </div>

                      <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">SMTP Host * :</label>
                      <input type="text" id="smtp_host" class="form-control" name="smtp_host" value="{{ $setting->smtp_host }}" autocomplete="off" />
                      </div>

                       <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">SMTP Port * :</label>
                      <input type="text" id="smtp_port" class="form-control" name="smtp_port" value="{{ $setting->smtp_port }}" autocomplete="off">
                      </div>

                      <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">SMTP Secure  * :</label>
                      <select class="form-control" name="smtp_secure">
                          <option value="">select smtp secure </option>
                              <option  value="TSL" <?php if ($setting->smtp_secure == "TSL"){ echo "selected";  }?>> TSL</option>
                              <option value="SSL" <?php if ($setting->smtp_secure == "SSL"){ echo "selected";  }?>> SSL</option>
                              <option value="NO" <?php if ($setting->smtp_secure == "NO"){ echo "selected";  }?>> NO</option>
                      </select>
                      </div>
                       <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">SMTP Username * :</label>
                      <input type="text" id="smtp_username" class="form-control" name="smtp_username" value="{{ $setting->smtp_username }}" autocomplete="off">
                      </div>

                      <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">SMTP Password * :</label>
                      <input type="text" id="smtp_password" class="form-control" name="smtp_password" value="{{ $setting->smtp_password }}" autocomplete="off" />
                      </div>
                       <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">EMail Sender Name * :</label>
                      <input type="text" id="email_sender_name" class="form-control" name="email_sender_name" value="{{ $setting->email_sender_name }}" autocomplete="off">
                      </div>

                      <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Meta Tag * :</label>
                      <input type="text" id="meta_tag" class="form-control" name="meta_tag" value="{{ $setting->meta_tag }}" autocomplete="off" />
                      </div>
                       <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Meta Description * :</label>
                      <input type="text" id="meta_description" class="form-control" name="meta_description" value="{{ $setting->meta_description }}" autocomplete="off">
                      </div>

                      <div class="col-md-6 col-sm-12  form-group">
                      <label for="fullname">Meta Keywords * :</label>
                      <input type="text" id="meta_keywords" class="form-control" name="meta_keywords" value="{{ $setting->meta_keywords }}" autocomplete="off" />
                      </div>



                      <br>    <br/>
                     <input type="submit" class="btn btn-primary" name="submit" value="Update">

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
