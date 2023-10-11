<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Đăng kí tài khoản</title>
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
    <?php if(isset($_GET["notify"]) && $_GET["notify"] == "emailExists"): ?>
    <!-- <div class="alert alert-warning">Email đã tồn tại</div> -->
    <script type="text/javascript">alert('Email đã tồn tại!');</script>
  <?php endif; ?>
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">
				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
                <div class="col-md-4 pr-md-0">
                  <div class="auth-left-wrapper">
                  	<img style="width: 100%; height: 100%;" src="{{ asset('assets/frontend/images/destination-img.jpg') }}">
                  </div>
                </div>
                <div class="col-md-8 pl-md-0">
                    <div class="auth-form-wrapper px-4 py-5">
                        <a href="#" class="noble-ui-logo d-block mb-2"><span>Trizen</span></a>
                        <h5 class="text-muted font-weight-normal mb-4">Lấy lại mật khẩu</h5>
                        <form class="forms-sample" method="post" action="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="email" value="{{ old('email') }}" required class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu</label>
                            <input type="password" name="password" required class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" required class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                        </div>
                        @if ($errors->any())
                            <div style="color: red;">{{ $errors->first() }}</div>
                        @endif
                        @if ( Session::has('error') )
                            <div style="color: red;">{{ Session::get('error') }}</div>
                        @endif
                      <div class="mt-3">
                      	<input type="submit" value="Xác nhận" class="btn btn-primary">
                      </div>
                      <a href="./login" class="d-block mt-3 text-muted"><span style="color: blue;">Đăng nhập</span></a>
                    </form>
                  </div>
                </div>
              </div>
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