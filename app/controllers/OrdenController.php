<?php

/** 
*
* Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version 1.0      @modificado: 15 de abril del 2014
* @author Diego Castillo.
*
*/
define ("IVA" , 1.12);	
class OrdenController extends BaseController
{

	//Contructor de la clase
	public function __construct()
	{
		$this -> beforeFilter('auth');
		$this -> beforeFilter('authAny');
	}

	 /** 
	 * Presenta el formulario de ingreso de una orden de trabajo
	 * con los datos de usuario, técnicos y clientes
	 *  @param 
	 *  @return Response
	 **/
	public function getIndex()
	{		
		$tecnicos = User::whereNested(function($query)
		{
			$query->where('rol','=','tecnico');
			$query->where('sucursal_id','=',Auth::user()->sucursal_id);
		})->get();
		$tecnico = array(0 => 'Seleccione...')+$tecnicos->lists('nombres','id');
		$cliente = Cliente::all();
		$select = array(0 => 'Seleccione...')+$cliente->lists('nombres','id');
		$clientes = Cliente::all();
		return View::make('orden.ingresarOrden')->with(array('tecnicos'=>$tecnico,'clientes'=>$select,'todosClientes'=>$clientes));
	}

	/** 
	 * Presenta un diálogo donde el usuario buscará una orden
	 * por sú número de ingreso 
	 * @param 
	 * @return Response
	 **/
	public function getBuscar()
	{
		return View::make('orden.buscarOrden');
	}

	/** 
	 * Presenta un diálogo donde el usuario buscará una orden
	 * por el cliente que ingresó el equipo 
	 * @param 
	 * @return Response
	 **/
	public function getBuscarporcliente()
	{				
		$cliente = Cliente::all();
		$select = array(0 => 'Seleccione...')+$cliente->lists('nombres','id');
		return View::make('orden.buscarOrdenPorCliente')->with('cliente',$select);
	}


	/** 
	 * Presentarun lista de órdenes de trabajo deacuerdo
	 *  al cliente seleccionado
	 * @param 
	 * @return Response
	 **/
	public function anyPorcliente()
	{
		$cliente = Cliente::findOrFail(Input::get('cliente'));
		$lista = $cliente->ordenes()->get();				
		return View::make('orden.ordenesCliente')->with(array('orden'=>$lista,'cliente'=>$cliente));
	}

	/** 
	 * Presentar datos de la orden de trabajo en una vista
	 * @param
	 * @return Response
	 **/
	public function postMostrar()
	{
		if(Input::get('tipo') == 'gestion')
		{
			$pres = Presupuesto::all();
			$numOrden = Input::get('orden');
			$orden = Orden::find($numOrden);
			$orden->detalle = Input::get('detalle');
			$orden->informe = Input::get('informe');
			$orden->estado = Input::get('estado');
			if(Input::get('estado') == '2'){
				$orden->fecha_terminado = date('Y-m-d H:i:s', time());
			}
			$orden->save();
			$cliente = Cliente::find($orden->cliente_id);
			$equipo = Equipo::find($orden->equipo_id);
			$user = User::find($orden->user_id);
			$user = $user->nombres;
			$tecnico = User::find($orden->tecnico);
			$suc = Sucursal::findOrFail($orden->Sucursal_id);
			$sucursal = $suc->nombre;			
			return View::make('orden.detalleOrden')->with(array('orden'=>$orden,'user'=>$user,'cliente'=>$cliente,'equipo'=>$equipo,'presupuesto'=>$pres,'sucursal'=>$sucursal));
		}else{
			$pres = Presupuesto::all();
			$numOrden = Input::get('NumOrden');
			$orden = Orden::findOrFail($numOrden);
			$cliente = Cliente::find($orden->cliente_id);
			$equipo = Equipo::find($orden->equipo_id);
			$user = User::find($orden->user_id);
			$user = $user->nombres;
			$tecnico = User::find($orden->tecnico);
			$suc = Sucursal::findOrFail($orden->Sucursal_id);
			$sucursal = $suc->nombre;			
			return View::make('orden.detalleOrden')->with(array('orden'=>$orden,'user'=>$user,'cliente'=>$cliente,'equipo'=>$equipo, 'presupuesto'=>$pres,'sucursal'=>$sucursal));
		}
	}

