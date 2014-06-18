<?php

/** 
*
* Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version 1.0      @modificado: 07 de marzo del 2014
* @author Diego Castillo.
*
*/

class Sucursal extends Eloquent
{
	protected $table = 'sucursales';

	/**
   * Determinar la relación con la empresas
   * 
   * 
   * @return 
   **/
	public function empresa()
    {
        return $this->belongsTo('Empresa');
    }

  /**
   * Función para validar campos de teléfono y celular ingresados
   * 
   * @param string telefono, string celular
   * @return boolean true si el teléfono y celular son correctos
   **/  
  public function validarTelefonos($telefono, $celular)
  {
    if(is_numeric($telefono) && is_numeric($celular) && substr($celular, 0,2) == '09' && strlen($telefono) == '7' &&  strlen($celular) == '10')
    {
        return true;        
      
    }else {
      return false;
    }
    
  }
}