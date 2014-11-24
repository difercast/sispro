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

/*
|--------------------------------------------------------------------------
| inicio y cierre de sesión
|--------------------------------------------------------------------------
|
| Rutas de inicio y cierre de sesión deusuarios y clientes para el ingreso
| al sistema
|
*/
//Ruta de ingreso de usuarios del sistema
Route::post('log','UserLogin@user');
//Ruta de ingreso de clientes
Route::get('logCliente',function(){
	return View::make('loginCliente');	
});
//Ruta de cierre de sesión
Route::get('logout', 'UserLogin@out');



/*
|--------------------------------------------------------------------------
| Generación de documentos PDF
|--------------------------------------------------------------------------
|
| En estas rutas se genrarán los documentos en formato PDF
| de los informes seleccionados por el administrador del sistema,
| de ingreso de una orden de trabajo nueva, y el detalle de una orden de trabajo
|
*/

//Ingreso orden 
Route::get('ingOrden/{numOrden}', function($numOrden){
	$orden = Orden::findOrFail($numOrden);
	$html = View::make('imprimir.impOrden')->with('orden',$orden);		
	return PDF::load(utf8_decode($html), 'A4', 'portrait')->show();					    	
});

//Detalle de orden
Route::get('DetalleOrden/{orden}', function($orden){
	$ordenTrabajo = Orden::findOrFail($orden);
	$html = View::make('imprimir.detalleOrden')->with('orden',$ordenTrabajo);
	return PDF::load(utf8_decode($html), 'A4', 'portrait')->show();
});

//imprimir Informe de ingreso de órdenes de trabajo a la empresa
Route::get('ingresoPDF/{inicio}/{final}/{sucursal}', function($inicio,$final,$sucursal){
	if(isset($inicio) && isset($final) && isset($sucursal)){
		if($sucursal == '0'){
			$ordenes = Orden::whereBetween('fecha_ingreso',array($inicio,$final))
			->orderBy('id','desc')->get();				
			$html =  View::make('imprimir.infIngresos')->with(array('ordenes'=>$ordenes,'local'=>'Todos los locales',
				'inicio'=>$inicio,'final'=>$final));
			return PDF::load(utf8_decode($html), 'A4', 'portrait')->show();
		}else{
			$ordenes = Orden::whereBetween('fecha_ingreso', array($inicio, $final))			
				->where('Sucursal_id','=',$sucursal)->orderBy('id','desc')
				->get();
			$sucur = Sucursal::findOrFail($sucursal);
			$html =  View::make('imprimir.infIngresos')->with(array('ordenes'=>$ordenes,'local'=>$sucur->nombre,
				'inicio'=>$inicio,'final'=>$final));
			return PDF::load(utf8_decode($html), 'A4', 'portrait')->show();
		}
	}else{
		return Redirect::route('informes')->with('status','error');
	}					    	
});

//imprimir Informe de órdenes de trabajo ingresadas a la empresa por un usuario
Route::get('ingresoUserPDF/{inicio}/{final}/{user}',function($inicio,$final,$user){
	if(isset($inicio) && isset($final) && isset($user)){
		$ordenes = Orden::whereBetween('fecha_ingreso', array($inicio, $final))			
		->where('user_id','=',$user)
		->orderBy('id','desc')->get();
		$usuario = User::findOrFail($user);
		$html = View::make('imprimir.infIngresoUser')->with(array('inicio'=>$inicio,'final'=>$final,'ordenes'=>$ordenes,
			'usuario'=>$usuario));		
		return PDF::load(utf8_decode($html), 'A4', 'portrait')->show();
	}else{
		return Redirect::route('informes')->with('status','error');
	}
});

//Imprimir informe de órdenes de trabajo terminadas por un técnico
Route::get('ordenTerminadaTecnicoPDF/{inicio}/{final}/{tecnico}',function($inicio,$final,$tecnico){
	if(isset($inicio) && isset($final) && isset($tecnico)){
		$ordenes = Orden::whereBetween('fecha_terminado',array($inicio,$final))
		->whereRaw('estado = ? and tecnico = ?',array('2',$tecnico))						
		->orderBy('id','desc')->get();			
		$tec = User::findOrFail($tecnico);
		$html = View::make('imprimir.infRepTerminada')->with(array('inicio'=>$inicio,'final'=>$final,
				'ordenes'=>$ordenes,'tecnico'=>$tec));
		return PDF::load(utf8_decode($html),'A4','portrait')->show();
	}else{
		return Redirect::route('informes')->with('status','error');
	}
});

