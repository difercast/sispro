<?php
/** 
* @Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version 1.0    @modificado:07 de abril del 2014
* @author Diego Castillo.
*
*/

class PresupuestoController extends BaseController
{
	public $restful = true;

	//Contructor de la clase
	public function __construct()
	{
		$this->beforeFilter('Auth');
		$this->beforeFilter('autenticacion');
	}

	/**
	* Envía los datos de los presupestos a la vista Presupuestos
	* 
	* @param
	* @return Response
	**/
	public function getIndex()
	{
		$prep = DB::table('presupuestos')->get();
		return View::make('presupuesto.index')->with('presupuesto',$prep);
	}

	/**
	* Presenta la vista de nuevo presupuesto
	* 
	* @param
	* @return Response
	**/
	public function getNuevo()
	{
		return View::make('presupuesto.form');
	}

	/**
	* Ingresa los datos del nuevo presupuesto
	* 
	* @param
	* @return Response
	**/
	public function postIngresar()
	{
		$presupuesto = new Presupuesto;
		$data = Input::all();
		$reglas = array(
			'detalle' => 'required',
			'valor' => 'required|numeric');
		$validador = Validator::make($data, $reglas);
		if($validador->passes()){
			$presupuesto->detalle = Input::get('detalle');
			$presupuesto->valor = Input::get('valor');			
			$presupuesto->save();
			return Redirect::to('presupuesto')->with('status','okCreado');
		}else{
			return Redirect::to('presupuesto')->with('status','error');
		}
		
	}

	/**
	* Presenta le formulario de modicación de datos
	* 
	* @param int id
	* @return Response
	**/
	public function getModificar($id)
	{
		$presupuesto = Presupuesto::findOrFail($id);
		return View::make('presupuesto.form')->with(array('presupuesto'=>$presupuesto,'status'=>'modificar'));
	}

	/**
	* Modifica los datos de un presupuesto específico
	* 
	* @param int id
	* @return Response
	**/
	public function postEditar()
	{
		$data = Input::all();
		$reglas = array(
			'detalle'=>'required',
			'valor'=>'required|numeric',
			'id'=>'required');
		$validador = Validator::make($data,$reglas);
		if($validador->passes()){
			$presupuesto = Presupuesto::findOrFail(Input::get('id'));
			$presupuesto->detalle = Input::get('detalle');
			$presupuesto->valor = Input::get('valor');
			$presupuesto->save();
			return Redirect::to('presupuesto')->with('status','okEditado');
		}else{
			return Redirect::to('presupuesto')->with('status','error');
		}
	}
}