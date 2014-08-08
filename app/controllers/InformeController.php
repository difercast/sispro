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
				$ordenes = Orden::whereBetween('fecha_ingreso',array($fechaInicio,$fechaFinal))->paginate(15);			
				return View::make('informes.IngOrden')->with(array('ordenes'=>$ordenes,'local'=>'Todos los locales',
					'inicio'=>$fechaInicio,'final'=>$fechaFinal,'sucursal'=>$sucursal));			
			}else{
				$ordenes = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))			
				->where('Sucursal_id','=',$sucursal)
				->paginate(15);
				$suc = Sucursal::findOrFail($sucursal);			
				return View::make('informes.IngOrden')->with(array('ordenes'=>$ordenes,'local'=>$suc->nombre,
					'inicio'=>$fechaInicio,'final'=>$fechaFinal,'sucursal'=>$sucursal));
			}
		}else{
			return Redirect::route('informes')->with('status','error');			
		}			
	}

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
			->get();
			$usuario = User::findOrFail($user);
			return View::make('informes.IngOrdenUser')->with(array('ordenes'=>$ordenes,
					'inicio'=>$fechaInicio,'final'=>$fechaFinal,'nombres'=>$usuario->nombres,'apellidos'=>$usuario->apellidos));			
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