//Imprimir informe de órdenes de trabajo entregadas por un vendedor
Route::get('ordenEntregadaPDF/{inicio}/{final}/{vendedor}',function($inicio,$final,$vendedor){
	if(isset($inicio) && isset($final) && isset($vendedor)){
		$ordenes = Orden::whereBetween('fecha_entregado',array($inicio,$final))
		->whereRaw('entregado = ? and vendedor_id = ?', array('1',$vendedor))
		->orderBy('id','desc')->get();			
		$vend = User::findOrFail($vendedor);		
		$html = View::make('imprimir.infOrdenEntregada')->with(array('ordenes'=>$ordenes,'inicio'=>$inicio,'final'=>$final,
			'vendedor'=>$vend));
		return PDF::load(utf8_decode($html), 'A4', 'portrait')->show();
	}else{
		return Redirect::route('informes')->with('status','error');
	}
});

//Imprimir informe de órdenes de trabajo terminadas por un técnico y entregadas al cliente
Route::get('ordenRepEntregadaPDF/{inicio}/{final}/{tecnico}',function($inicio,$final,$tecnico){
	if(isset($inicio) && isset($final) && isset($tecnico)){
		$ordenes = Orden::whereBetween('fecha_entregado',array($inicio,$final))
		->whereRaw('entregado = ? and tecnico = ?',array('1',$tecnico))
		->orderBy('id','desc')->get();
		$tec = User::findOrFail($tecnico);			
		$html = View::make('imprimir.infOrdenTermEntregada')->with(array('tecnico'=>$tec,'inicio'=>$inicio,'final'=>$final,
			'ordenes'=>$ordenes));
		return PDF::load(utf8_decode($html),'A4','portrait')->show();
	}else{
		return Redirect::route('informes')->with('status','error');
	}
});

//Imprimir informe de órdenes de trabajo entregadas en una sucursal
Route::get('ordenEntregadaSucPDF/{inicio}/{final}/{sucursal}',function($inicio,$final,$sucursal){
	if(isset($inicio) && isset($final) && isset($sucursal)){
		if($sucursal == '0'){
			$ordenes = Orden::whereBetween('fecha_entregado',array($inicio,$final))
			->where('entregado','=','1')->orderBy('id','desc')->get();						
			$html = View::make('imprimir.infOrdenEntregadaSuc')->with(array('sucursal'=>'Todos los locales','inicio'=>$inicio,
				'final'=>$final,'ordenes'=>$ordenes));
			return PDF::load(utf8_decode($html),'A4','portrait')->show();	
		}else{
			$ordenes = Orden::whereBetween('fecha_entregado',array($inicio,$final))
			->whereRaw('entregado = ? and Sucursal_id = ?',array('1',$sucursal))
			->orderBy('id','desc')->get();
			$suc = Sucursal::findOrFail($sucursal);
			$html = View::make('imprimir.infOrdenEntregadaSuc')->with(array('sucursal'=>$suc->nombre,'inicio'=>$inicio,
				'final'=>$final,'ordenes'=>$ordenes));
			return PDF::load(utf8_decode($html),'A4','portrait')->show();	
		}
	}else{
		return Redirect::route('informes')->with('status','error');
	}
});

/*
|--------------------------------------------------------------------------
| Ingreso al panel de administración de usuarios
|--------------------------------------------------------------------------
|
| Rutas de las pantallas de inicio de los usuarios
| según su rol en el sistema
|
*/
//Administrador
Route::get('admin', array('before' => 'auth','as'=>'administrador', function()
{
	return View::make('Admin.admin');
}));

//Técnico
Route::get('tecnico', array('before' => 'auth','as'=>'tecnico', function()
{
	$cliente = Cliente::all();
	$select = array(0 => 'Seleccione...')+$cliente->lists('nombres','id');
	return View::make('Admin.tecnico')->with('cliente',$cliente);
}));

//Vendedor
Route::get('vendedor', array('before' => 'auth','as'=>'vendedor', function()
{
	$cliente = Cliente::all();
	$select = array(0 => 'Seleccione...')+$cliente->lists('nombres','id');
	return View::make('Admin.vendedor')->with('cliente',$cliente);
}));

/*
|--------------------------------------------------------------------------
| Rutas para controladores RestFull
|--------------------------------------------------------------------------
|
| Rutas con controladores Resfull con las principales funciones
| del sistema
|
*/
Route::controller('empresa','EmpresaController');
Route::controller('sucursal','SucursalController');
Route::controller('user','UserController');
Route::controller('cliente','ClienteController');
Route::controller('equipo','EquipoController');
Route::controller('ordenTrabajo','OrdenController');
Route::controller('presupuesto','PresupuestoController');
Route::controller('consultaApp','ConsultaController');