	/** 
	* Ingresar una orden de trabajo al sistema
	*  @param 
	*  @return Response
	**/
	public function postIngresar()
	{
		$reglas = array(
			'tipo'=>'required',
			'marca'=>'required',
			'modelo'=>'required',
			'serie'=>'required',
			'nombres'=>'required',
			'cedula'=>'required',
			'problema'=>'required',			
			'user_id'=>'required',
			'tecnico'=>'required',
			'email'=>'email'			
			);
		$validador = Validator::make(Input::all(),$reglas);	
		if($validador->passes()){
			if(self::verificarEquipo(Input::get('serie'))){
				if (self::validarCI(Input::get('cedula')) && self::validarTelefono(Input::get('telefono')) && self::validarCelular(Input::get('celular'))) {
					$cliente = self::procesaCliente(Input::get('id_cliente'),Input::get('nombres'),Input::get('cedula'),
						Input::get('direccion'),Input::get('telefono'),Input::get('celular'),Input::get('email'),Input::get('observaciones'));			
					$equipo = self::procesaEquipo(Input::get('tipo'),Input::get('marca'),Input::get('modelo'),
						Input::get('serie'),$cliente->id);
					$orden = new Orden;							
					$orden->user_id = Auth::user()->id;
					$orden->cliente_id = $cliente->id;
					$orden->equipo_id = $equipo->id;
					$orden->problema = Input::get('problema');
					$orden->accesorios = Input::get('accesorios');
					$orden->tecnico = Input::get('tecnico');
					$orden->sucursal_id = Auth::user()->sucursal_id;
					$orden->fechaPrometido = Input::get('fechaPrometido');					
					$orden->save();
					return Redirect::to('tecnico')->with('status','okCreado');
				}
				else{
					if(Auth::user()->rol == 'tecnico'){
						return Redirect::to('tecnico')->with('status','errorDatos');
					}
					elseif (Auth::user()->rol=='vendedor'){
						return Redirect::to('vendedor')->with('status','errorDatos');	
					}
				}
			}
			else{
				if(Auth::user()->rol == 'tecnico'){
					return Redirect::to('tecnico')->with('status','errorEquipo');
				}
				elseif (Auth::user()->rol=='vendedor') {
					return Redirect::to('vendedor')->with('status','errorEquipo');	
				}
			}						
		}
		else{
			if(Auth::user()->rol == 'tecnico'){
				return Redirect::to('tecnico')->with('status','error');
			}
			elseif(Auth::user()->rol=='vendedor') {
				return Redirect::to('vendedor')->with('status','error');	
			}
		}		
	}

	/**
	* 	Presenta la vista con listado de órdenes de trabajo
	*	@param int $estado
	*	@return Response
	**/
	public function getListado($estado)
	{
		if($estado == 1){
			$ordenes = Orden::paginate(15);
			return View::make('orden.listaOrdenes')->with(array('ordenes'=>$ordenes,'estado'=>'todos'));
		}elseif($estado == 2){
			$ordenes = Orden::where('entregado','=','1')->orderBy('id', 'desc')->paginate(15);
			return View::make('orden.listaOrdenes')->with(array('ordenes'=>$ordenes,'estado'=>'entregados'));
		}elseif($estado == 3){
			$ordenes = Orden::where('estado','=','2')->orderBy('id', 'desc')->paginate(15);
			return View::make('orden.listaOrdenes')->with(array('ordenes'=>$ordenes,'estado'=>'terminado'));
		}elseif ($estado == 4) {
			$ordenes = Orden::where('estado','=','0')->orderBy('id','desc')->paginate(15);
			return View::make('orden.listaOrdenes')->with(array('ordenes'=>$ordenes,'estado'=>'sinRevisar'));
		}elseif ($estado == 5) {
			$ordenes = Orden::where('estado','=','3')->orderBy('id','desc')->paginate(15);
			return View::make('orden.listaOrdenes')->with(array('ordenes'=>$ordenes,'estado'=>'baja'));
		}
		
	}

	/**
	* 	Administra el presupuesto de una orden de trabajo
	*	@param 
	*	@return Response
	**/
	public function postPresupuesto()
	{				
		$orden = Orden::findOrFail(Input::get('orden'));
		$valores = $_POST['presupuesto'];
		$sub = 0;
		foreach($valores as $valor){
			$precio = Presupuesto::findOrFail($valor);
			$orden->presupuestos()->save($precio,array('valor_actual'=>$precio->valor));
			$sub += $precio->valor;
		}				
		$orden->presupuestado = '1';
		$orden->subtotal = $sub;
		$orden->total = ($sub*1.12);
		$orden->save();
		$cliente = Cliente::findOrFail($orden->cliente_id);
		$equipo = Equipo::findOrFail($orden->equipo_id);
		$user = User::findOrFail($orden->user_id);
		$usuario = $user->nombres;
		$pres = Presupuesto::all();
		$suc = Sucursal::findOrFail($orden->Sucursal_id);
		$sucursal = $suc->nombre;
		return View::make('orden.detalleOrden')->with(array('orden'=>$orden,'user'=>$usuario,'cliente'=>$cliente,'equipo'=>$equipo,'presupuesto'=>$pres,'sucursal'=>$sucursal));
	}

