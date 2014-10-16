<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $title }}</title>
	{{ HTML::style('/css/bootstrap.min.css') }}
	{{ HTML::style('/css/bootstrap-theme.css') }}
</head>
<body>
	<div id="nav">
		<div class="navbar navbar-inverse">
			<a href="" class="navbar-brand">Movie</a>
		</div><!-- end navbar div -->
	</div> <!-- end nav div -->
	<h2 style="text-align:center;">Signup</h2>
	<br><br>

	@if($errors->any())
	<ul>
		{{ implode('', $errors->all('<li>:message</li>')) }}
	</ul>
	@endif
	<center>
		<div class="well col-md-4 col-md-offset-4">
			<form method="post" action="{{ URL::to('signup') }}">

				<label>First Name</label><br>
				<input type="text" id="givenname" name="givenname" placeholder="First Name" required>
				<br><br>

				<label>Last Name</label><br>
				<input type="text" id="surname" name="surname" placeholder="Last Name" required>
				<br><br>

				<label>Username</label><br>
				<input type="text" id="username" name="username" placeholder="Username" required>
				<br><br>

				<label>Email</label><br>
				<input type="text" id="email" name="email" placeholder="E-mail Address" required>
				<br><br>

				<label>Password</label><br>
				<input type="password" id="password" name="password" placeholder="Password">
				<br><br>
				
				<label>Confirm Password</label><br>
				<input type="password" id="password_confirmation" name="password_confirmation" placeholder="Retype Password">
				<br><br>
				<button class="btn btn-success" type="submit" value="Signup">Signup</button>
				<br>
				<center> &copy; www.movie.app {{ date ('Y') }}</center>
			</form>
		</div>
	</center>
	<!-- javascript files required for page -->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	
</body>
</html>