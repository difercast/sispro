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
//Ruta de ingreso de clientes
Route::get('logCliente',function(){
	return View::make('loginCliente');	
});
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
	$cliente = Cliente::all();
	$select = array(0 => 'Seleccione...')+$cliente->lists('nombres','id');
	return View::make('Admin.tecnico')->with('cliente',$cliente);
}));
Route::get('vendedor', array('before' => 'auth','as'=>'vendedor', function()
{
	$cliente = Cliente::all();
	$select = array(0 => 'Seleccione...')+$cliente->lists('nombres','id');
	return View::make('Admin.vendedor')->with('cliente',$select);
}));
//Routes con controladores REstfull
Route::controller('empresa','EmpresaController');
Route::controller('sucursal','SucursalController');
Route::controller('user','UserController');
Route::controller('cliente','ClienteController');
Route::controller('equipo','EquipoController');
Route::controller('ordenTrabajo','OrdenController');
Route::controller('presupuesto','PresupuestoController');

Route::group(array('prefix'=>'informe'),function()
{
	//Primera ruta
	Route::get('/',function()
	{
		$sucursal = Sucursal::where('estado','=','1')->get();
		$select = array(0 => 'Todos')+$sucursal->lists('nombre','id');
		return View::make('informes.listaInformes')->with('sucursal',$select);
	});
	//Segunda ruta
	Route::post('ingresoEquipos', 'InformeController@ingreso');
});

/**
* Carga los datos del cliente en el formulario de ingreso de una
* oden de trabajo
**/
Route::post('procesaCliente',function()
{
	
	$idCliente = Input::get('idCli');
	$id = Cliente::findOrFail($idCliente);	
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





