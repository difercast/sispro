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
	if (Auth::guest()) return Redirect::guest('/');
});



Route::filter('auth.basic', function()
{
	return Auth::basic('username');
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

/*
//Filtro para verificar los roles de usuario
Route::filter('roles',funtion($ruta,$peticion,$roles,$redirect)
{		
	if(!in_array(Auth::user()->rol,$roles))
	{
		return Redirect::to($redirect);
	}
			
});

*/

/*
|--------------------------------------------------------------------------
| Filtro de protección de ingreso
|--------------------------------------------------------------------------
|
| El filtro de verificación de ingreso, realiza la validación de que un usuario pueda 
| ingresar a una página si está autorizado, si tiene los privilegios 
| requeridos y si es un usuario activo.
*/

Route::filter('autenticacion', function()
{
	$idSuc = Auth::user()->sucursal_id;
    $sucursal = Sucursal::find($idSuc);
    $estadoSuc = $sucursal->estado;

	if(Auth::user()->rol != 'administrador' || Auth::user()->estado != '1' || $estadoSuc != '1')
	{
		return Redirect::guest('/');
	}
});

Route::filter('authTecnico', function()
{
	$idSuc = Auth::user()->sucursal_id;
    $sucursal = Sucursal::find($idSuc);
    $estadoSuc = $sucursal->estado;

	if(Auth::user()->rol != 'tecnico' || Auth::user()->estado != '1' || $estadoSuc != '1')
	{
		return Redirect::guest('/');
	}
});

Route::filter('authVendedor', function()
{
	$idSuc = Auth::user()->sucursal_id;
    $sucursal = Sucursal::find($idSuc);
    $estadoSuc = $sucursal->estado;

	if(Auth::user()->rol != 'vendedor' || Auth::user()->estado != '1' || $estadoSuc != '1')
	{
		return Redirect::guest('/');
	}
});

Route::filter('authAny', function()
{
	$idSuc = Auth::user()->sucursal_id;
    $sucursal = Sucursal::find($idSuc);
    $estadoSuc = $sucursal->estado;

	if(Auth::user()->estado != '1' || $estadoSuc != '1')
	{
		return Redirect::guest('/');
	}
});


