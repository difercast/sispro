@extends('layout.base')
@include('includes.styles')

{{ HTML::style('css/mensajes.css'); }}
{{--Sección header--}}
@section('titulo')
	<title>Empresa</title>
	@show
@stop
@section('header')
	<h1>Empresa</h1>
	{{ HTML::link('admin','',array('class'=>'ui-btn ui-icon-home ui-btn-icon-notext ui-corner-all')); }}
@stop

{{--Sección primario--}}
@section('primario')
	<h2 align="center">Empresa</h2>
	<?php $status=Session::get('status') ?>
	@if($status == 'error')
		<div id="error" align="center">			
				<p>¡Error!, por favor verifique los datos ingresados</p>
		</div>
	@elseif($status == 'okEditado')
		<div id='mensajeEditar' align="center">
			<p>La información de la empresa se modificó correctamente</p>
		</div>		
	@endif	
	@if($empresa)
		<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" align="center" >
			<thead>
				<tr>
					<th>Razón comercial</th>
					<th>Razón social</th>
					<th>RUC</th>
					<th>Actividad</th>					
					<th>Acciones</th>					
				</tr>
			</thead>
			<tbody>
				<tr>
					@foreach($empresa as $empresa)
						<td>{{ $empresa -> razon_comercial }}</td>
						<td>{{ $empresa -> razon_social }}</td>
						<td>{{ $empresa -> ruc }}</td>
						<td>{{ $empresa -> actividad }}</td>						
						<td>{{ HTML::link( 'empresa/modificar/'.$empresa->id,'Editar', array('data-role'=>'button','data-mini'=>'true')) }}</td>
					@endforeach
				</tr>
			</tbody>
		</table>
	@endif
		
@stop

{{--Sección secundario--}}
@section('secundario')
	<ul data-role="listview" class="ui-listview-outer" data-inset="true">
		<li data-icon="false">Empresa</li>
		<li data-icon="false">{{ HTML::link('sucursal', 'Sucursales'); }}</li>		
		<li data-icon="false">{{ HTML::link('user', 'Usuarios'); }}</li>
		<li data-icon="false"><a href="#">Informes</a></li>
		<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
		<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>
		<li data-icon="false"><a href="#">Cambiar contrase&ntildea </a></li>
		<li data-icon="false">{{ HTML::link('logout', 'Salir'); }}</li>
	</ul>
@stop
{{ HTML::script('js/mensajes.js'); }}
{{ HTML::style('css/mensajes.css'); }}
