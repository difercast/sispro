@extends('layout.base')
@include('includes.styles')

{{--Sección título--}}
@section('titulo')
	<title>Equipos</title>
@stop

{{--Sección header--}}
@section('header')
	<h1>Equipos</h1>
	@if(Auth::user()->rol == 'administrador')
		{{ HTML::link('admin','',array('class'=>'ui-btn ui-icon-home ui-btn-icon-notext ui-corner-all')); }}
	@elseif(Auth::user()->rol == 'tecnico')
		{{ HTML::link('tecnico','',array('class'=>'ui-btn ui-icon-home ui-btn-icon-notext ui-corner-all')); }}
	@elseif(Auth::user()->rol == 'vendedor')
		{{ HTML::link('vendedor','',array('class'=>'ui-btn ui-icon-home ui-btn-icon-notext ui-corner-all')); }}
	@endif
@stop

{{--Sección primario--}}
@section('primario')
	<?php $status=Session::get('status') ?>
	@if($status == 'error')
		<div id="error" align="center">
			<p>¡Error!, por favor verifica la información ingresada</p>
		</div>
	@elseif($status == 'okEditado')
		<div id="mensajeEditar" align="center">
			<p>La información del equipo se editó con éxito</p>			
		</div>
	@endif
	<h3 align="center">Lista de equipos</h3>
	{{Form::open()}}
		<input id="filterTable-input" data-type="search">
	{{Form::close()}}
	<table data-role="table" data-mode="reflow" data-filter="true" data-input="#filterTable-input" class="movie-list ui-responsive" align="center">
		<thead>
			<tr>
				<th>Tipo de equipo</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Número de serie</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($equipo as $equipo)
			<tr>
				<td>{{ $equipo -> tipo}}</td>
				<td>{{ $equipo -> marca}}</td>
				<td>{{ $equipo -> modelo}}</td>
				<td>{{ $equipo -> serie}}</td>
				<td>{{ HTML::link( 'equipo/modificar/'.$equipo->id,'Editar', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}</td>
			</tr>
			@endforeach			
		</tbody>		
	</table>	
@stop

{{--Sección secundario--}}
@section('secundario')
	@if(Auth::user()->rol == 'administrador')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">
			<li data-icon="false">{{ HTML::link('empresa', 'Empresa'); }}</li>
			<li data-icon="false">{{ HTML::link('sucursal', 'Sucursales'); }}</li>			
			<li data-icon="false">{{ HTML::link('user', 'Usuarios'); }}</li>
			<li data-icon="false"><a href="#">Informes</a></li>
			<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
			<li data-icon="false">Equipos</li>
			<li data-icon="false"><a href="#">Cambiar contrase&ntildea </a></li>
			<li data-icon="false"><a href="logout">Salir</a></li>
		</ul>
	@elseif(Auth::user()->rol == 'tecnico')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
			<li data-icon="false">{{ HTML::link('ordenTrabajo', 'Ingresar orden de trabajo'); }}</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo/listado', 'Lista órdenes de trabajo'); }}</li>		
			<li data-role="collapsible" data-iconpos="right" data-corners="false">
	    		<h2>Buscar orden</h2>
	    		<ul data-role="listview" data-inset="false" data-shadow="false" data-corners="false" >
					<li data-icon="false">{{ HTML::link('ordenTrabajo/buscarporcliente', 'Por cliente',array('data-rel'=>'dialog')); }}</li>
					<li data-icon="false">{{ HTML::link('ordenTrabajo/buscar', 'Por número de orden',array('data-rel'=>'dialog')); }}</li>
				</ul>
			</li> 		
			<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
			<li data-icon="false">Equipos</li>		
			<li data-icon="false">{{ HTML::link('logout', 'Salir'); }}</li>
		</ul>
	@elseif(Auth::user()->rol == 'vendedor')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
			<li data-icon="false"><a href="#">Ingresar orden</a></li>
			<li data-icon="false"><a href="#">Clientes</a></li>
			<li data-icon="false">Equipos</li>
			<li data-icon="false"><a href="#">Cambiar contrase&ntildea </a></li>
			<li data-icon="false"><a href="logout">Salir</a></li>
		</ul>
	@endif
@stop