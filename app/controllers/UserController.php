<?php

/** 
* Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version: 1.0      @modificado: 07 de marzo del 2014
* @author: Diego Castillo.
*
*/
class UserController extends BaseController
{
	//Constructor de la clase
	public function __construct()
	{
		$this -> beforeFilter('auth');
		$this -> beforeFilter('autenticacion');
	}
	public $restful = true;
	/**
	* Función para mostrar el detalle de la empresa ingresada
	* 
	* @param
	* @return Response
	**/
	public function getIndex()
	{
		
		$user = User::all();
		$sucursal = Sucursal::all();
		return View::make('user.index')->with(array('user'=>$user,'sucursal'=>$sucursal));
		
	}
	/**
	* Función para mostrar formulario de ingreso de usuarios
	* 
	* @param
	* @return Response
	**/
	public function getNuevo()
	{
		$sucursal = Sucursal::where('estado','=','1')->get();
		$select = array(0 => 'Seleccione...')+$sucursal->lists('nombre','id');
		return View::make('user.form')->with('sucursal',$select);
	}


	/**
	* Función para ingresar un usuario
	* @param
	* @return Response
	**/
	public function postIngresar()
	{
		$reglas = array(
			'apellidos'=>'required',
			'nombres'=>'required',
			'cedula'=>'required',
			'direccion'=>'required',						
			'email'=> 'required|email',
			'password'=>'required',
			'password2'=>'required',
			'sucursal'=>'required',
			'rol'=>'required',
			'username' => 'required'
			);
		$validador = Validator::make(Input::all(),$reglas);
		$user = new User;
		if($validador->passes() && $user->validarCI(Input::get('cedula')))
		{
			if(Input::get('password') == Input::get('password2'))
			{
				/**$telefono = Input::get('telefono');
				$celular = Input::get('celular');
				if(isset($telefono))
				{
					if(!$user->validarTelefono($telefono))
					{
						return Redirect::to('user')->with('status','error');
					}
				}
				if(isset($celular))
				{
					if(!$user->validarCelular($celular))
					{
						return Redirect::to('user')->with('status','error');
					}
				}**/			
				if(Input::get('sucursal')!= '0')
				{
					$user -> apellidos = Input::get('apellidos');
					$user -> nombres = Input::get('nombres');
					$user -> cedula = Input::get('cedula');
					$user -> direccion = Input::get('direccion');
					$user -> telefono = Input::get('telefono');
					$user -> celular = Input::get('celular');
					$user -> email = Input::get('email');
					$user -> password = Hash::make(Input::get('password'));
					$user -> rol = Input::get('rol');
					$user -> username = Input::get('username');
					$user -> sucursal_id = Input::get('sucursal');
					$user -> estado = '1';
					$user->save();
					return Redirect::to('user')->with('status','okCreado');					
				}
				else
				{
					return Redirect::to('user')->with('status','errorSuc');
				}
			}
			else
			{
				return Redirect::to('user')->with('status','errorPass');
			}
		}
		else
		{
			return Redirect::to('user')->with('status','error');
		}
	}

	/**
	* Muestra formulario con los datos del usuario a editar
	* 
	* @param int id del usuario
	* @return Response
	**/
	public function getModificar($id)
	{
		$sucursal = Sucursal::where('estado','=','1')->get();
		$select = array(0 => 'Seleccione...')+$sucursal->lists('nombre','id');
		$user = User::findOrFail($id);		
		$suc = Sucursal::findOrFail($user->sucursal_id);
		return View::make('user.form')->with(array('user'=>$user,'sucursal'=>$select));
	}


	/**
	* Editar la información de un usuario
	* 
	* @param
	* @return Response
	**/
	public function postEditar()
	{
		
		$user = User::findOrFail(Input::get('id'));
		$reglas = array(
			'apellidos'=>'required',
			'nombres'=>'required',
			'cedula'=>'required',
			'direccion'=>'required',
			'email'=>'required|email',						
			'username'=>'required'
			);
		$validador = Validator::make(Input::all(),$reglas);
		if($validador->passes() && $user->validarCI(Input::get('cedula')))
		{
			if(self::validarTelefono(Input::get('telefono')) && self::validarCelular(Input::get('celular')))
			{
				$user -> apellidos = Input::get('apellidos');
				$user -> nombres = Input::get('nombres');
				$user -> cedula = Input::get('cedula');
				$user -> direccion = Input::get('direccion');
				$user -> telefono = Input::get('telefono');
				$user -> celular = Input::get('celular');
				$user -> email = Input::get('email');				
				$user -> username = Input::get('username');
				$user -> sucursal_id = Input::get('sucursal');				
				$user -> save();
				return Redirect::to('user')->with('status','okEditado');
			}
			else
			{
				return Redirect::to('user')->with('status','error');
			}			
		}
		else
		{
			return Redirect::to('user')->with('status','error');
		}
	}

	/**
	* Inactivar un usuario
	* 
	* @param int id del usuario
	* @return Response
	**/
	public function getInactivar($id)
	{
		$user = User::find($id);

		if(is_null($user))
		{
			//App::abort(404);
			return "error";
		}

		$user -> estado = '0';
		$user -> save();
		return Redirect::to('user')->with('status','okEstado');
	}

	/**
	* Activar un usuario
	* 
	* @param int id del usuario
	* @return Response
	**/
	public function getActivar($id)
	{
		$user = User::find($id);

		if(is_null($user))
		{
			//App::abort(404);
			return "error";
		}

		$user -> estado = '1';
		$user -> save();
		return Redirect::to('user')->with('status','okEstado');
	}

	/**
	* Ver detalles del usuario
	* 
	* @param int id 
	* @return Response
	**/
	public function getDetalle($id)
	{
		$user = User::findOrFail($id);
		$suc = Sucursal::findOrFail($user->sucursal_id);
		return View::make('user.detalleUser')->with(array('user'=>$user,'sucursal'=>$suc));
	}

	  /** 
   * Verificar si los datos ingresados son correctos   
   * @param int cedula
   *  @return boolean
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