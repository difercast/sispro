<?php
/** 
* @Sistema de administración y control de servicios de mantenimiento técnico
* @version: 1.0      @modificado: 07 de marzo del 2014
* @author: Diego Castillo.
*
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Validar el número de cédula al ingresar un usuario.
	 * @param string ci
	 * @return boolean
	 */
	

  public function validarCI($ci)
	{
		$ruc = $ci;
    $digitoProvincia = substr($ruc,0,2);
    $tercerDigito = substr($ruc,2,1);
    $ultimodigito = substr($ruc,9,1);
    if(strlen($ruc) == 10){
      if(($digitoProvincia >=1 && $digitoProvincia <= 24) && $tercerDigito < 6){
        //Extraemos lo pares
        $par2 = substr($ruc,1,1);
        $par4 = substr($ruc,3,1);
        $par6 = substr($ruc,5,1);
        $par8 = substr($ruc,7,1);
        $sumapares =  $par2 + $par4 + $par6 + $par8;
        //Extraemos los valores impares
        $impar1 = substr($ruc,0,1);
        $impar1 = $impar1 * 2;
        if($impar1 > 9){ $impar1 = ($impar1 - 9);}     
        $impar3 = substr($ruc,2,1);
        $impar3 = $impar3 * 2;
        if($impar3 > 9){ $impar3 = ($impar3 - 9);}
        $impar5 = substr($ruc,4,1);
        $impar5 = $impar5 * 2;
        if($impar5 > 9){ $impar5 = ($impar5 - 9);}
        $impar7 = substr($ruc,6,1);
        $impar7 = $impar7 * 2;
        if($impar7 > 9){ $impar7 = ($impar7 - 9);}
        $impar9 = substr($ruc,8,1);
        $impar9 = $impar9 * 2;
        if($impar9 > 9){ $impar9 = ($impar9 - 9);}
        
        $sumaImpares = $impar1 + $impar3 + $impar5 + $impar7 + $impar9;
        $sumaTotal = $sumaImpares + $sumapares;
        $primerDigito = substr($sumaTotal,0,1);
        $primerDigito = (($primerDigito + 1)* 10);
        $digitoValidador = $primerDigito - $sumaTotal;
        if($digitoValidador == 10){
           $digitoValidador = 0;
        }
        //Comparamos el digito validador con el último digito de la cédula
        if($digitoValidador == $ultimodigito){
            return true;
        }else return false;            
      }else return false;
    }else return false;
	}

	/** 
   * Verifica si un número de teléfono es correcto o si no 
   * se ha ingresado ningún valor
   *
   * @param int tel
   * @return boolean
   **/
  public function validaTel($tel)
  {
    if(is_null($tel) || $tel == ''){
      return true;
    }else{
      if(is_numeric($tel) && (strlen($tel) == 7)){
        return true;
      }else return false;
    }
  }

  /** 
   * Verifica si un número de celular es correcto o si
   * no se ha ingresado ningún valor
   *
   * @param int cel
   * @return boolean
   **/
  public function validaCel($cel)
  {
    if(is_null($cel) || $cel == ''){
      return true;
    }else{
      if(is_numeric($cel) && (strlen($cel) == 10) && (substr($cel,0,2) == '09')){
        return true;
      }else return false;
    }
  }

}