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
	public function getIngreso()
	{
		$fechaInicio = Input::get('fechaInicio');
		$fechaFinal = Input::get('fechaFinal');
		$sucursal = Input::get('sucursal');
		if($sucursal == '0'){
			$ordenes = Orden::whereBetween('feche_ingreso',array($fechaInicio,$fechaFinal))
			->paginate(15);
			return View::make('informes.IngOrden')->with(array('ordenes'=>$ordenes,'sucursal'=>'Todos los locales'));	
		}else{
			$orden = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))			
			->where('Sucursal_id','=',$sucursal)
			->paginate(15);
			$suc = Sucursal::findOrFail($sucursal);
			return View::make('informes.IngOrden')->with(array('ordenes'=>$ordenes,'sucursal'=>$suc->nombre,
				'inicio'=>$fechaInicio,'final'=>$fechaFinal));
		}		
		
	}
}