/*
|--------------------------------------------------------------------------
| Rutas para selección de informes estadísticos
|--------------------------------------------------------------------------
|
| Rutas para gestión de los informes a los cuales el administrador 
| del sistema ingresa
|
*/
Route::group(array('prefix'=>'informe'),function()
{
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
		return View::make('informes.listaInf')->with(array('sucursal'=>$select,'user'=>$user,'tecnicos'=>$listaTecnicos,
			'vendedores'=>$vendedores));
	}));
	Route::get('ingreso', 'InformeController@ingreso');
	Route::get('ingresoUser', 'InformeController@ingresoUser');
	Route::get('repTerminadas', 'InformeController@RepTerminadas');
	Route::get('ordenEntreg', 'InformeController@ordenesEntregadas');
	Route::get('ordenEntTecnico','InformeController@OnderRepEntTecnico');
	Route::get('entregadoSuc','InformeController@entregadoSuc');
});


/*
|--------------------------------------------------------------------------
| Consulta de estado de una órden de trabajo
|--------------------------------------------------------------------------
|
| Consulta de estado de servicios de mantenimiento técnico 
| por parte de los clientes dentro del sistema
|
*/
//Lista de órdenes de trábajo por cliente
Route::get('listaOrdenes',function(){
	$cedula = Input::get('cedula');
	$cliente = Cliente::where('cedula','=',$cedula)->first();
	if(!is_null($cliente)){
		$ordenes = Orden::where('cliente_id','=',$cliente->id)
		->where('entregado','=','0')
		->orderBy('id','desc')->get();
		if(!is_null($ordenes)){
			return View::make('consulta.lista')->with(array('ordenes'=>$ordenes,'cliente'=>$cliente, 'estado'=>'ok'));	
		}else{
			return View::make('consulta.lista')->with(array('estado'=>'error','cliente'=>$cliente,'ordenes'=>$ordenes));
		}
	}else{
		return View::make('consulta.lista')->with(array('estado'=>'error','cliente'=>$cliente,'ordenes'=>''));
	}
});

//Detalle de la órden de trabajo seleccionada
Route::get('consultaOrden/{orden}',function($orden){
	if(isset($orden)){
		$ordenTrabajo = Orden::findOrFail($orden);
		return View::make('consulta.detalleConsulta')->with('orden',$ordenTrabajo);
	}else{
		return Redirect::route('informes')->with('status','error');
	}
});

/*
|--------------------------------------------------------------------------
| Carga de páginas vía AJAx
|--------------------------------------------------------------------------
|
| Carga datos de la base de datos en la´página sin a 
| actualizarla
|
*/
//Carga datos de un usuario al ingreso de una orden de trabajo
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

/*
|--------------------------------------------------------------------------
| Mensaje de error 404
|--------------------------------------------------------------------------
|
| Al ingresar a una página que no se encuetra disponible se muestra una pantalla
| con un mensaje de error 404
|
*/
App::missing(function($exception)
{
	return Response::view('Errores.error404');
});
/*
|--------------------------------------------------------------------------
| Rellenar campos en tablas
|--------------------------------------------------------------------------
|
| Al ingresar a estas rutas, se llenarán los campos de empresa, sucursal y user(Admin)
| en la base de datos
|
*/
Route::get('/seedEmpresa',function()
{
	$empresa = new Empresa;
	$empresa->ruc = '1104537228';
	$empresa->actividad = '001';
	$empresa->razon_social = 'Walter Alvarado';
	$empresa->razon_comercial = 'Sisprocompu';
	$empresa->save();

});

Route::get('/seedSucursal',function()
{
	$sucursal = new Sucursal;
	$sucursal->provincia = 'Loja';
	$sucursal->ciudad = 'Loja';
	$sucursal->direccion = 'Sucre 05-25 entre Colón e Imbabura';
	$sucursal->telefono = '2585136';
	$sucursal->celular = '';
	$sucursal->email = 'alw0702@gmail.com';
	$sucursal->empresa_id = '1';
	$sucursal->estado = '1';
	$sucursal->nombre = 'Matriz';
	$sucursal->save();
});

Route::get('/seddUser',function()
{
	$user = new User;
	$user->nombres = 'Walter Patricio';
	$user->apellidos = 'Alavarado';
	$user->direccion = 'Sucre 05-25 entre Colón e Imbabura';
	$user->email = 'alw0702@gmail.com';
	$user->telefono = '2585136';
	$user->celular = '';
	$user->cedula = '0702568130';
	$user->username = 'admin';
	$user->password = Hash::make('admin123');
	$user->rol = 'administrador';
	$user->sucursal_id = '1';
	$user->estado = '1';
	$user->save();

});



