<?php

/** 
* Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version: 1.0      @modificado: 07 de marzo del 2014
* @author: Diego Castillo.
*
*/
class UserController extends BaseController
{
	//Constructor
	public function __construct()
	{
		$this -> beforeFilter('auth');
		$this -> beforeFilter('autenticacion');
	}
	public $restful = true;

	/**
	* Presentar una vista con el detalle de los usuarios registrados en el sistema
	* 
	* @param
	* @return Response
	**/
	public function getIndex()
	{
		$user = User::orderBy('id','asc')
		->paginate(15);
		$sucursal = Sucursal::all();
		return View::make('user.index')->with(array('users'=>$user,'sucursal'=>$sucursal));	
	}
	
	/**
	* Mostrar formulario de ingreso de usuarios
	* 
	* @param
	* @return Response
	**/
	public function getNuevo()
	{
		$sucursal = Sucursal::where('estado','=','1')->get();
		$select = $sucursal->lists('nombre','id');
		return View::make('user.form')->with('sucursal',$select);
	}


	/**
	* Ingresar un usuario al sistema
	* @param
	* @return Response
	**/
	public function postNuevo()
	{
		$user = new User;
		$reglas = array(
			'apellidos'=>'required',
			'nombres'=>'required',
			'cedula'=> array('required','unique:users,cedula'),
			'direccion'=>'required',						
			'email'=> array('required','email'),
			'password'=>'required',
			'password2'=>'required',
			'sucursal'=>'required',
			'rol'=>'required',
			'username' => array('required','unique:users,username'),
			'telefono'=> 'numeric',
			'celular' => 'numeric',
			);
		$validador = Validator::make(Input::all(),$reglas);		
		if($validador->passes() && $user->validarCI(Input::get('cedula')) && $user->validaTel(Input::get('telefono'))
			&& $user->validaCel(Input::get('celular'))){
			if(Input::get('password') == Input::get('password2')){
				if(Input::get('sucursal')!= '0'){
					$user->apellidos = Input::get('apellidos');
					$user->nombres = Input::get('nombres');
					$user->cedula = Input::get('cedula');
					$user->direccion = Input::get('direccion');
					$user->telefono = Input::get('telefono');
					$user->celular = Input::get('celular');
					$user->email = Input::get('email');
					$user->password = Hash::make(Input::get('password'));
					$user->rol = Input::get('rol');
					$user->username = Input::get('username');
					$user->sucursal_id = Input::get('sucursal');
					$user->estado = '1';
					$user->save();
					return Redirect::to('user')->with('status','okCreado');					
				}else{
					return Redirect::to('user')->with('status','errorSuc');
				}
			}else{
				return Redirect::to('user')->with('status','errorPass');
			}
		}else{
			return Redirect::to('user')->with('status','error');
		}
	}

	/**
	* Muestra formulario con los datos del usuario a editar
	* 
	* @param int $id
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
			'username'=>'required',
			'telefono'=> 'numeric',
			'celular' => 'numeric',
			);
		$validador = Validator::make(Input::all(),$reglas);
		if($validador->passes() && $user->validarCI(Input::get('cedula')) && $user->validaTel(Input::get('telefono'))
			&& $user->validaCel(Input::get('celular'))){
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
		}else{
			return Redirect::to('user')->with('status','error');
		}
	}

	/**
	* Presentar una vista para cambiar la contraseña de los usuarios
	* 
	* @param int id
	* @return Response
	**/
	public function getCambiar($id)
	{
		$user = User::findOrFail($id);
		return View::make('user.cambiarPass')->with('user',$user);
	}

	/**
	* Cambiar la constraseña de un usuario
	* 
	* @param
	* @return Response
	**/
	public function postCambiarpass()
	{
		$user = User::findOrFail(Input::get('user'));
		$reglas = array(
			'password' => array('required','alpha_num'),
			'password2' => array('required','alpha_num'));
		$validador = Validator::make(Input::all(),$reglas);
		if($validador->passes() && (Input::get('password') == Input::get('password2'))){
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			return Redirect::to('user')->with('status','okEditado');
		}else{
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
		$user = User::findOrFail($id);
		$user->estado = '0';
		$user->save();
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
		$user = User::findOrFail($id);
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
	public function getVer($id)
	{
		$user = User::findOrFail($id);
		$suc = Sucursal::findOrFail($user->sucursal_id);
		return View::make('user.detalleUser')->with(array('user'=>$user,'sucursal'=>$suc));
	}
}