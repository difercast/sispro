<?php

/** 
* Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version: 1.0      @modificado: 09 de julio del 2014
* @author: Diego Castillo.
*
*/

class InformeController extends BaseController
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
		$sucursal = Sucursal::where('estado','=','1')->get();
		$select = array(0 => 'Todos')+$sucursal->lists('nombre','id');
		//todos los usuarios
		$users = User::all();
		$user = $users->lists('nombres','id');
		//Usuarios con rol Técnico
		$tec = User::where('rol','=','tecnico')->get();
		$tecnico = $tec->lists('nombres','id');
		//Usuarios con rol vendedor
		$ven = User::where('rol','=','vendedor')->get();
		$vendedor = array(0 => 'Todos')+$ven->lists('nombres','id');
		return View::make('informes.listaInformes')->with(array('sucursal'=>$select,'user'=>$user,'tecnicos'=>$tecnico,
			'vendedores'=>$vendedor));
	}

	/**
	* Presenta el formulario de edición de datos del equipo
	* 
	* @param int $id
	* @return Response
	**/
	public function postIngreso()
	{
		$ordenes = Orden::paginate();		
		return View::make('informes.ingreso')->with('ordenes',$orden);
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



