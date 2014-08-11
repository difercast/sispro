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
//imprimir Informe de ingreso de órdenes de trabajo a la empresa
Route::get('ingresoPDF/{inicio}/{final}/{sucursal}', function($inicio,$final,$sucursal){
	if(isset($inicio) && isset($final) && isset($sucursal)){
		if($sucursal == '0'){
			$ordenes = Orden::whereBetween('fecha_ingreso',array($inicio,$final))
			->orderBy('id','desc')->get();				
			$html =  View::make('imprimir.infIngresos')->with(array('ordenes'=>$ordenes,'local'=>'Todos los locales',
				'inicio'=>$inicio,'final'=>$final));
			return PDF::load($html, 'A4', 'portrait')->show();
		}else{
			$ordenes = Orden::whereBetween('fecha_ingreso', array($inicio, $final))			
				->where('Sucursal_id','=',$sucursal)->orderBy('id','desc')
				->get();
			$sucur = Sucursal::findOrFail($sucursal);
			$html =  View::make('imprimir.infIngresos')->with(array('ordenes'=>$ordenes,'local'=>$sucur->nombre,
				'inicio'=>$inicio,'final'=>$final));
			return PDF::load($html, 'A4', 'portrait')->show();
		}
	}else{
		return Redirect::route('informes')->with('status','error');
	}					    	
});
//imprimir Informe de órdenes de trabajo ingresadas a la empresa por un usuario
Route::get('ingresoUserPDF/{inicio}/{final}/{user}',function($inicio,$final,$user){
	if(isset($inicio) && isset($final) && isset($user)){
		$ordenes = Orden::whereBetween('fecha_ingreso', array($inicio, $final))			
		->where('user_id','=',$user)->get();
		$usuario = User::findOrFail($user);
		$html = View::make('imprimir.infIngresoUser')->with(array('inicio'=>$inicio,'final'=>$final,'ordenes'=>$ordenes,
			'usuario'=>$usuario));		
		return PDF::load($html, 'A4', 'portrait')->show();
	}else{
		return Redirect::route('informes')->with('status','error');
	}
});

//Imprimir informe de órdenes de trabajo temrinadas por un técnico
Route::get('ordenTerminadaTecnicoPDF/{inicio}/{final}/{tecnico}',function($inicio,$final,$tecnico){
	if(isset($inicio) && isset($final) && isset($tecnico)){
		$ordenes = Orden::whereBetween('fecha_terminado',array($inicio,$final))
		->orderBy('id','desc')->get();			
		$tec = User::findOrFail($tecnico);
		$html = View::make('imprimir.infRepTerminada')->with(array('inicio'=>$inicio,'final'=>$final,
				'ordenes'=>$ordenes,'tecnico'=>$tec));
		return PDF::load($html,'A4','portrait')->show();
	}else{
		return Redirect::route('informes')->with('status','error');
	}
});

//Imprimir informe de órdenes de trabajo entregadas por un vendedor
Route::get('ordenEntregadaPDF/{inicio}/{final}/{vendedor}',function($inicio,$final,$vendedor){
	if(isset($inicio) && isset($final) && isset($vendedor)){
		$ordenes = Orden::whereRaw('entregado = ? and vendedor_id = ?', array('1',$vendedor))
		->orderBy('id','desc')->get();			
		$vend = User::findOrFail($vendedor);		
		$html = View::make('imprimir.infOrdenEntregada')->with(array('ordenes'=>$ordenes,'inicio'=>$inicio,'final'=>$final,
			'vendedor'=>$vend));
		return PDF::load($html, 'A4', 'portrait')->show();
	}else{
		return Redirect::route('informes')->with('status','error');
	}
});

//Imprimir informe de órdenes de trabajo terminadas por un técnico y entregadas a l cliente
Route::get('ordenRepEntregadaPDF/{inicio}/{final}/{tecnico}',function($inicio,$final,$tecnico){
	if(isset($inicio) && isset($final) && isset($tecnico)){
		$ordenes = Orden::whereBetween('fecha_terminado',array($inicio,$final))
		->whereRaw('entregado = ? and tecnico = ?',array('1',$tecnico))
		->orderBy('id','desc')->get();
		$tec = User::findOrFail($tecnico);			
		$html = View::make('imprimir.infOrdenTermEntregada')->with(array('tecnico'=>$tec,'inicio'=>$inicio,'final'=>$final,
			'ordenes'=>$ordenes));
		return PDF::load($html,'A4','portrait')->show();
	}else{
		return Redirect::route('informes')->with('status','error');
	}
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
//Route::controller('informe','InformeController');


Route::group(array('prefix'=>'informe'),function()
{
	//Primera ruta
	Route::get('/',array('as'=>'informes',function()
	{
		$sucursal = Sucursal::where('estado','=','1')->get();
		$select = array(0 => 'Todos')+$sucursal->lists('nombre','id');

		$users = User::where('rol','!=','administrador');
		$user = $users->lists('nombres','id');

		$tecnicos = User::where('rol','=','tecnico');
		$listaTecnicos = $tecnicos->lists('nombres','id');

		$vendedor = User::where('rol','=','vendedor');
		$vendedores = $vendedor->lists('nombres','id');
		//todos los usuarios
		/*$users = User::all();
		$user = $users->lists('nombres','id');
		//Usuarios con rol Técnico
		$tec = User::where('rol','=','tecnico')->get();
		$tecnico = $tec->lists('nombres','id');
		//Usuarios con rol vendedor
		$ven = User::where('rol','=','vendedor')->get();
		$vendedor = array(0 => 'Todos')+$ven->lists('nombres','id');
		return View::make('informes.listaInformes')->with(array('sucursal'=>$select,'user'=>$user,'tecnicos'=>$tecnico,
			'vendedores'=>$vendedor));*/				
		return View::make('informes.listaInf')->with(array('sucursal'=>$select,'user'=>$user,'tecnicos'=>$listaTecnicos,
			'vendedores'=>$vendedores));
	}));
	//Segunda ruta
	Route::get('ingreso', 'InformeController@ingreso');
	Route::get('ingresoUser', 'InformeController@ingresoUser');
	Route::get('repTerminadas', 'InformeController@RepTerminadas');
	Route::get('ordenEntreg', 'InformeController@ordenesEntregadas');
	Route::get('ordenEntTecnico','InformeController@OnderRepEntTecnico');
	//Imprimir informes
	//Route::get('ingresoPDF','InformeController@ingresoPDF');
	
	Route::post('ingresoEquiposUser','InformeController@ingresoUsers');
	Route::post('reparadosTecnico','InformeController@reparadosTecnico');
	Route::post('sinRevisar','InformeController@ordenesSinRevisar');
	Route::post('entregadosPorVendedor', 'InformeController@entregadosVendedor');
	Route::post('repTecnicoEntr', 'InformeController@repTecnicoEntregados');
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





