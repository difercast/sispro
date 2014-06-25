<?php

/** 
* @Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version: 1.0      @modificado: 23 de marzo del 2014
* @author: Diego Castillo.
*
*/

class EmpresaController extends BaseController
{
	//Constructor
	public function __construct()
	{
		$this -> beforeFilter('auth');
		$this -> beforeFilter('autenticacion');
	}

	public $restful = true;

	
	/**
	* Mostrar una lista de empresas
	* 
	*
	* @return Response
	**/
	public function getIndex()
	{
		
		$empresa = DB::table('empresas')->get();
		return View::make('empresa.index')->with('empresa',$empresa);
		
	}
	
	/**
	*Muestra el formulario para editar datos de la empresa
	* 
	* @param int id
	* @return Response
	**/
	public function getModificar($id)
	{
		$empresa = Empresa::find($id);
		if(is_null($empresa))
		{
			return "No existe el id solicitado de la empresa";
		}
		
		return View::make('empresa.editar')->with('empresa',$empresa);
	}
	
	/**
	*Modificar la información de la empresa
	* 
	* @param
	* @return Response
	**/
	public function postEditar()
	{
		$id=Input::get('id');
		$empresa = Empresa::find($id);
		if(is_null($empresa))
		{
			App::abort(404);
		}

		$reglas = array(
			'ruc' => 'required|max:13',
			'razon_social' => 'required',
			'razon_comercial' => 'required',
			'actividad' => 'required|numeric'
			);
		$validador = Validator::make(Input::all(),$reglas);

		if($validador->passes() && $empresa->validarRuc(Input::get('ruc')))
		{
			$empresa->ruc = Input::get('ruc');
			$empresa->razon_social = Input::get('razon_social');
			$empresa->razon_comercial = Input::get('razon_comercial');
			$empresa->actividad = Input::get('actividad');

			$empresa->save();
			return Redirect::to('empresa')->with('status','okEditado');
		}
		else
		{			
			//return  Redirect::route('empresa')->with('status','error');
			return Redirect::guest('empresa')->with('status', 'error');
		}
					
	}

}