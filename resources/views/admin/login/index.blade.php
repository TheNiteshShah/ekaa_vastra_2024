<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>Login | {{config('constants.options.SITE_NAME')}}</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" href="{{asset('admin/assets/images/favicon.png')}}">
	<meta name="keywords" content="" />
	<script>
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- Meta tag Keywords -->
	<!-- css files -->
	<link rel="stylesheet" href="{{asset('admin/login/css/style.css')}}" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="{{asset('admin/login/css/font-awesome.css')}}">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<!-- //web-fonts -->
	<style>
		.pom-agile {
			display: flex;
		}

		.sub-main-w3 i {
			margin-left: 0;
		}

		span.fa {
			float: right;
			color: #FF5722;
			line-height: 1.5;
			/* margin-left: 10px; */
			margin-right: 10px;
		}

		.toggle-password {
			position: absolute;
			right: 15px;
			top: 50%;
			transform: translateY(-50%);
			font-size: 16px;
			color: #333;
		}

		.pom-agile {
			position: relative;
		}
	</style>

</head>

<body>
	<div class="video-w3l">
		<!--header-->
		<!-- <div class="header-w3l">
			<div class="w-100 text-center">
				<img src="{{asset('frontend/img/logo.svg')}}" alt="logo" width="300" class="img-fluid">
			</div>
		</div> -->
		<!--//header-->
		<div class="main-content-agile">
			<div class="sub-main-w3 panel panel-default" style="max-width: 600px; margin: 50px auto; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);">
				<div class="panel-body">
					<!-- Logo -->
					<div class="text-center">
						<img src="{{asset('frontend/img/logo.svg')}}" alt="logo" width="180" class="img-responsive center-block" />
					</div>

					<!-- Title -->
					<h2 class="text-center" style="color:#292929; margin-top: 20px;">Login</h2>

					<!-- Success and Error Messages -->
					@if (session('success'))
					<div class="alert alert-success alert-dismissible" role="alert">
						{{ session('success') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
					@if (session('error'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						{{ session('error') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif

					<!-- Login Form -->
					<form action="{{ route('admin_login_process') }}" method="post" class="form-horizontal">
						@csrf
						<div class="form-group">
							<label for="email" class="control-label">Username</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user-o"></i>
								</div>
								<input id="email" name="email" type="email" class="form-control" placeholder="Enter your email" required autocomplete="username" />
							</div>
						</div>
						<div class="form-group">
							<label for="passwordField" class="control-label">Password</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-key"></i>
								</div>
								<input id="passwordField" name="password" type="password" class="form-control" placeholder="Enter your password" required autocomplete="current-password" />
								<div class="input-group-addon" style="cursor: pointer;" onclick="togglePasswordVisibility()">
									<i id="eyeIcon" class="fa fa-eye"></i>
								</div>
							</div>
						</div>
						<div class="form-group text-center" style="margin-top: 35px;">
							<button type="submit" class="btn btn-block" style="color: #fff;
    background: #292929;">Login</button>
						</div>
					</form>

					<!-- Forgot Password -->
					<!-- <div class="text-center">
						<a href="#" id="butpas" onclick="document.getElementById('passrst1').style.display='block'" class="text-primary" style="text-decoration: none;">
							Forgot Password?
						</a>
					</div> -->

					<!-- Password Reset Form -->
					<form action="{{route('admin_change_password')}}" method="post" class="form-horizontal" style="margin-top: 20px;">
						@csrf
						<div id="passrst1" style="display: none;">
							<div class="form-group">
								<label for="reset-email" class="control-label">Enter Email to Reset Password</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-envelope"></i>
									</div>
									<input id="reset-email" name="email" type="email" class="form-control" placeholder="Enter your email" required />
								</div>
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn btn-primary btn-block">Reset</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--//main-->
		<!--footer-->

		<!--//footer-->
	</div>

	<!-- js -->
	<script src="{{asset('admin/login/js/jquery-2.1.4.min.js')}}"></script>

	<script>
		function togglePasswordVisibility() {
			const passwordField = document.getElementById("passwordField");
			const eyeIcon = document.getElementById("eyeIcon");

			if (passwordField.type === "password") {
				passwordField.type = "text";
				eyeIcon.classList.remove("fa-eye");
				eyeIcon.classList.add("fa-eye-slash");
			} else {
				passwordField.type = "password";
				eyeIcon.classList.remove("fa-eye-slash");
				eyeIcon.classList.add("fa-eye");
			}
		}
	</script>

</body>

</html>