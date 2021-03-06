@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Equipos</title>
@stop
{{--Sección head--}}
@section('head')	
	{{ HTML::style('css/mensajes.css'); }}	
@stop
{{--Sección header--}}
@section('header')
	@if(Auth::user()->rol == 'administrador')
		{{ HTML::link('admin','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@elseif(Auth::user()->rol == 'tecnico')
		{{ HTML::link('tecnico','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@elseif(Auth::user()->rol == 'vendedor')
		{{ HTML::link('vendedor','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@endif
@stop
{{--Sección primario--}}
@section('primario')
	<h1>Equipos</h1>
	<?php $status=Session::get('status') ?>
	@if($status == 'error')
		<div id="error" align="center">
			<p>¡Error!, por favor verifica la información ingresada</p>
		</div>
	@elseif($status == 'OkEditado')
		<div id="mensajeEditar" align="center">
			<p>La información del equipo se editó con éxito</p>			
		</div>
	@endif
	{{Form::open()}}
		<input id="filterTable-input" data-type="search" placeholder="Buscar equipo">
	{{Form::close()}}
	<br/>
	@if($equipos)
		<table data-role="table" data-mode="reflow" data-filter="true" data-input="#filterTable-input" class="movie-list ui-responsive" align="center">
			<thead>
				<tr>
					<th>Id</th>
					<th>Tipo de equipo</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Número de serie</th>
					<th>Acciones</th>
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
					<td>{{ HTML::link( 'equipo/modificar/'.$equipo->id,'Editar', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}</td>
				</tr>
				@endforeach			
			</tbody>		
		</table>
		<br/>
			{{$equipos->links()}}
		<br/><br><br><br><br>
	@else
		<p>No hay registros que mostrar</p>
	@endif
@stop
{{--Sección secundario--}}
@section('secundario')
	@if(Auth::user()->rol == 'administrador')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">
			<li data-role="list-divider">Opciones</li>
			<li data-icon="false">{{ HTML::link('empresa', 'Empresa'); }}</li>
			<li data-icon="false">{{ HTML::link('sucursal', 'Sucursales'); }}</li>
			<li data-icon="false">{{ HTML::link('user', 'Usuarios'); }}</li>			
			<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
			<li data-icon="false" class="fondo">Equipos</li>
			<li data-icon="false">{{ HTML::link('presupuesto', 'Presupuestos'); }}</li>		
			<li data-icon="false">{{ HTML::link('informe', 'Informes'); }}</li>					
			<li data-icon="false">{{ HTML::link('logout', 'Cerrar sesión'); }}</li>	
		</ul>
	@elseif(Auth::user()->rol == 'tecnico')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
			<li data-role="list-divider">Opciones</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo', 'Ingresar orden de trabajo'); }}</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo/listado/1', 'Lista órdenes de trabajo'); }}</li>
			<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
			<li data-icon="false" class="fondo">Equipos</li>		
			<li data-icon="false">{{ HTML::link('logout', 'Cerrar sesión'); }}</li>
		</ul>
	@elseif(Auth::user()->rol == 'vendedor')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
			<li data-role="list-divider">Opciones</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo', 'Ingresar orden de trabajo'); }}</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo/listado/1', 'Lista órdenes de trabajo'); }}</li>
			<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
			<li data-icon="false" class="fondo">Equipos</li>		
			<li data-icon="false">{{ HTML::link('logout', 'Cerrar sesión'); }}</li>
		</ul>
	@endif
@stop
{{--Scripts--}}
@section('scripts')
	{{ HTML::script('js/mensajes.js'); }}
@stop

