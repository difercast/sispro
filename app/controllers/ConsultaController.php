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
		$cliente = Cliente::where('cedula','=',$ci)->get();
		$cli = $cliente[0];
		$ordenes = Orden::where('cliente_id','=',$cli->id)
		->where('entregado','=','0')
		->orderBy('id','desc')->get();
		return Response::json($ordenes);
	}

	/**
	* genera una respuesta Json con el detalle de la orden de trabajo seleccionada
	* 
	* @param
	* @return Response
	**/
	public function getOrden($orden)
	{
		$ordenTrabajo = Orden::findOrFail($orden);
		return Response::json($ordenTrabajo);

	}
}