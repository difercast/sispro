<?php
/** 
*
* @Sistema de administración y control de servicios de mantenimiento técnico
* @version 1.0      @modificado: 07 de marzo del 2014
* @author Diego Castillo.
*
*/

class Sucursal extends Eloquent
{
	protected $table = 'sucursales';

	/**
   * Relación entre Sucursal y Empresa
   * 
   * @param 
   * @return 
   **/
	public function empresa()
    {
        return $this->belongsTo('Empresa');
    }

  /**
   * Validar campos de teléfono y celular ingresados
   * 
   * @param string telefono, string celular
   * @return boolean 
   **/  
  public function validarTelefonos($telefono, $celular)
  {
    if(is_numeric($telefono) && is_numeric($celular) && substr($celular, 0,2) == '09' && strlen($telefono) == '7' 
      &&  strlen($celular) == '10'){
        return true;        
    }else{
      return false;
    }
  }
}