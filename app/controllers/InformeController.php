<?php

/** 
* Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version: 1.0      @modificado: 09 de julio del 2014
* @author: Diego Castillo.
*
*/

class InformeController extends BaseController
{
	/** 
	 * Presenta una vista con los datos de las órdenes de trabajo requeridas por sucursal
	 *  @param 
	 *  @return Response
	 **/
	public function ingreso()
	{
		$fechaInicio = date(Input::get('fechaInicio'));
		$fechaFinal = date(Input::get('fechaFinal'));
		$sucursal = Input::get('sucursal');		
		if($sucursal == '0'){
			$orden = Orden::paginate(10);
			//$orden = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))
			// ->paginate(15);
			return View::make('informes.ingresoEquipos')->with(array('ordenes'=>$orden,'sucursal'=>'Todos los',
				'fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal));	
		}else{
			$orden = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))
			 ->where('Sucursal_id','=',$sucursal)
			 ->paginate(15);
			$suc = Sucursal::findOrFail($sucursal);
			return View::make('informes.ingresoEquipos')->with(array('ordenes'=>$orden,'sucursal'=>$suc->nombre,
				'fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal));	
		}		
	}

	/** 
	* Presenta una vista con la información de las órdenes de trabajo
	* según el usuario deseado
	*  @param 
	*  @return Response
	**/
	public function ingresoUsers()
	{
		$user = Input::get('user');
		$fechaInicio = date(Input::get('fechaIni'));
		$fechaFinal = date(Input::get('fechaFin'));
		$orden = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))->where('user_id','=',$user)->paginate(15);
		$user = User::findOrFail($user);
		return View::make('informes.ingresoEquiposUser')->with(array('ordenes'=>$orden,'user'=>$user->nombres));	
	}

	/** 
	* Presenta una vista con una liste de órdenes de trabajo reparados 
	* por un técnico específico
	*  @param 
	*  @return Response
	**/
	public function reparadosTecnico()
	{
		$tecnico = Input::get('tecnicos');
		$fechaInicio = date(Input::get('incio'));
		$fechaFinal = date(Input::get('fFinal'));
		$orden = Orden::whereBetween('fecha_terminado', array($fechaInicio, $fechaFinal))
		->where('tecnico','=',Input::get('tecnicos'))->paginate(15);
		$user = User::findOrFail($tecnico);
		return View::make('informes.reparadosTecnico')->with(array('ordenes'=>$orden,'tecnico'=>$user->nombres));	
	}

	/** 
	* Presenta la vista de órdenes de trabajo que no se han revisado
	*  @param 
	*  @return Response
	**/
	public function ordenesSinRevisar()
	{		
		$fechaInicio = date(Input::get('inicial'));
		$fechaFinal = date(Input::get('terminado'));
		$orden = Orden::whereBetween('fecha_ingreso', array($fechaInicio, $fechaFinal))
		->where('estado','=','0')->paginate(15);		
		return View::make('informes.sinRevisar')->with('ordenes',$orden);	
	}

	/** 
	* Presenta la vista de órdenes de trabajo entregados por un vendedor
	*  @param 
	*  @return Response
	**/
	public function entregadosVendedor()
	{		
		$fechaInicio = date(Input::get('principio'));
		$fechaFinal = date(Input::get('termino'));
		$vendedor = Input::get('vendedores');		
		if($vendedor == '0'){								
			$orden = Orden::whereBetween('fecha_entregado',array($fechaInicio,$fechaFinal))
			->where('entregado','=','1')->paginate(15);					
			return View::make('informes.entregaPorVendedor')->with('ordenes',$orden);
		}else{
			$orden = Orden::whereBetween('fecha_entregado',array($fechaInicio,$fechaFinal))
			->whereNested(function($query){				
				$query->where('entregado','=','1');
				$query->where('vendedor_id','=',Input::get('vendedores'));
			})->paginate(15);
			$user = User::findOrFail($vendedor);
			$vende = $user->nombres.' '.$user->apellidos;			
			return View::make('informes.entregaPorVendedor')->with(array('ordenes'=>$orden,'vendedor'=>$vende));			
		}								
	}

	/** 
	* Presenta la vista de órdenes de trabajo reparados pos un técnico
	* y entregados al cliente
	*  @param 
	*  @return Response
	**/
	public function repTecnicoEntregados()
	{
		$fechaInicio = date(Input::get('ini'));
		$fechaFinal = date(Input::get('fin'));
		$tecnico = Input::get('tecnicos');
		$orden = Orden::whereBetween('fecha_entregado', array($fechaInicio,$fechaFinal))
		->whereNested(function($query){			
				$query->where('entregado','=','1');
				$query->where('tecnico','=',Input::get('tecnicos'));
			})->paginate(15);
		$user = User::findOrFail($tecnico);
		$tecnico = $user->nombres.' '.$user->apellidos;
		return View::make('informes.repTecnicoEntr')->with(array('ordenes'=>$orden,'tecnico'=>$tecnico));
	}
}



