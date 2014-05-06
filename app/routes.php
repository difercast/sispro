<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/',array('as'=>'index', function()
{
	return View::make('login');
}));

/**
* Rutas de inicio y cierre de sesión
**/
Route::post('log','UserLogin@user');
Route::get('logout', 'UserLogin@out');

/**
* Rutas para las pantallas de inicio de sesión de los usuarios
* según el nivel al que pertenescan
**/
Route::get('admin', array('before' => 'auth','as'=>'administrador', function()
{
	return View::make('Admin.admin');
}));
Route::get('tecnico', array('before' => 'auth','as'=>'tecnico', function()
{
	return View::make('Admin.tecnico');
}));
Route::get('vendedor', array('before' => 'auth','as'=>'vendedor', function()
{
	return View::make('Admin.vendedor');
}));

Route::controller('empresa','EmpresaController');
Route::controller('sucursal','SucursalController');
Route::controller('user','UserController');
Route::controller('cliente','ClienteController');
Route::controller('equipo','EquipoController');
Route::controller('ordenTrabajo','OrdenController');

/**
* Carga los datos del cliente en el formulario de ingreso de una
* oden de trabajo
**/
Route::post('procesaCliente',function()
{
	
	$idCliente = Input::get('idCliente');
	$id = Cliente::find($idCliente);	
	$clientes =  array(		
		$id->nombres,
		$id->cedula,
		$id->direccion,
		$id->telefono,
		$id->celular,
		$id->email,
		$id->observaciones,
		$id->id
		);

	return $clientes;
});

//Route::post('empresa/editar', array('as' => 'empresa.editar', 'uses' => 'EmprController@editar'));




