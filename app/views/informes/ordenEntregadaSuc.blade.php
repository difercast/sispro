@extends('layout.base')
{{--Título--}}
 @section('titulo')
 	<title>informes estadísticos</title>
 @stop
 {{--Head--}}
 @section('head')
 @stop
 {{--Header--}}
 @section('header')
 	{{ HTML::link('informe','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
 @stop
 {{--principal--}}
 @section('todo') 	
 	@if($inicio && $final && $suc) 
 		<?php  $emp = Empresa::findOrFail(1); ?>		 		
 		<h2 align="center">{{$emp->razon_comercial}}</h2>
 		<h3 align="center">Ordenes de trabajo entregados en una sucursal</h3>
 		<p align="center">
 			<strong>Período: </strong> 	{{$inicio}} a {{$final}}<br/>
 			<strong>Sucursal: </strong> {{$suc}}</p>
 		@if($ordenes && $ordenes2 && count($ordenes2)!= 0)
 			<?php $totalGeneral = 0; ?> 			
 				<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" >
		 			<thead>
		 				<tr>
		 					<th>Nro de orden</th>
							<th>Sucursal</th>
							<th>cliente</th>
							<th>Equipo</th>
							<th>Fecha de entrega</th>					
							<th>Informe</th>
							<th>Total</th>	 					
		 				</tr>
		 			</thead>
		 			<tbody>
		 				@foreach($ordenes as $orden)
		 				<tr>	 					 		
		 					<td>{{$orden->id}}</td>	
		 					<?php $suc = Sucursal::findOrFail($orden->Sucursal_id) ?> 
		 					<td>{{$suc->nombre}}</td> 					
		 					<?php $cliente = Cliente::findOrFail($orden->cliente_id); ?>
		 					<td>{{$cliente->nombres}}</td>	 					
		 					<?php $equipo = Equipo::findOrFail($orden->equipo_id); ?>	 					 
		 					<td>{{$equipo->tipo}} {{$equipo->marca}} {{$equipo->modelo}}</td>
		 					<td>{{$orden->fecha_entregado}}</td>
		 					<td>{{$orden->informe}}</td>
		 					<td>$ {{$orden->total}}</td> 					
		 				</tr>
		 				<?php $totalGeneral += $orden->total; ?>
		 				@endforeach
		 			</tbody>
		 		</table><br/>	 		
	 			{{$ordenes->appends(array('fechaInicio'=>$inicio,'fechaFinal'=>$final,'sucursal'=>$sucursal))->links()}}<br/><br/>	 			
	 		<p><strong>Número de órdenes:</strong> {{count($ordenes2)}}<br/><br/>
				<strong>Total presupuestado:</strong> ${{ $totalGeneral}} </p>
 		@else
 			<br/><br/><br/><br/>
 			<p align="center"><strong>No existen registros para mostrar</strong></p>
 			<br/><br/><br/><br/>
 		@endif
 		<div  data-role="controlgroup" data-type="horizontal" align="center" data-mini="true">
 			{{HTML::link('ordenEntregadaSucPDF/'.$inicio.'/'.$final.'/'.$sucursal,'Generar documento',array('target'=>'_blank','data-role'=>'button'))}} 			
 			{{HTML::link('informe','Regresar',array('data-role'=>'button'))}}
 		</div>
 		 		
 	@endif
 @stop