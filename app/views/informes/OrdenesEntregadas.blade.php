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
 	@if($inicio && $final && $vend) 
 		<?php  $emp = Empresa::findOrFail(1); ?>		 		
 		<h2 align="center">{{$emp->razon_comercial}}</h2>
 		<h3 align="center">Equipos entregados por vendedor</h3>
 		<p align="center">
 			<strong>Período: </strong> 	{{$inicio}} a {{$final}}<br/>
 			<strong>Técnico: </strong> {{$vend->nombres}} {{$vend->apellidos}}</p>
 		@if($ordenes)
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
	 		<div align="center">
	 			{{$ordenes->appends(array('fechaInicio'=>$inicio,'fechaFinal'=>$final,'vendedor'=>$vendedor))->links()}}<br/><br/>	 			
	 		</div>
	 		<p><strong>Número de órdenes:</strong> {{count($ordenes)}}<br/><br/>
				<strong>Total presupuestado:</strong> ${{ $totalGeneral}} </p>
 		@endif
 		<div  data-role="controlgroup" data-type="horizontal" align="center" data-mini="true">
 			{{HTML::link('#','Generar documento',array('data-role'=>'button'))}}
 			{{HTML::link('informe','Regresar',array('data-role'=>'button'))}}
 		</div>
 		 		
 	@endif
 @stop