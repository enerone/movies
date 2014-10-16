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
	@if(Session::has('message'))
		<center>{{ Session::get('message') }}</center>
		<br><br>
	@endif

	<h2 style="text-align:center;">Reset User Password</h2>
	<br><br>

	
	

	@if($errors->any())
	<ul>
		{{ implode('', $errors->all('<li>:message</li>')) }}
	</ul>
	@endif

	<center>
		<div class="well col-md-4 col-md-offset-4">
			<form method="post" action="{{ URL::to('forgotpassword') }}">
				<label>Please type in your registered email address</label><br>
				<input type="text" id="email" name="email" placeholder="E-mail Address">
				<br><br>
				<button class="btn btn-success" type="submit" value="Login">Submit</button>
				<br><br>
				<div>
					
					<center> &copy; www.movie.app {{ date ('Y') }}</center>

				</div>
			</form>
		</div>
	</center>
	<!-- javascript files required for page -->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	
</body>
</html>