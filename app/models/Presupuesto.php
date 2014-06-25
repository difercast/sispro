<?php

/** 
*
* @Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version: 1.0      @modificado: 12 de junio del 2014
* @author: Diego Castillo.
*
*/

class Presupuesto extends Eloquent
{
	protected $table = "presupuestos";

	public function ordenes()
	{
		return $this->belongsToMany('Orden');
	}

}