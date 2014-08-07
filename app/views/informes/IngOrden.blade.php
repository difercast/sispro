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
 	@if($sucursal && $inicio && $final) 
 		<?php  $emp = Empresa::findOrFail(1); ?>		 		
 		<h2 align="center">{{$emp->razon_comercial}}</h2>
 		<h3 align="center">Ordenes de trabajo ingresadas a la empresa</h3>
 		<p align="center">
 			<strong>Período: </strong> 	{{$inicio}} a {{$final}}<br/>
 			<strong>Sucursal: </strong> {{$sucursal}}</p>
 		@if($ordenes)
 			<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" >
	 			<thead>
	 				<tr>
	 					<th>Nro de orden</th>
	 					<th>Fecha de ingreso</th>
	 					<th>Cliente</th> 					
	 					<th>Equipo</th>
	 					<th>Estado</th>
	 					<th>Entregado</th>
	 					<th>Técnico</th>
	 				</tr>
	 			</thead>
	 			<tbody>
	 				@foreach($ordenes as $orden)
	 				<tr>	 					 		
	 					<td>{{$orden->id}}</td>
	 					<td>{{$orden->fecha_ingreso}}</td>
	 					<?php $cliente = Cliente::findOrFail($orden->cliente_id); ?>
	 					<td>{{$cliente->nombres}}</td>
	 					<?php $equipo = Equipo::findOrFail($orden->equipo_id); ?>	 					 
	 					<td>{{$equipo->tipo}} {{$equipo->marca}} {{$equipo->modelo}}</td>
	 					@if($orden->estado == '0')
	 						<td>Sin revisar</td>
	 					@elseif($orden->estado == '1')
	 						<td>En reparación</td>
	 					@elseif($orden->estado == '2')
	 						<td>Reparación terminada</td>
	 					@elseif ($orden->estado == '3')
	 						<td>Dado de baja</td>
	 					@endif
	 					@if($orden->entregado == '0')
	 						<td>No</td>
	 					@else
	 						<td>Si</td>
	 					@endif
	 					<?php $tec = User::findOrFail($orden->tecnico) ?>
	 					<td>{{$tec->nombres}}</td>
	 				</tr>
	 				@endforeach
	 			</tbody>
	 		</table><br/> 		 	
 		@endif
 		<div  data-role="controlgroup" data-type="horizontal" align="center" data-mini="true">
 			{{HTML::link('#','Generar documento',array('data-role'=>'button'))}}
 			{{HTML::link('informe','Regresar',array('data-role'=>'button'))}}
 		</div>
 		 		
 	@endif
 @stop