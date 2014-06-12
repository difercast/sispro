<?php
/** 
* @Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version 1.0    @modificado:07 de abril del 2014
* @author Diego Castillo.
*
*/
class ClienteController extends BaseController{
	public $restful = true;
	//Constructor de la clase
	public function __construct()
	{
		$this -> beforeFilter('auth');
		$this -> beforeFilter('authAny');
	}
	/**
	* Envía datos de todos los clientes a la vista Clientes
	* 
	* @param
	* @return Response
	**/
	public function getIndex()
	{		
		$cliente = DB::table('clientes')->paginate(15);
		return View::make('cliente.index')->with('cliente',$cliente);
	}
	/**
	* Crea la vista Editar y envía datos de un cliente específico
	* 
	* @param int id
	* @return Response
	**/
	public function getModificar($id)
	{
		$cliente = Cliente::findOrFail($id);
		return View::make('cliente.form')->with(array('cliente'=>$cliente,'estado'=>'editar'));
	}
	/**
	* Crea la vista Ver y envía los datos del cliente
	* 
	* @param int id
	* @return Response
	**/
	public function getVer($id)
	{
		$cliente = Cliente::findOrFail($id);
		return View::make('cliente.form')->with(array('cliente'=>$cliente,'estado'=>'ver'));
	}

	/**
	* Modifica la información de un cliente
	* 
	* @param 
	* @return Response
	**/
	public function postEditar()
	{
		$reglas = array(
			'nombres'=>'required',
			'cedula'=>'required',
			'email'=>'email'
			);
		$validador = Validator::make(Input::all(),$reglas);
		if($validador->passes())
		{
			$cliente = Cliente::findOrFail(Input::get('id'));
			if(self::validarCI(Input::get('cedula')) && self::validarTelefono(Input::get('telefono')) && self::validarCelular(Input::get('celular')))
			{
				$cliente->nombres = Input::get('nombres');
				$cliente->cedula = Input::get('cedula');
				$cliente->direccion = Input::get('direccion');
				$cliente->telefono = Input::get('telefono');
				$cliente->celular = Input::get('celular');
				$cliente->email = Input::get('email');
				$cliente->observaciones = Input::get('observaciones');
				$cliente->save();
				return Redirect::to('cliente')->with('status','okEditado');
			}
			else
			{
				return Redirect::to('cliente')->with('status','error');				
			}			
		}
		else
		{
			return Redirect::to('cliente')->with('status','error');	
		}
	}

	/** 
   *  Verifica si un número de CI es correcto
   * o si no se ha ingresado ningún valor
   * @param int cedula
   *  @return boolean
   **/
  public static function validarCI($cedula)
  {
    $cliente = new Cliente;
    if($cedula != "")
    {
      if($cliente->validarCI($cedula))
      {
        return true;
      }else return false;
    }else return true;
  }

  /** 
   * Verifica si un número de teléfono es correcto o si no 
   * se ha ingresado ningún valor
   *
   * @param int telefono
   * @return boolean
   **/
  public static function validarTelefono($telefono)
  {
    $cliente = new Cliente;
    if($telefono != "")
    {
      if($cliente->validarTelefono($telefono))
      {
        return true;
      }else return false;
    }else return true;
  }

  /** 
   * Verifica si un número de celular es correcto o si
   * no se ha ingresado ningún valor
   *
   * @param int celular
   * @return boolean
   **/
  public static function validarCelular($celular)
  {
    $cliente = new Cliente;
    if($celular != "")
    {
      if($cliente->validarCelular($celular))
      {
        return true;        
      }else return false;
    }else return true;
  }
}