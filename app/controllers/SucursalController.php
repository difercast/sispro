<?php
/** 
* @Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version 1.0      @modificado:07 de abril del 2014
* @author Diego Castillo.
*
*/

class SucursalController extends BaseController
{
	//Constructor de la clase
	public function __construct()
	{
		$this -> beforeFilter('auth');
		$this -> beforeFilter('autenticacion');

	}
	public $restful = true;

	/**
	* Mostrar la vista de sucursales
	* 
	* @param
	* @return Response
	**/
	public function getIndex()
	{
		$sucursal = DB::table('sucursales')->get();
		return View::make('sucursal.index')->with('sucursal',$sucursal);
	}

	/**
	* Muestra el formulario de ingreso de datos de la sucursal
	* 
	* @param
	* @return Response
	**/
	public function getNuevo()
	{
		return View::make('sucursal.form')->with('status','nuevo');
	}

	/**
	* Determina el número de sucursales ingresados
	* @param 
	* @return int
	**/
	public static function numSuc()
	{
		$suc = Sucursal::all();
		$numero = count($suc);
		return $numero;
	}

	/**
	* Función para ingresar los datos de la sucursal a la base de datos
	* 
	* @param 
	* @return Response
	**/	
	public function postIngresar()
	{
		$numero = self::numSuc();		
		$empresa = Empresa::findOrFail(1);
		$sucursal = new Sucursal;
		$reglas = array(
			'provincia' => 'required',
			'ciudad' => 'required',
			'direccion' => 'required',
			'telefono' => 'required',
			'celular' => 'required',
			'email' => 'required|email'
			);
		$validador = Validator::make(Input::all(), $reglas);		
		if($validador->passes() && $sucursal->validarTelefonos(Input::get('telefono'),Input::get('celular'))){
			$sucursal -> provincia = Input::get('provincia');
			$sucursal -> ciudad  = Input::get('ciudad');
			$sucursal -> direccion = Input::get('direccion');
			$sucursal -> telefono = Input::get('telefono');
			$sucursal -> celular = Input::get('celular');
			$sucursal -> email = Input::get('email');
			$sucursal -> empresa_id = $empresa->id;
			$sucursal -> estado = '1';
			if($numero == '0'){
				$sucursal -> nombre = 'Matriz';
			}
			else{
				$sucursal -> nombre = 'Sucursal '.$numero;
			}
			$sucursal -> save();
			return Redirect::to('sucursal')->with('status','okCreado');
		}
		else{
			return Redirect::to('sucursal')->with('status','error');
		}
	}

	/**
	* Muestra el formulario para editar sucursales
	* 
	* @param int $id
	* @return Response
	**/	
	public function getModificar($id)
	{
		$sucursal = Sucursal::find($id);
		if(is_null($sucursal))
		{
			return App::abort(404);
		}
		return View::make('sucursal.form')->with(array('sucursal'=>$sucursal,'status'=>'modificar'));
	}

	/**
	* Función para modificar lalinformación de la sucursal seleccionada
	* 
	* @param 
	* @return Response
	**/	
	public function postEditar()
	{
		$id = Input::get('id');
		$sucursal = Sucursal::findOrFail($id);
		$reglas = array(
			'provincia' => 'required',
			'ciudad' => 'required',
			'direccion' => 'required',
			'telefono' => 'required',
			'celular' => 'required',
			'email' => 'required|email'
			);
		$validador = Validator::make(Input::all(), $reglas);
		if($validador->passes() && $sucursal->validarTelefonos(Input::get('telefono'),Input::get('celular'))){
			$sucursal -> provincia = Input::get('provincia');
			$sucursal -> ciudad  = Input::get('ciudad');
			$sucursal -> direccion = Input::get('direccion');
			$sucursal -> telefono = Input::get('telefono');
			$sucursal -> celular = Input::get('celular');
			$sucursal -> email = Input::get('email');
			$sucursal -> save();
			return Redirect::guest('sucursal')->with('status','okEditado');
		}
		else{
			return Redirect::guest('sucursal')->with('status','error');
		}
	}

	/**
	* Inactivar una sucursal
	* 
	* @param int id de la sucursal
	* @return Response
	**/
	public function getInactivar($id)
	{
		$sucursal = Sucursal::findOrFail($id);
		if(is_null($sucursal)){
			return App::abort(404);
		}
		$sucursal -> estado = '0';
		$sucursal -> save();
		return Redirect::to('sucursal')->with('status','okInactivo');
	}

	/**
	* Activar una sucursal si esta ha sido inactivada
	* 
	* @param int id 
	* @return Response
	**/
	public function getActivar($id)
	{
		$sucursal = Sucursal::findOrFail($id);
		if(is_null($sucursal)){
			return App::abort(404);
		}
		$sucursal -> estado = '1';
		$sucursal -> save();
		return Redirect::to('sucursal')->with('status','okActivo');
	}
	/**
	* Enviar datos de la sucursal
	* 
	* @param int id 
	* @return Response
	**/
	public function getVer($id)
	{
		$suc = Sucursal::findOrFail($id);
		return View::make('sucursal.form')->with(array('sucursal'=>$suc,'status'=>'ver'));
	}
}
