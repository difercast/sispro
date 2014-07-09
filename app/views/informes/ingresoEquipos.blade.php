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
	
		<table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive">
			<thead>
				<tr>
					<th>Número de orden</th>
					<th>Cliente</th>
					<th>Fecha de ingreso</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orden as $orden)
					<tr>
						<td>{{$orden->id}}</td>
						<td>
							<?php $cliente = Cliente::findOrFail($orden->cliente_id); ?>
							{{$cliente->nombres}}
						</td>
						<td>{{$orden->fecha_ingreso}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>		
	
@stop


