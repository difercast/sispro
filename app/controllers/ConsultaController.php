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
	* @param int id
	* @return Response
	**/
	public function getConsulta()
	{
		$cedula = Request::get('ci');		
		$error = true;
		$numOrdenes = array();
		$user = new User;
		$cliente;
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
			}else{
				return Response::json(array('errores'=>$error),200)->setCallback( Input::get('callback') );	
			}
		return Response::json(array('cliente'=>$cliente->toArray(),'ordenes'=>$numOrdenes,'errores'=>$error),200)->setCallback( Input::get('callback') );	
		}else{
			return Response::json(array('errores'=>$error),200)->setCallback( Input::get('callback') );
		}
			
	}

	/**
	* genera una respuesta Json con el detalle de la orden de trabajo seleccionada
	* 
	* @param
	* @return Response
	**/
	public function getOrden()
	{	
		$numOrden = Request::get('orden');
		$error = true;
		$estado;
		$detalle;
		$informe;
		$presupuesto;
		$valor;
		$ordenTrabajo = Orden::find($numOrden);
		$cliente = Cliente::find($ordenTrabajo->cliente_id);
		$equipo = Equipo::find($ordenTrabajo->equipo_id);
		$suc = Sucursal::find($ordenTrabajo->Sucursal_id);
		if(!is_null($ordenTrabajo)){
			$error = false;
			if($ordenTrabajo->estado == '0'){
				$estado = 'Sin revisar';
				$detalle = ' Equipo aún no revisado';
				$informe = 'Equipo no reparado, hasta el momento';
			}elseif($ordenTrabajo->estado == '1'){
				$estado = 'En reparación';
				$detalle = $ordenTrabajo->detalle;
				$informe = $ordenTrabajo->informe;
			}elseif ($ordenTrabajo->estado == '2') {
				$estado = 'reparación terminada';
				$detalle = $ordenTrabajo->detalle;
				$informe = $ordenTrabajo->informe;
			}
			if($ordenTrabajo->presupuestado == '0'){
				$presupuesto = 'Sin presupuestar';
				$valor = '$0.00';
			}else{
				$presupuesto = 'Orden de trabajo presupuestada';
				$valor = '$'.$ordenTrabajo->total;
			}
			return Response::json(array('errores'=>$error,'orden'=>$ordenTrabajo->toArray(),'cliente'=>$cliente->toArray(),
				'equipo'=>$equipo->toArray(),'sucursal'=>$suc->toArray(),'estado'=>$estado,
			'detalle'=>$detalle,'informe'=>$informe, 'presupuesto'=>$presupuesto,'valor'=>$valor),200)->setCallback(Input::get('callback'));
		}else{
			return Response::json(array('errores'=>$error),200)->setCallback(Input::get('callback'));
		}

	}
}