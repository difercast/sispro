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
 	@if($inicio && $final && $tec) 
 		<?php  $emp = Empresa::findOrFail(1); ?>		 		
 		<h2 align="center">{{$emp->razon_comercial}}</h2>
 		<h3 align="center">Equipos reparados por técnico</h3>
 		<p align="center">
 			<strong>Período: </strong> 	{{$inicio}} a {{$final}}<br/>
 			<strong>Técnico: </strong> {{$tec->nombres}} {{$tec->apellidos}}</p>
 		@if($ordenes)
 			<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" >
	 			<thead>
	 				<tr>
	 					<th>Nro de orden</th>					
						<th>Fecha de ingreso</th>
						<th>Cliente</th>
						<th>Sucursal</th>						
						<th>Equipo</th>
						<th>Detalle de reparación</th>
						<th>Fecha terminado</th>
						<th>Entregado</th>	 					
	 				</tr>
	 			</thead>
	 			<tbody>
	 				@foreach($ordenes as $orden)
	 				<tr>	 					 		
	 					<td>{{$orden->id}}</td>
	 					<td>{{$orden->fecha_ingreso}}</td>
	 					<?php $cliente = Cliente::findOrFail($orden->cliente_id); ?>
	 					<td>{{$cliente->nombres}}</td>
	 					<?php $suc = Sucursal::findOrFail($orden->Sucursal_id) ?> 
	 					<td>{{$suc->nombre}}</td>
	 					<?php $equipo = Equipo::findOrFail($orden->equipo_id); ?>	 					 
	 					<td>{{$equipo->tipo}} {{$equipo->marca}} {{$equipo->modelo}}</td>
	 					<td>{{$orden->informe}}</td>
	 					<td>{{$orden->fecha_terminado}}</td>	 						 					
	 					@if($orden->entregado == '0')
	 						<td>No</td>
	 					@else
	 						<td>Si</td>
	 					@endif	 					
	 				</tr>
	 				@endforeach
	 			</tbody>
	 		</table><br/>
	 		<div align="center">
	 			{{$ordenes->appends(array('fechaInicio'=>$inicio,'fechaFinal'=>$final,'tecnico'=>$tecnico))->links()}}<br/><br/>
	 		</div>	 		
 		@endif
 		<div  data-role="controlgroup" data-type="horizontal" align="center" data-mini="true">
 			{{HTML::link('#','Generar documento',array('data-role'=>'button'))}}
 			{{HTML::link('informe','Regresar',array('data-role'=>'button'))}}
 		</div>
 		 		
 	@endif
 @stop