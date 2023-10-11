<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>NobleUI Responsive Bootstrap 4 Dashboard Template</title>
	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/core/core.css') }}">
	<!-- endinject -->
  <!-- plugin css for this page -->
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('assets/backend/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<!-- endinject -->
  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{ asset('assets/backend/css/demo_1/style.css') }}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{ asset('assets/backend/images/favicon.png') }}" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
 

	<div class="main-wrapper">    
		<div class="page-wrapper full-page">      
			<div class="page-content d-flex align-items-center justify-content-center">       
          <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
              <div class="card">
                <form method="post" action="">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                  
                  <div class="col-md-4 pr-md-0">
                    <div class="auth-left-wrapper">
                      <img  style="width: 100%; height: 100%;" src="{{ asset('uploads/login_banner2.jpg') }}">
                    </div>
                  </div>
                  <div class="col-md-8 pl-md-0">
                    <div class="auth-form-wrapper px-4 py-5">
                      <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
                    
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="text" name="email" value="{{ old('email') }}" required class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" name="password"  value="{{ old('password') }}" required class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                        </div>

                        @if ($errors->any())
                          <div style="color: red;">{{ $errors->first() }}</div>
                        @endif
                        @if ( Session::has('error') )
                        <div style="color: red;">{{ Session::get('error') }}</div>
                        @endif
                        @if (Session::has('message'))
                        <div style="color: red;">{{ Session::get('message') }}</div>
                        @endif

                        <a href="{{ route('LoginController.forgotPassword') }}" class="d-block mt-3 text-muted"><span style="color: blue;">Quên mật khẩu</span></a>
                        <div class="form-check form-check-flat form-check-primary">
                          <label class="form-check-label">
                            <input type="checkbox" name="remember" class="form-check-input" onclick="check()">
                            Remember me
                          </label>
                        </div>
                       
                        <div class="mt-3">
                          <input type="submit" value="Login" class="btn btn-primary">
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                          <a class="btn" href="{{ url('auth/facebook') }}"
                              style="background-color: #3B5499; color: #ffffff; padding: 8px; width: 40%; text-align: center; display: block; border-radius:4px;">
                              Login with Facebook
                          </a>
                        </div> 
                        <a href="{{ route('frontend.register') }}" class="d-block mt-3 text-muted">Bạn chưa là thành viên? <span style="color: blue;">Đăng ký</span></a>
                    </div>
                  </div>
                </div>     
              </form>
            </div>
          </div>
        </div>   
			</div>
		</div>
	</div>

  <script type="text/javascript">
      $('#reload').click(function () {
          $.ajax({
              type: 'GET',
              url: '/reload-captcha',
              success: function (data) {
                  $(".captcha span").html(data.captcha);
              }
          });
      });

  </script>

	<script src="{{ asset('assets/backend/vendors/core/core.js') }}"></script>
	<script src="{{ asset('assets/backend/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/template.js') }}"></script>
</body>
</html>