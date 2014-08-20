<?php

/** 
* @Sistema de administración y control de servicios de mantenimiento técnico
* @version: 1.0      @modificado: 23 de marzo del 2014
* @author: Diego Castillo.
*
*/

class EmpresaController extends BaseController
{
	public $restful = true;
	
	//Constructor de la clase
	public function __construct()
	{
		$this -> beforeFilter('auth');
		$this -> beforeFilter('autenticacion');
	}
	
	/**
	* Mostrar una lista de empresas
	* 
	* @param
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
		$empresa = Empresa::findOrFail($id);		
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
		$empresa = Empresa::findOrFail($id);		
		$reglas = array(
			'ruc' => array('required','max:13'),
			'razon_social' => 'required',
			'razon_comercial' => 'required',
			'actividad' => array('required','numeric')
		);
		$validador = Validator::make(Input::all(),$reglas);
		if($validador->passes() && $empresa->validarRuc(Input::get('ruc')) && $empresa->validaActividad(Input::get('actividad'))){
			$empresa->ruc = Input::get('ruc');
			$empresa->razon_social = Input::get('razon_social');
			$empresa->razon_comercial = Input::get('razon_comercial');
			$empresa->actividad = Input::get('actividad');
			$empresa->save();
			return Redirect::to('empresa')->with('status','okEditado');
		}else{
			return  Redirect::to('empresa')->with('status','error');
		}
	}

}
