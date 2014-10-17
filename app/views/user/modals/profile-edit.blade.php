<html>
<body>
	<!-- ############################ Initialize modal window for user details #######-->
		
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="modal-title" id="myModalLabel">Edit user profile</h3>
					</div><!--end modal header-->
					<div class="modal-body">
						

						<?php 
						$access= Session::get('user_access'); 
						$userid = Session::get('user_id');
						?>
						{{ Form::open(array('method'=>'POST', 'route' => 'users.store', 'style' => 'display:inline')) }}
							@foreach ($user as $userinfo)
								<!-- set hidden element with user id embedded -->
								<input type="hidden" name="id" value="{{ $userid }}">

								//Display username
								<h2 style="align:center;">{{ $userinfo->username }}</h2>
								<br><br>
								<div class="container col-md-offset-1">
									<div class="row col-md-3">
										<div>
											{{  Form::label('givenname', 'First Name:') }} <br>
											<input type="text" name="givenname" id="givenname" value="{{ $userinfo->givenname }}">
										</div><br>
										
										<div>
											{{  Form::label('surname', 'Last Name:') }} <br>
											<input type="text" name="surname" id="surname" value="{{ $userinfo->surname }}">
										</div><br>

										<div>
											{{ Form::label('email', 'E-mail:') }}<br>
											<input type="text" name="email" id="email" value="{{ $userinfo->email }}">
										</div><br>

									</div> <!-- end first row -->
									
									<div class="row col-md-3">
										<div>
											{{  Form::label('password', 'New Password:') }} <br>
											<input type="password" name="password" id="password" value="{{ $userinfo->password }}">
										</div><br>
										
										<div>
											{{  Form::label('password_confirmation', 'Confirm the new password:') }} <br>
											<input type="password" name="password_confirmation" id="password_confirmation" value="{{ $userinfo->password  }}">
										</div><br>

										<div>
											{{ Form::label('useraccess', 'Current Membership Status:') }} <br>
											{{ $access }}
										</div><br>
									</div> <!-- end second row -->
								</div> <!-- end container -->
							@endforeach

						{{ Form::submit('Save', array('class'=>'btn btn-warning')) }}
						{{ Form::close() }}



					</div> <!-- end modal body -->
					<div class="modal-footer">
						
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
						
					</div> <!-- end modal footer -->
				</div><!-- end modal content -->
			</div><!-- end modal dialog -->
		
</body>
</html>