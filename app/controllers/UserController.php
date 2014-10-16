<?php

class UserController extends \BaseController {

	public $restful = true;


	public function login(){

		$userdata = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
			);

		if(Auth::check()){
				return Redirect::to('/');
			}
		if(Auth::attempt($userdata)){
			//Check if the user is already logged in
			$user = UserModel::find(Auth::user()->id);
			Session::put('current_user', Input::get('username'));
			Session::put('user_access', $user->access);
			Session::put('user_id', $user->id);
			
			
			//if the user account is dissabled then send the user back to login script
			if($user->active==0){
				Auth::logout();
				Session::flush();
				return Redirect::to('login')
						->with('message',FlashMessage::DisplayAlert('Your acount is currently dissabled, please contact your administrator for additional details','danger'));
			} //end user active check

			
			return Redirect::to('/');
			
		} //End Auth Attempt 
		else{
			return Redirect::to('login')->with('message',FlashMessage::DisplayAlert('Incorrect Username/Password','danger'));
		}
	} //end of function login


	/**
	 * signup registro de usuarios
	 * @return redirect
	 */
	public function signup(){
		$today = date("Y-m-d H:i:s");

		$userdata = array(
			'givenname' => Input::get('givenname'),
			'surname' => Input::get('surname'),
			'username' => Input::get('username'),
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'password_confirmation' => Input::get('password_confirmation')
			);
		//set validation rules
		$rules = array(
			'givenname' =>'alpha_num|max:50',
			'surname' =>'alpha_num|max:50',
			'username' =>'required|unique:users,username|alpha_dash|min:5',
			'email' =>'required|unique:users,email|email',
			'password'=>'required|alpha_num|between:6,100|confirmed',
			'password_confirmation'=>'required|alpha_num|between:6,100'
		);

		//run validation rules
		$validator = Validator::make($userdata, $rules);

		//if validation fails I return the user to signup
		if($validator->fails()){
			
			return Redirect::back()
					->withInput()
					->withErrors($validator);
		}else{
			$user = new UserModel;
			$user->givenname = Input::get('givenname');
			$user->surname = Input::get('surname');
			$user->username = Input::get('username');
			$user->email = Input::get('email');
			$user->photo = "No Photo Found";
			$user->password = Hash::make(Input::get('password'));
			$user->active="1";
			$user->isdel = '0';
			$user->last_login = $today;
			$user->access = "User";
			
			$user->save();
		}//end else
		return Redirect::to('login')->with('message',FlashMessage::DisplayAlert('User account created','success'));;
	}//end signup


	public function forgotpassword(){

		//set the user array to gather data from the password recover form

		$userdata = array(
			'email'=>Input::get('email')
		);

		$rules = array(
			'email'=>'required|email'
		);

		$validator = Validator::make($userdata, $rules);

		if($validator->fails()){
			return Redirect::back()->withInput()->withErrors($validator);
		}else{
			$user = UserModel::where('email','=',Input::get('email'));
			if($user->count()){
				$user = $user->first();
				$resetcode = str_random(60);
				$passwd = str_random(15);

				$user->password_temp = Hash::make($passwd);
				$user->resetcode = $resetcode;

				if($user->save()){
					$data = array(
						'email'			=> $user->email,
						'firstname' 	=> $user->givenname,
						'lastname' 		=> $user->surname,
						'username' 		=> $user->username,
						'link' 			=> URL::to('resetpassword', $resetcode),
						'password'		=> $passwd

					);
					Mail::send('emails.auth.reminder',$data, function($message) use($user,$data)
					{
						$message->to($user->email, $user->givenname. ' ' . $user->lastname)
						->subject('Movie DB password recovery request');
					});

					return Redirect::to('login')->with('message', FlashMessage::DisplayAlert('User password reset link has been sent to your email','success'));
				} //end of if DB save
				//if the email does not match an email in the database display feedback
				
			}
			return Redirect::to('forgotpassword')->with('message', FlashMessage::DisplayAlert('Could not validate existing email address', 'danger'));
		}
	} //end forgotpassword

	public function resetpassword($resetcode){
		// Grab the user record where the user matches in the database
		$user = UserModel::where('resetcode', '=', $resetcode)->where('password_temp', '!=', '');

		if($user->count()){
			//Set the user variable to the first returned record
			$user = $user->first();

			//Set user password to the value stored in password temp and clear password temp and resetcode
			$user->password = $user->password_temp;
			$user->password_temp = '';
			$user->resetcode = '';
			if($user->save()){
				//if successful then send the user to the login 
				return Redirect::to('login')->with('message', FlashMessage::DisplayAlert('Your pasword has been reset. You can now login with the password sent to your e-mail', 'success'));
			}
			
			
		}//end user count
		// if no user record was found then inform the user that this was bad
		return Redirect::to('login')->with('message', FlashMessage::DisplayAlert('Could not recover account. Please contanct Administrator for further assistance', 'danger'));

	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