	/**
	* 	Registrar la entrega de un equipo
	*	@param 
	*	@return Response
	**/	
	public function postEntregar()
	{
		$pres = Presupuesto::all();
		$orden = Orden::findOrFail(Input::get('orden'));
		if(Input::get('entregado') == '1'){
			$orden->entregado = 1;
			$orden->fecha_entregado = date('Y-m-d H:i:s', time());
			$orden->save();
			$cliente = Cliente::findOrFail($orden->cliente_id);
		$equipo = Equipo::findOrFail($orden->equipo_id);
		$user = User::findOrFail($orden->user_id);
		$usuario = $user->nombres;
		$tecnico = User::findOrFail($orden->tecnico);
		$suc = Sucursal::findOrFail($orden->Sucursal_id);
		$sucursal = $suc->nombre;
		return View::make('orden.detalleOrden')->with(array('orden'=>$orden,'user'=>$usuario,'cliente'=>$cliente,'equipo'=>$equipo,'presupuesto'=>$pres,'sucursal'=>$sucursal));

		}
	}

	/** 
    * Ingresar un nuevo cliente
    *  @param 
    *  @return Object Cliente
    **/
    public static function procesaCliente($estado,$nombres,$cedula,$direccion,$telefono,$celular,$email,$observaciones)
    {
    
	    if($estado == '0'){
	      $cliente = new Cliente;
	      $cliente -> nombres = $nombres;
	      $cliente -> cedula = $cedula;
	      $cliente -> direccion = $direccion;
	      $cliente -> telefono = $telefono;
	      $cliente -> celular = $celular;
	      $cliente -> email = $email;
	      $cliente -> observaciones = $observaciones;
	      $cliente -> save();
	    }
	    else{
	      $cliente = Cliente::findOrFail($estado);
	      $cliente -> nombres = $nombres;
	      $cliente -> cedula = $cedula;
	      $cliente -> direccion = $direccion;
	      $cliente -> telefono = $telefono;
	      $cliente -> celular = $celular;
	      $cliente -> email = $email;
	      $cliente -> observaciones = $observaciones;
	      $cliente -> save();
	    }
	    return $cliente;
    }

  /** 
   * Ingresar o modificar equipoingresado con una orden de trabajo
   *  @param 
   *  @return Response
   **/
  public static function procesaEquipo($tipo,$marca,$modelo,$serie, $cliente_id)
  {
    $equipo = Equipo::where('serie','=',$serie)->get();   
    if(isset($equipo->id))
    {
      $equipo->tipo = $tipo;
      $equipo->marca = $marca;
      $equipo->modelo = $modelo;
      $equipo->serie = $serie;
      $equipo->cliente_id = $cliente_id;
      $equipo->save();

    }
    else
    { 
      
      $equipo = new Equipo;
      $equipo->tipo = $tipo;
      $equipo->marca = $marca;
      $equipo->modelo = $modelo;
      $equipo->serie = $serie;
      $equipo->cliente_id = $cliente_id;
      $equipo->save();
    }
    return $equipo;
  }

  /** 
   * Verificar si un equipo ya está ingresado en la empresa a reparación
   * y no lo han retirado 
   * @param int serie
   *  @return boolean
   **/
  public static function verificarEquipo($serie)
  {
    $equipos = Equipo::where('serie','=',$serie)->get();
    $numEquipos = count($equipos);
    if($numEquipos != 0){
        foreach ($equipo as $equipos) {
        	$ordenes = $equipo->ordenes()->where('entregado','=','0')->get();
        	$numOrdenes = count($ordenes);
        	if ($numOrdenes != 0){
          		return true;
          		break;    
        	}
        	else{
          	return false;
          	break;            
        	} 
      	}
    }
    else return true; 
  }

  /** 
   * Verificar si un número teléfono ingresado es correcto
   * o no tiene ningún valor
   * @param int cedula
   * @return boolean
   **/
  public static function validarTelefono($telefono)
  {
    $cliente = new Cliente;
    if($telefono != ""){
      if($cliente->validarTelefono($telefono)){
        return true;
      }else return false;
    }else return true;
  }

	/** 
   	* Verificar si un número celular ingresado es correcto
   	* o no tiene ningún valor
   	* @param int celular
   	* @return boolean
   	**/
  	public static function validarCelular($celular)
  	{
    	$cliente = new Cliente;
    	if($celular != ""){
      		if($cliente->validarCelular($celular)){
        		return true;        
      		}else return false;
    	}else return true;
  	}

    /** 
   	* Validar si un número de cédula ingresado es correcto
   	* @param int cedula
   	* @return boolean
   	**/
    public static function validarCI($cedula)
  	{
    	$cliente = new Cliente;
    	if($cedula != ""){
      		if($cliente->validarCI($cedula)){
        		return true;
      		}else return false;
    	}else return true;
  	}


}
