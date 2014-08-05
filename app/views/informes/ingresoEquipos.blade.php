@extends('layout.base')
{{--titulo--}}
@section('titulo')
	<title>Equipos ingresados a la empresa</title>
@stop

{{--header--}}
@section('header')
	{{ HTML::link('informe','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Principal--}}
@section('principal')
	<h2 align="center">Órdenes de trabajo ingresados a la empresa</h2>
	<p align="center"><strong>Período:</strong> {{$fechaInicio }} a {{$fechaFinal}}<br><br>
		<strong>Sucursal: </strong>{{$sucursal}}</p>
	@if($ordenes)				
		<br>
		<p>Número total de órdenes de trabajo ingresadas: {{count($ordenes)}}</p>
		<br>
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
		<br/>
		<div align="center">
			<?php echo $ordenes->links(); ?><br>		
		</div>		
		<div data-role="controlgroup" data-type="horizontal" align="center">
			{{ HTML::link('#', 'Generar documento',array('data-role'=>'button')); }}	
		</div><br/>	
	@else
		<p>No hay registros que mostrar</p>
	@endif	
@stop
