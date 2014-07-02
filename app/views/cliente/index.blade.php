@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Clientes</title>
@stop
{{--Sección head--}}
@section('head')
@stop
{{--Sección header--}}
@section('header')
	@if(Auth::user()->rol == 'administrador')
		{{ HTML::link('admin','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@elseif(Auth::user()->rol == 'tecnico')
		{{ HTML::link('tecnico','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@elseif(Auth::user()->rol == 'vendedor')
		{{ HTML::link('vendedor','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@endif
@stop
@if($clientes)
{{--Sección primario--}}
	@section('primario')
	<h1>Clientes</h1><br/>
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
	<br/>
	{{Form::open()}}
		<input id="filterTable-input" data-type="search" placeholder="Buscar cliente"/>
	{{Form::close()}}
	<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" data-filter="true" data-input="#filterTable-input">
		<thead>
			<tr>
				<th>Nombres</th>
				<th>Dirección</th>
				<th>Teléfono</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($clientes as $cliente)
			<tr>
				<td>{{ $cliente -> nombres}}</td>
				<td>{{ $cliente -> direccion}}</td>
				<td>{{ $cliente -> telefono}}</td>
				<td>					
					{{ HTML::link( 'cliente/modificar/'.$cliente->id,'Editar', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}					
					{{ HTML::link( 'cliente/ver/'.$cliente->id,'Ver', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}										
				</td>
			</tr>
			@endforeach			
		</tbody>
	</table>
	{{$clientes->links()}}
@stop
{{--Sección secundario--}}
@section('secundario')
	<p>Bienvenido <strong>{{Auth::user()->nombres}}</strong></p>
	@if(Auth::user()->rol == 'administrador')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">
			<li data-role="list-divider">Opciones</li>
			<li data-icon="false">{{ HTML::link('empresa', 'Empresa'); }}</li>
			<li data-icon="false">{{ HTML::link('sucursal', 'Sucursales'); }}</li>			
			<li data-icon="false">{{ HTML::link('user', 'Usuarios'); }}</li>
			<li data-icon="false"><a href="#">Informes</a></li>
			<li data-icon="false" class="fondo">Clientes</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>
			<li data-icon="false"><a href="#">Cambiar contrase&ntildea </a></li>
			<li data-icon="false"><a href="logout">Salir</a></li>
		</ul>
	@elseif(Auth::user()->rol == 'tecnico')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
			<li data-role="list-divider">Opciones</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo', 'Ingresar orden de trabajo'); }}</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo/listado', 'Lista órdenes de trabajo'); }}</li>				 	
			<li data-icon="false" class="fondo">Clientes</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>		
			<li data-icon="false">{{ HTML::link('logout', 'Salir'); }}</li>
		</ul>
	@elseif(Auth::user()->rol == 'vendedor')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
			<li data-role="list-divider">Opciones</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo', 'Ingresar orden de trabajo'); }}</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo/listado', 'Lista órdenes de trabajo'); }}</li>					
			<li data-icon="false" class="fondo">Clientes</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>		
			<li data-icon="false">{{ HTML::link('logout', 'Salir'); }}</li>
		</ul>
	@endif
@stop
{{--Sección secripts--}}
@section('scripts')
	{{ HTML::script('js/mensajes.js'); }}
@stop

@endif

