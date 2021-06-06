<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('admin_media/production/images/favicon.ico')}}" type="image/ico" />


    <title>CRM!</title>

    <!-- Bootstrap -->
    <link href="{{ asset('admin_media/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('admin_media/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('admin_media/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('admin_media/vendors/animate.css/animate.min.css')}}" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="{{ asset('admin_media/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login" style="color: white">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">

            <form action="{{url('auth-check')}}" method="POST" id="form_login" >

           @if ($message = Session::get('status'))
           <div class="alert alert-danger alert-block" id="flassMessage">
            <!-- <button type="button" class="close">×</button>  -->
            <strong>{{ $message }}</strong>
            </div>
           @endif

              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" autocomplete="off" name="email" >
                @error('email')
              <div class="alert alert-danger" id="error">{{ $message }}</div>
               @enderror
                    {{ csrf_field() }}
              </div>
              <div>

                <input type="password" class="form-control" placeholder="password"  autocomplete="off" name="password" >
                 @error('password')
              <div class="alert alert-danger" id="error">{{ $message }}</div>
               @enderror
              </div>
              <div>
                <input type="submit" class="btn btn-default submit"  value="Login" name="submit">
                {{-- <a class="reset_pass" href="{{ route('password.request') }}"> --}}
                    <a class="reset_pass" href="">
                    {{ __('Forgot Your Password?') }}></a>
              </div>

              <div class="clearfix"></div>
              <div class="separator">
               <!--  <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>
 -->
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> CRM !</h1>
                  <p>©2020 All Rights Reserved.  CRM !. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
    <script type="text/javascript">
setTimeout(function() {
    $('#error').fadeOut("slow");
}, 3000); //
</script>
  </body>
</html>





<script type="text/javascript">
setTimeout(function() {
    $('#flassMessage').fadeOut("slow");
}, 3000); //
</script>
