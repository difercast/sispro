<?php

/** 
* @Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version: 1.0      @modificado: 05 de 
* @author: Diego Castillo.
*
*/

class InformeController extends BaseController
{
	public $restful = true;

	//Constructor de la clase
	public function __construct()
	{
		$this->beforeFilter('auth');
		$this->beforeFilter('autenticacion');
	}

	

	/** 
	* Informe de órdenes de trabajo ingresadas a la empresa por sucursal
	*
	* @param
	* @return Response
	**/
	public function ingreso()
	{
		$sucursal = Input::get('sucursal');
		$fechaInicio = date(Input::get('fechaInicio'));
		$fechaFinal = date(Input::get('fechaFinal'));
		$reglas = array(
			'sucursal' => 'required',
			'fechaInicio' => 'required',
			'fechaFinal' => 'required');
		$validador = Validator::make(Input::all(),$reglas);
		if($validador->passes() && self::validaFechas($fechaInicio,$fechaFinal)){
			if($sucursal == '0'){
				$ordenes = Orden::whereBetween('fecha_ingreso',array($fechaInicio,$fechaFinal))
				->orderBy('id','desc')->paginate(15);
				$ordenes2 = Orden::whereBetween('fecha_ingreso',array($fechaInicio,$fechaFinal))->get();
				return View::make('informes.IngOrden')->with(array('ordenes'=>$ordenes,'local'=>'Todos los locales',
					'inicio'=>$fechaInicio,'final'=>$fechaFinal,'sucursal'=>$sucursal,'ordenes2'=>$ordenes2));			
			}else{
				$ordenes = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))			
				->where('Sucursal_id','=',$sucursal)->orderBy('id','desc')
				->paginate(15);
				$ordenes2 = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))			
				->where('Sucursal_id','=',$sucursal)->get();
				$suc = Sucursal::findOrFail($sucursal);			
				return View::make('informes.IngOrden')->with(array('ordenes'=>$ordenes,'local'=>$suc->nombre,
					'inicio'=>$fechaInicio,'final'=>$fechaFinal,'sucursal'=>$sucursal,'ordenes2'=>$ordenes2));
			}
		}else{
			return Redirect::route('informes')->with('status','error');			
		}			
	}

	/** 
	* Informe de órdenes de trabajo ingresadas a la empresa por un usuario determinado
	*
	* @param
	* @return Response
	**/
	public function ingresoUser()
	{
		$user = Input::get('user');
		$fechaInicio = date(Input::get('fechaInicio'));
		$fechaFinal = date(Input::get('fechaFinal'));
		$reglas = array( 'user'=>'required',
			'fechaInicio'=>'required',
			'fechaFinal'=>'required');
		$validador = Validator::make(Input::all(), $reglas);
		if($validador->passes() && self::validaFechas($fechaInicio, $fechaFinal)){
			$ordenes = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))			
			->where('user_id','=',$user)
			->paginate(15);
			$usuario = User::findOrFail($user);
			return View::make('informes.IngOrdenUser')->with(array('ordenes'=>$ordenes,'inicio'=>$fechaInicio,
				'final'=>$fechaFinal,'nombres'=>$usuario->nombres,'apellidos'=>$usuario->apellidos, 'user'=>$user));			
		}else{
			return Redirect::route('informes')->with('status','error');
		}
	}

	/** 
	* Informe de órdenes de trabajo entregadas por un vendedor
	*
	* @param
	* @return Response
	**/
	public function ordenesEntregadas()
	{
		$vendedor = Input::get('vendedor');
		$fechaInicio = date(Input::get('fechaInicio'));
		$fechaFinal = date(Input::get('fechaFinal'));
		$reglas = array( 'vendedor'=>'required',
			'fechaInicio'=>'required',
			'fechaFinal'=>'required');
		$validador = Validator::make(Input::all(), $reglas);
		if($validador->passes() && self::validaFechas($fechaInicio, $fechaFinal)){
			$ordenes = Orden::whereRaw('entregado = ? and vendedor_id = ?', array('1',$vendedor))
			->paginate(15);
			$vend = User::findOrFail($vendedor);
			return View::make('informes.OrdenesEntregadas')->with(array('ordenes'=>$ordenes,'inicio'=>$fechaInicio,
				'final'=>$fechaFinal,'vend'=>$vend, 'vendedor'=>$vendedor));			
		}else{
			return Redirect::route('informes')->with('status','error');
		}		
	}


	/** 
	* Informe de órdenes de trabajo terminadas por un técnico
	*
	* @param
	* @return Response
	**/
	public function RepTerminadas()
	{
		$tecnico = Input::get('tecnico');
		$fechaInicio = Input::get('fechaInicio');
		$fechaFinal = Input::get('fechaFinal');
		$reglas = array('tecnico'=>'required',
			'fechaInicio'=>'required',
			'fechaFinal'=>'required');
		$validador = Validator::make(Input::all(),$reglas);
		if($validador->passes() && self::validaFechas($fechaInicio,$fechaFinal)){
			$ordenes = Orden::whereBetween('fecha_terminado',array($fechaInicio,$fechaFinal))
			->paginate(15);
			$tec = User::findOrFail($tecnico);
			return View::make('informes.repTerminadas')->with(array('tecnico'=>$tecnico,'inicio'=>$fechaInicio,'final'=>$fechaFinal,
				'ordenes'=>$ordenes,'tec'=>$tec));
			//return View::make('informes.repTerminadas')->compact($tecnico,$fechaInicio,$fechaFinal,$ordenes,$tec);
		}
		else{
			return Redirect::route('informes')->with('status','error');	
		}
	}

	/** 
	* Informe de órdenes de trabajo terminadas por un técnico
	* y estragadas al usuario
	*
	* @param
	* @return Response
	**/
	public function OnderRepEntTecnico()
	{		
		$tecnico = Input::get('tecnico');
		$fechaInicio = Input::get('fechaInicio');
		$fechaFinal = Input::get('fechaFinal');
		$reglas = array('tecnico'=>'required',
			'fechaInicio'=>'required',
			'fechaFinal'=>'required');
		$validador = Validator::make(Input::all(),$reglas);
		if($validador->passes() && self::validaFechas($fechaInicio, $fechaFinal)){
			$ordenes = Orden::whereBetween('fecha_terminado',array($fechaInicio,$fechaFinal))
			->whereRaw('entregado = ? and tecnico = ?',array('1',$tecnico))
			->paginate(15);
			$tec = User::findOrFail($tecnico);			
			return View::make('informes.repTermEntrTecnico')->with(array('tecnico'=>$tecnico,'inicio'=>$fechaInicio,'final'=>$fechaFinal,
				'ordenes'=>$ordenes,'tec'=>$tec));
		}else{
			return Redirect::route('informes')->with('status','error'); 
		}
	}

	/** 
	* validar que el rango de fechas sea correcto
	*
	* @param date $inicio, date $final
	* @return Response
	**/
	static function validaFechas($inicio, $termino)
	{
		if(date($termino) >= date($inicio))	return true;
		else return false;
		
	}

}