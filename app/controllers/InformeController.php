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
	* Muestra una lista de opciones de informes
	*
	* @param
	* @return Response
	**/
	public function getIndex()
	{		
		$sucursal = Sucursal::where('estado','=','1')
		->get();
		$selectSuc = array(0 => 'todos')+ $sucursal->lists('nombre','id');				
		return View::make('informes.listaInf')->with('sucursal',$selectSuc);
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
				$ordenes = Orden::whereBetween('fecha_ingreso',array($fechaInicio,$fechaFinal))->get();			
				return View::make('informes.IngOrden')->with(array('ordenes'=>$ordenes,'sucursal'=>'Todos los locales',
					'inicio'=>$fechaInicio,'final'=>$fechaFinal));			
			}else{
				$ordenes = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))			
				->where('Sucursal_id','=',$sucursal)
				->get();
				$suc = Sucursal::findOrFail($sucursal);			
				return View::make('informes.IngOrden')->with(array('ordenes'=>$ordenes,'sucursal'=>$suc->nombre,
					'inicio'=>$fechaInicio,'final'=>$fechaFinal));
			}
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