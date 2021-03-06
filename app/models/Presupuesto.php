<?php

/** 
*
* @Sistema de administración y control de servicios de mantenimiento técnico
* @version: 1.0      @modificado: 12 de junio del 2014
* @author: Diego Castillo.
*
*/

class Presupuesto extends Eloquent
{
	protected $table = "presupuestos";

	/**
	* Relación con el modelo Orden
	* 
	* @param int id
	* @return Response
	**/
	public function ordenes()
	{
		return $this->belongsToMany('Orden');
	}

}