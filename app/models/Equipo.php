<?php
/** 
*
* @Sistema de administración y control de servicios de mantenimiento técnico
* @version 1.0      @modificado: 14 de abril del 2014
* @author Diego Castillo.
*
*/

class Equipo extends Eloquent {

	protected $table = 'equipos';

	/**
	* Relación con el modelo Orden
	* 
	* @param
	* @return Response
	**/
	public function ordenes()
	{
		return $this->hasMany('Orden');
	}

}
