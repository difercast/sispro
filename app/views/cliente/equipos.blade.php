@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Clientes</title>
@stop
{{--Sección head--}}
@section('head')
	{{HTML::style('css/paginacion.css')}}
@stop
{{--Sección header--}}
@section('header')
	{{ HTML::link('cliente','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Sección primario--}}
@section('principal')
	@if($cliente && $equipos)
		<h2>Equipos de: {{$cliente->nombres}}</h2>
		{{Form::open()}}
			<input id="filterTable-input" data-type="search" placeholder="Buscar cliente"/>
		{{Form::close()}}
		<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" data-filter="true" data-input="#filterTable-input">
			<thead>
				<tr>
					<th>Id</th>					
					<th>Tipo</th>					
					<th>Marca</th>
					<th>Modelo</th>
					<th>Serie</th>
				</tr>
			</thead>
			<tbody>
				@foreach($equipos as $equipo)
				<tr>
					<td>{{$equipo->id}}</td>
					<td>{{$equipo->tipo}}</td>					
					<td>{{$equipo->marca}}</td>
					<td>{{$equipo->modelo}}</td>
					<td>{{$equipo->serie}}</td>					
				</tr>
				@endforeach			
			</tbody>
		</table>		
		<br>
		{{$equipos->links()}}
		<br><br>
	@else
		<span>No hay registros que mostrar</span>
	@endif
@stop
