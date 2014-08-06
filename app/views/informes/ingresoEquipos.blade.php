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
				</tr>
			</thead>
			<tbody>
				@foreach($ordenes as $orden)
					<tr>
						<td>{{$orden->id}}</td>						
					</tr>
				@endforeach
			</tbody>
		</table>
		<br/>		
		{{$ordenes->links()}}<br/>				
	@else
		<p>No hay registros que mostrar</p>
	@endif	
@stop