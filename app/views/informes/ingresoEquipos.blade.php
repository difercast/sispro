@extends('layout.base')
{{--titulo--}}
@section('titulo')
	<title>Equipos ingresados a la empresa</title>
@stop
{{--head--}}
@section('head')

@stop
{{--header--}}
@section('header')
	{{ HTML::link('informe','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Principal--}}
@section('principal')
	<h1>Equipos ingresados a la empresa</h1>
	@if($ordenes)
		<div data-role="controlgroup" data-type="horizontal">
			{{ HTML::link('#', 'Generar documento',array('data-role'=>'button')); }}	
		</div><br/>	
		<p><strong>Sucursal: </strong>{{$sucursal}}</p><br/>
			<table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive">
				<thead>
					<tr>
						<th>Nro de orden</th>					
						<th>Cliente</th>
						<th>Fecha de ingreso</th>
						<th>Usuario</th>
						<th>Equipo</th>
						<th>Problema</th>
					</tr>
				</thead>
				<tbody>
					@foreach($ordenes as $orden)
						<tr>
							<td>{{$orden->id}}</td>
							<td>
								<?php $cliente = Cliente::findOrFail($orden->cliente_id); ?>
								{{$cliente->nombres}}
							</td>
							<td>{{$orden->fecha_ingreso}}</td>
							<td>
								<?php $user = User::findOrFail($orden->user_id); ?>
								{{$user->nombres}}
							</td>
							<td>
								<?php $equipo = Equipo::findOrFail($orden->equipo_id); ?>
								{{$equipo->tipo}}
							</td>
							<td>{{$orden->problema}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<br>
			{{$ordenes->links()}}<br>
			<p>Número de órdenes de trabajo: {{count($ordenes)}}</p>	
	@else
		<p>No hay registros que mostrar</p>
	@endif	
@stop

