<?php

/** 
* Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version: 1.0      @modificado: 07 de marzo del 2014
* @author: Diego Castillo.
*
*/

class InformeController extends BaseController
{
	public function ingreso()
	{
		$fechaInicio = date(Input::get('fechaInicio'));
		$fechaFinal = date(Input::get('fechaFinal'));
		$sucursal = Input::get('sucursal');		
		if($sucursal == '0')		{
			$orden = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))->get();
			return View::make('informes.ingresoEquipos')->with('orden',$orden);	
		}else{
			$orden = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))
			->where('Sucursal_id','=',$sucursal)->get();
			return View::make('informes.ingresoEquipos')->with('orden',$orden);	
		}		
	}
}



