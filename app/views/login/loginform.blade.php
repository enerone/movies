@extends('layouts.default')
	
	
@section('content')
	<h2 style="text-align:center;">Login</h2>
	<br><br>

	
	

	@if($errors->any())
	<ul>
		{{ implode('', $errors->all('<li>:message</li>')) }}
	</ul>
	@endif

	<center>
		<div class="well col-md-4 col-md-offset-4">
			<form method="post" action="{{ URL::to('login') }}">
				<label>Username</label><br>
				<input type="text" id="username" name="username" placeholder="Username">
				<br><br>
				<label>Password</label><br>
				<input type="password" id="password" name="password" placeholder="Password">
				<br><br>
				<button class="btn btn-success" type="submit" value="Login">Login</button>
				<br><br>
				<div>
					<p>Need an account? {{ HTML::link('signup', 'Signup here') }}</p>
					<p>Forgot Your Password? {{ HTML::link('forgotpassword', 'Reset Password here!') }}</p>
					<br><br>
					<center> &copy; www.movie.app {{ date ('Y') }}</center>

				</div>
			</form>
		</div>
	</center>
@stop