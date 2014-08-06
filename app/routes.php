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
route::get('ejemplo',function(){
	$orden = Orden::findOrFail(20);
	$html = View::make('imprimir.impOrden')->with('orden',$orden->id);
	return PDF::load($html, 'A4', 'portrait')->show();					    	
});
/**
* Rutas de inicio y cierre de sesión
**/
Route::post('log','UserLogin@user');
//Ruta de ingreso de clientes
Route::get('logCliente',function(){
	return View::make('loginCliente');	
});
Route::get('logout', 'UserLogin@out');



/*Rutas para generar documentos PDF*/
//Ingreso orden 
Route::get('ingOrden/{numOrden}', function($numOrden){
	$orden = Orden::findOrFail($numOrden);
	$userRecep = User::findOrFail($orden->user_id);
	$sucursal = Sucursal::findOrFail($userRecep->sucursal_id);
	$empresa = Empresa::findOrFail($sucursal->empresa_id);
	$cliente = Cliente::findOrFail($orden->cliente_id);
	$equipo = Equipo::findOrFail($orden->equipo_id);
	$tecnico = User::findOrFail($orden->tecnico);	
	$html = View::make('imprimir.ingresoOrdenImp')->with(array('sucursal'=>$sucursal,'empresa'=>$empresa,'orden'=>$orden,
		'cliente'=>$cliente,'equipo'=>$equipo,'usuario'=>$userRecep,'tecnico'=>$tecnico));	
	return PDF::load($html, 'A4', 'portrait')->show();					    	

});

//Equipos ingresados
Route::get('infIngresoOrden/{sucursal}/{inicio},{final}', function($sucursal, $inicio, $orden){
	$suc = Sucursal::findOrFail(User::findOrFail(Auth::user()->sucursal_id));
	$empresa = Empresa::findOrFail($suc->empresa_id);
});
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
Route::controller('informe','InformeController');
Route::controller('informes','InformeController');

/**************************************************************
Route::group(array('prefix'=>'informe'),function()
{
	//Primera ruta
	Route::get('/',function()
	{
		$sucursal = Sucursal::where('estado','=','1')->get();
		$select = array(0 => 'Todos')+$sucursal->lists('nombre','id');
		//todos los usuarios
		$users = User::all();
		$user = $users->lists('nombres','id');
		//Usuarios con rol Técnico
		$tec = User::where('rol','=','tecnico')->get();
		$tecnico = $tec->lists('nombres','id');
		//Usuarios con rol vendedor
		$ven = User::where('rol','=','vendedor')->get();
		$vendedor = array(0 => 'Todos')+$ven->lists('nombres','id');
		return View::make('informes.listaInformes')->with(array('sucursal'=>$select,'user'=>$user,'tecnicos'=>$tecnico,
			'vendedores'=>$vendedor));
	});
	//Segunda ruta
	Route::post('ingresoEquipos', 'InformeController@ingreso');
	Route::post('ingresoEquiposUser','InformeController@ingresoUsers');
	Route::post('reparadosTecnico','InformeController@reparadosTecnico');
	Route::post('sinRevisar','InformeController@ordenesSinRevisar');
	Route::post('entregadosPorVendedor', 'InformeController@entregadosVendedor');
	Route::post('repTecnicoEntr', 'InformeController@repTecnicoEntregados');
});
***********************************************************************************/

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





