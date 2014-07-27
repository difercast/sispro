@extends('layout.base')
{{--titulo--}}
@section('titulo')
	<title>Equipos reparados por técnico y entregados</title>
@stop
{{--header--}}
@section('header')
	{{ HTML::link('informe','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Principal--}}
<?php $total = 0.00; ?>
@section('principal')
	<h1>Equipos entregados por vendedores</h1>
		<div data-role="controlgroup" data-type="horizontal">
			{{ HTML::link('#', 'Generar documento',array('data-role'=>'button')); }}	
		</div><br/>
		@if(isset($tecnico))
			<p><strong>Técnico: </strong>{{$tecnico}}</p><br/>
		@endif
		{{Form::open()}}
			<input id="buscar" data-type="search" placeholder="Buscar equipo">
		{{Form::close()}}
		<br/>
		<table data-role="table" data-mode="reflow" data-filter="true" data-input="#buscar" class="movie-list ui-responsive">
			<thead>
				<tr>
					<th>Nro de orden</th>
					<th>Sucursal</th>
					<th>cliente</th>
					<th>Fecha de entrega</th>
					<th>Equipo</th>
					<th>Informe</th>
					<th>Total</th>
				</tr>					
			</thead>
			<tbody>
				@if(isset($ordenes))																				
					@foreach($ordenes as $orden)					
						<tr>
							<td>{{$orden->id}}</td>
							<?php $suc = Sucursal::findOrFail($orden->Sucursal_id) ?>
							<td>{{$suc->nombre}}</td>
							<?php $cliente = Cliente::findOrFail($orden->cliente_id) ?>
							<td>{{$cliente->nombres}}</td>
							<td>{{$orden->fecha_entregado}}</td>
							<?php $equipo = Equipo::findOrFail($orden->equipo_id) ?>
							<td>{{$equipo->tipo}}</td>
							<td>{{$orden->informe}}</td>
							<td>${{$orden->total}}</td>							
						</tr>					
					@endforeach
					<?php $total += $orden->total; ?>
				@endif
			</tbody>
		</table><br/>		
		{{$ordenes->links()}}
		<br/><br/>
		<p><strong>Número de órdenes:</strong> {{count($ordenes)}}<br/><br/>
			<strong>Tótal presupuestado:</strong> ${{ $total}} </p>
@stop