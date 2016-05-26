<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return View::make('ci.restricted');
	}

	public function postRegister()
	{
		$rules = array(
			'username' => 'required|min:5',
			'email' => 'email|required|min:5',
		);
		$validator = Validator::make(Input::all(), $rules);

		if($validator->passes())
		{
			try
			{
				DB::transaction(function()
				{
					$user = new User(Input::all());
					$person = new Person(Input::all());
					$user->save();
					$user->person()->save($person);
					//$user->verified = 1;

					Mail::send('emails.welcome', array('user'=>$user), function($message)
					{
						$message->to(Input::get('email'), Input::get('username'))->subject('Bienvenido!');
					});
					//$user->person()->save($person);
					//$user->roles()->attach(3);
					//$user->save();
				});
			}catch (Exception $e) {
				return Redirect::to('registro')->with('message', 'No se pudo completar tu registro, intentalo nuevamente. ' . $e->getMessage());
			}
			return Redirect::to('login')->with('message', 'Por favor verifica tu correo y sigue las instrucciones para completar tu registro.');
		}else{
			return Redirect::to('registro')->with('message', 'Por favor completa todos los campos. ' . print_r(Input::all(), true));
		}
	}

	public function anyLogin()
	{
		
		try
		{
			Auth::attempt(array(
				'dni' => Input::get('l_username'),
				'password' => Input::get('l_password')
			));
			if(Auth::user()->is('Administrador'))
				return Redirect::to('/admin');
			
			elseif(Auth::user()->is('Alumno')){
                		return Redirect::to('/user');
            		}elseif(Auth::user()->is('Tutor')){
                		return Redirect::to('/publisher');
            		}else
				return Redirect::to('/login');
		}catch (Exception $e)
		{
			$msg = 'Error desconocido';
			switch(get_class($e))
			{
				case 'Toddish\Verify\UserNotFoundException':
					$msg = 'No podemos encontrar este nombre de usuario';
					break;
				case 'Toddish\Verify\UserUnverifiedException':
					$msg = 'Tu usuario no se encuentra verificado, por favor revisa tu correo o contacta a un administrador';
					break;
				case 'Toddish\Verify\UserDisabledException':
					$msg = 'Tu usuario se encuentra deshabilitado';
					break;
				case 'Toddish\Verify\UserDeletedException':
					$msg = 'Este usuario a sido eliminado';
					break;
				case 'Toddish\Verify\UserPasswordIncorrectException':
					$msg = 'Por favor verifica tu contraseña.';
					break;
			}

		 	return Redirect::to('/login')->withErrors($msg);
		}
	}

	public function anyLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}

	public function anyVerify($_code)
	{
		$user = User::where('salt', '=', $_code)->first();

		if($user)
		{
			$user->verified = 1;
			$user->save();
		}

		return Redirect::to('login')->with('message', 'Tu cuenta a sido verificada, por favor inicia sesión.');
	}
}