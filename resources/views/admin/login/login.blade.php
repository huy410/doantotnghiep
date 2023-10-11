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
                    <div class="auth-form-wrapper px-4 py-5" >
                      <div style="margin-bottom: 20px; width:200px; height:100px;position: relative; overflow: hidden">
                        <h1 style="font-size: 50px; color:pink;">SERAWI</h1>
                      </div>
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
                        <a href="{{ route('admin.forgotPassword') }}" class="d-block mt-3 text-muted"><span style="color: blue;">Quên mật khẩu</span></a>
                        <div class="mt-3">
                          <input type="submit" value="Login" class="btn btn-primary">
                        </div>
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
	<!-- core:js -->
	<script src="{{ asset('assets/backend/vendors/core/core.js') }}"></script>
	<!-- endinject -->
  <!-- plugin js for this page -->
	<!-- end plugin js for this page -->
	<!-- inject:js -->
	<script src="{{ asset('assets/backend/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/template.js') }}"></script>
	<!-- endinject -->
  <!-- custom js for this page -->
	<!-- end custom js for this page -->
</body>
</html>