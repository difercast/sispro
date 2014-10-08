<?php
/** 
* @Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version 1.0    @modificado:11 de septiembre del 2014
* @author Diego Castillo.
*
*/
class ConsultaController extends BaseController
{
	public $restful = true;

	/**
	* Genera una respuesta Json con las órdenes activar del cliente ingresado
	* 
	* @param
	* @return Response
	**/
	public function getOrdenes($ci)
	{
		if($cliente = Cliente::where('cedula','=',$ci)->get()){
			$cli = $cliente->first();
		$ordenes = Orden::where('cliente_id','=',$cli->id)
		->where('entregado','=','0')
		->orderBy('id','desc')->get();
		return Response::json($ordenes);	
		}
		//$cliente = Cliente::where('cedula','=',$ci)->get();
		
	}


	public function getConsulta()
	{
		#$cedula = Request::get('ci');
		$cedula = '1104537228';
		$error = true;
		$numOrdenes = array();
		$user = new User;
		if($user->validarCI($cedula)){			
			$clientes = Cliente::where('cedula','=',$cedula)->get();
			if(!is_null($clientes)){
				$error = false;
				$cliente = $clientes->first();
				$ordenes = Orden::where('cliente_id','=',$cliente->id)
				->where('entregado','=','0')
				->get();
				foreach ($ordenes as $orden) {
					array_push($numOrdenes, $orden->id);
				}				
			}			
		}		
		return Response::json(array('ordenes'=>$numOrdenes,'error'=>$error));
		#return Response::json(array('error'=>'true'));
	}

	/**
	* genera una respuesta Json con el detalle de la orden de trabajo seleccionada
	* 
	* @param
	* @return Response
	**/
	public function getOrden()
	{
		$ordenTrabajo = Orden::all();
		return Response::json($ordenTrabajo);

	}
}