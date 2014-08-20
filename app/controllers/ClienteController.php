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
		$cliente = Cliente::orderBy('nombres','asc')->paginate(15);		
		return View::make('cliente.index')->with('clientes',$cliente);
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
		$ci = Input::get('cedula');
		$tel = Input::get('telefono');
		$cel = Input::get('celular');
		$reglas = array(
			'nombres'=>'required',
			'cedula'=>'required',
			'email'=>'email'
			);
		$validador = Validator::make(Input::all(),$reglas);
		if($validador->passes()){
			$cliente = Cliente::findOrFail(Input::get('id'));
			if($cliente->validarCI($ci) && $cliente->validarTelefono($tel) && $cliente->validarCelular($cel)){
				$cliente->nombres = Input::get('nombres');
				$cliente->cedula = Input::get('cedula');
				$cliente->direccion = Input::get('direccion');
				$cliente->telefono = Input::get('telefono');
				$cliente->celular = Input::get('celular');
				$cliente->email = Input::get('email');
				$cliente->observaciones = Input::get('observaciones');
				$cliente->save();
				return Redirect::to('cliente')->with('status','okEditado');
			}else{
				return Redirect::to('cliente')->with('status','error');				
			}			
		}else{
			return Redirect::to('cliente')->with('status','error');	
		}
	}

  
}
