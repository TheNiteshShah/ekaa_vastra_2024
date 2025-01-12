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

		span.fa {
			float: right;
			color: #FF5722;
			line-height: 1.5;
			/* margin-left: 10px; */
			margin-right: 10px;
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
			<div class="sub-main-w3" style="box-shadow: 0px 0px 20px 0px rgb(153 153 153 / 75%)">
				<div class="w-100 text-center">
					<img src="{{asset('frontend/img/logo.svg')}}" alt="logo" width="180" class="img-fluid">
				</div>
				<h2 style="color:#292929">Login</h2>


				<!-- show success and error messages -->
				@if (session('success'))
				<div class="alert alert-success" role="alert">
					{{ session('success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				</div>
				@endif
				@if (session('error'))
				<div class="alert alert-danger" role="alert">
					{{ session('error') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				</div>
				@endif
				<!-- End show success and error messages -->


				<form action="{{route('admin_login_process')}}" method="post">
					@csrf
					<div class="pom-agile">
						<span class="fa fa-user-o" aria-hidden="true"></span>
						<input placeholder="Username" name="email" class="user" type="email" required="">
					</div>
					<div class="pom-agile">
						<span class="fa fa-key" aria-hidden="true"></span>
						<input placeholder="Password" name="password" class="pass" type="password" required="">
					</div>
					<div class="sub-w3l">

						<!-- <a href="#" id="butpas">Forgot Password?</a> -->
						<div class="clear"></div>
					</div>
					<div class="w-100 text-center right-w3l">
						<input type="submit" value="Login">
					</div>
				</form>
				<br />
				<form action="{{route('admin_change_password')}}" method="post">
					@csrf
					<div id="passrst1" style="display:none;">
						<div class="pom-agile">
							<span class="fa fa-user-o" aria-hidden="true"></span>
							<input placeholder="Enter Email to reset password" name="email" class="user" type="email" required="">
						</div>
						<div class="w-100 text-center right-w3l">
							<input type="submit" value="Reset">
						</div>
					</div>
				</form>
			</div>
		</div>
		<!--//main-->
		<!--footer-->

		<!--//footer-->
	</div>

	<!-- js -->
	<script src="{{asset('admin/login/js/jquery-2.1.4.min.js')}}"></script>
</body>

</html>