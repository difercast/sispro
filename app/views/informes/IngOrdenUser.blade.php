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
 	@if($nombres && $inicio && $final && $apellidos) 
 		<?php  $emp = Empresa::findOrFail(1); ?>		 		
 		<h2 align="center">{{$emp->razon_comercial}}</h2>
 		<h3 align="center">Ordenes de trabajo ingresadas a la empresa por un usuario</h3>
 		<p align="center">
 			<strong>Período: </strong> 	{{$inicio}} a {{$final}}<br/>
 			<strong>Usuario: </strong> {{$nombres}} {{$apellidos}}</p>
 		@if($ordenes && $ordenes2 && count($ordenes2)!=0)
 			<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" >
	 			<thead>
	 				<tr>
	 					<th>Nro de orden</th>
	 					<th>Fecha de ingreso</th>
	 					<th>Cliente</th> 					
	 					<th>Equipo</th>
	 					<th>Técnico</th>
	 					<th>Estado</th>
	 					<th>Entregado</th>	 					
	 				</tr>
	 			</thead>
	 			<tbody>
	 				@foreach($ordenes as $orden)
	 				<tr>	 					 		
	 					<td align="center">{{$orden->id}}</td>
	 					<td align="center">{{$orden->fecha_ingreso}}</td>
	 					<?php $cliente = Cliente::findOrFail($orden->cliente_id); ?>
	 					<td>{{$cliente->nombres}}</td>
	 					<?php $equipo = Equipo::findOrFail($orden->equipo_id); ?>	 					 
	 					<td>{{$equipo->tipo}} {{$equipo->marca}} {{$equipo->modelo}}</td>
	 					<?php $tecnic = User::findOrFail($orden->tecnico) ?>
	 					<td>{{$tecnic->nombres}}</td>
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
	 						<td align="center">No</td>
	 					@else
	 						<td align="center">Si</td>
	 					@endif	 					
	 				</tr>
	 				@endforeach
	 			</tbody>
	 		</table><br/>	 		
	 			{{$ordenes->appends(array('fechaInicio'=>$inicio,'fechaFinal'=>$final,'user'=>$user))->links()}}<br/><br/>
	 			<p><strong>Número de órdenes de trabajo: </strong>{{count($ordenes2)}}</p>		
 		@else
 			<br/>
 			<p><strong>No existen registros para mostrar</strong></p>
 			<br/>
 		@endif
 		<div  data-role="controlgroup" data-type="horizontal" align="center" data-mini="true">
 			{{HTML::link('ingresoUserPDF/'.$inicio.'/'.$final.'/'.$user,'Generar documento',array('target'=>'_blank','data-role'=>'button'))}}
 			{{HTML::link('informe','Regresar',array('data-role'=>'button'))}}
 		</div>
 		 		
 	@endif
 @stop