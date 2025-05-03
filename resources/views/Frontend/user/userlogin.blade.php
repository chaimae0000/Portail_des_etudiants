<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>HTML Codex - Login Form Template</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="Login Form Template" name="keywords">
	<meta content="Login Form Template" name="description">

	<!-- Favicon -->
	<link href="img/favicon.ico" rel="icon">

	<!-- Stylesheet -->
	<link href="{{ asset('assets/css/loginstyle.css') }}" rel="stylesheet">

</head>

<body>
	<div class="wrapper login-3">
		<div class="container">
			<div class="col-left">
				<div class="login-text">
					<h2>Vie EMSI</h2>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada vel libero vitae eleifend. Fusce tristique ipsum lorem.
					</p>
					<a class="btn" href="">Read More</a>
				</div>
			</div>
			<div class="col-right">
				<div class="login-form">
					<h2>Login</h2>
					<form method="POST" action="{{ route('login.submit') }}">
						@csrf
						<p>
							<input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
						</p>
						<p>
							<input type="password" name="password" placeholder="Password" required>
						</p>
						<p>
							<input class="btn" type="submit" value="Sign In" />
						</p>
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif

						<p>

							<a href="{{ route('register') }}">Create an account.</a>
						</p>
					</form>

				</div>
			</div>
		</div>

	</div>
</body>

</html>