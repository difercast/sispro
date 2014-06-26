<?php
/** 
*
* Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version 1.0      @modificado: 14 de abril del 2014
* @author Diego Castillo.
*
*/
class EquipoController extends BaseController
{

	public $restful = true;

	//Contructor de la clase
	public function __construct()
	{
		$this->beforeFilter('auth');
		$this->beforeFilter('authAny');
	}

	/**
	* Mostrar la vista equipos
	* 
	* @param
	* @return Response
	**/
	public function getIndex()
	{				
		$equipo = Equipo::paginate(15);
		return View::make('equipo.index')->with('equipos',$equipo);
	}

	/**
	* Presenta el formulario de edición de datos del equipo
	* 
	* @param int $id
	* @return Response
	**/
	public function getModificar($id)
	{
		$equipo = Equipo::findOrFail($id);
		return View::make('equipo.modificarEquipo')->with('equipo',$equipo);
	}

	/**
	* Modifica los datos del equipo
	* 
	* @param 
	* @return Response
	**/
	public function postEditar()
	{
		$reglas = array(
			'tipo'=>'required',
			'marca'=>'required',
			'modelo'=>'required',
			'serie'=>'required'
			);
		$validador = Validator::make(Input::all(),$reglas);
		if($validador->passes())
		{
			$equipo = Equipo::findOrFail(Input::get('id'));
			$equipo->tipo = Input::get('tipo');
			$equipo->marca = Input::get('marca');
			$equipo->modelo = Input::get('modelo');
			$equipo->serie = Input::get('serie');
			$equipo->save();
			return Redirect::to('equipo')->with('status','OkEditado');
		}else
		{
			return Redirect::guest('equipo')->with('status','error');
		}
	}
}
