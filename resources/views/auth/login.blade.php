<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Login - Bootstrap Admin Template</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<link href="../resources/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../resources/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

	<link href="../resources/css/font-awesome.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

	<link href="../resources/css/style.css" rel="stylesheet" type="text/css">
	<link href="../resources/css/pages/signin.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

</head>

<body>

	<div class="navbar navbar-fixed-top">

		<div class="navbar-inner">

			<div class="container">

				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<a class="brand" href="{{ route('trangchu') }}">
					Bootstrap Admin Template
				</a>

				<div class="nav-collapse">
					<ul class="nav pull-right">

						<li class="">
							<a href="{{ route('register') }}" class="">
								Don't have an account?
							</a>

						</li>

						<li class="">
							<a href="{{ route('trangchu') }}" class="">
								<i class="icon-chevron-left"></i>
								Back to Homepage
							</a>

						</li>
					</ul>

				</div>
				<!--/.nav-collapse -->

			</div> <!-- /container -->

		</div> <!-- /navbar-inner -->

	</div> <!-- /navbar -->

	<div class="account-container">

		<div class="content clearfix">

			<form action="{{ route('login') }}" method="post">
				@csrf
				<h1>Member Login</h1>

				<div class="login-fields">

					<p>Please provide your details</p>

					<div class="field">
						<label for="username">Username</label>
						<input type="text" id="username" name="email" value="" placeholder="Username" class="login username-field form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus />
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div> <!-- /field -->

					<div class="field">
						<label for="password">Password:</label>
						<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field form-control @error('password') is-invalid @enderror" required autocomplete="current-password" />
						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div> <!-- /password -->
					@if (isset($note))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $note }}</strong>
					</span>
					@endif
				</div> <!-- /login-fields -->

				<div>
					@if (session()->has('messageLoginError'))
					<div class="alert alert-danger">
						{{ session('messageLoginError') }}
					</div>
					@endif
				</div>
				
				<div class="login-actions">

					<span class="login-checkbox">
						<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
						<label class="choice" for="Field">Keep me signed in</label>
					</span>

					<button class="button btn btn-success btn-large">Sign In</button>

				</div> <!-- .actions -->

			</form>

		</div> <!-- /content -->

	</div> <!-- /account-container -->

	<div class="login-extra">
		@if (Route::has('forget.password.get'))
		<a href="{{ route('forget.password.get') }}">
			{{ __('Forgot Your Password?') }}
		</a>
		@endif
	</div> <!-- /login-extra -->

	<script src="/phone/resources/js/jsbe/jquery-1.7.2.min.js"></script>
	<script src="/phone/resources/js/jsbe/bootstrap.js"></script>
	<script src="/phone/resources/js/jsbe/signin.js"></script>

</body>

</html>