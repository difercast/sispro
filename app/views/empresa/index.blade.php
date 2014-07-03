@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Empresa</title>
	@show
@stop
{{--Sección head--}}
@section('head')
	{{ HTML::style('css/mensajes.css'); }}
@stop
@section('header')
	{{ HTML::link('admin','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
@stop
{{--Sección primario--}}
@section('primario')
	<h1>Empresa</h1>	
	<?php $status=Session::get('status') ?>
	@if($status == 'error')
		<div id="error" align="center">			
				<p>¡Error!, por favor verifique los datos ingresados </p>
		</div>
	@elseif($status == 'okEditado')
		<div class='mensajeEditar' align="center">
			<p>La información de la empresa se modificó correctamente</p>
		</div>		
	@endif	
	@if($empresa)
		<table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive">		
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
						<td>{{ HTML::link( 'empresa/modificar/'.$empresa->id,'Editar', array('data-role'=>'button','data-mini'=>'true','data-ajax'=>'true')) }}</td>
					@endforeach
				</tr>
			</tbody>
		</table>
	@endif
		
@stop
{{--Sección secundario--}}
@section('secundario')
	<p>Bienvenido <strong>{{Auth::user()->nombres}}</strong></p>
	<ul data-role="listview" class="ui-listview-outer" data-inset="true">
		<li data-role="list-divider">Opciones</li>
		<li class="fondo" data-icon="false">Empresa</li>
		<li data-icon="false">{{ HTML::link('sucursal', 'Sucursales'); }}</li>		
		<li data-icon="false">{{ HTML::link('user', 'Usuarios'); }}</li>
		<li data-icon="false" ><a href="#">Informes</a></li>
		<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
		<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>
		<li data-icon="false"><a href="#">Cambiar contrase&ntildea </a></li>
		<li data-icon="false">{{ HTML::link('logout', 'Salir'); }}</li>
	</ul>
@stop




