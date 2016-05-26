<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('auth.admin', function()
{
	if(Auth::check())
	{
		if (!Auth::user()->level(10, '='))
			return Redirect::to('login');
	}else{
		return Redirect::to('login');
	}

});
Route::filter('auth.user', function()
{
    if(Auth::check())
    {
        if (!Auth::user()->is('Alumno'))
            return Redirect::to('/');
    }else{
        return Redirect::to('/login');
    }

});
Route::filter('auth.publisher', function()
{
    if(Auth::check())
    {
        if (!Auth::user()->is('Tutor'))
            return Redirect::to('/');
    }else{
        return Redirect::to('/login');
    }

});
/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('security',function(){
    $r = new ApiResponse();
    //HASH javier+5= fd555db9c28ec511d971e49d803765685a2320b9;
    $hash=sha1(Input::get('user').Input::get('random'));
    if(Input::get('hash')!=$hash)
    {
        $r->status->code = '220';
        $r->status->description = 'Usted no cuenta con los permisos necesarios';
        return Response::json($r);
    }

});



