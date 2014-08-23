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
	@if(Auth::user()->rol == 'administrador')
		{{ HTML::link('admin','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@elseif(Auth::user()->rol == 'tecnico')
		{{ HTML::link('tecnico','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@elseif(Auth::user()->rol == 'vendedor')
		{{ HTML::link('vendedor','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@endif
@stop
{{--Sección primario--}}
@section('primario')
	@if($clientes)
		<h1>Clientes</h1>
		<?php $status=Session::get('status') ?>
		@if($status == 'error')
			<div id="error" align="center">
				<p>¡Error!, por favor verifica la información ingresada</p>
			</div>
		@elseif($status == 'okEditado')
			<div id="mensajeEditar" align="center">
				<p>La información del cliente se editó con éxito</p>			
			</div>
		@endif
		{{Form::open()}}
			<input id="filterTable-input" data-type="search" placeholder="Buscar cliente"/>
		{{Form::close()}}
		<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" data-filter="true" data-input="#filterTable-input">
			<thead>
				<tr>
					<th>CI</th>					
					<th>Nombres</th>					
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($clientes as $cliente)
				<tr>
					<td>{{$cliente->cedula}}</td>
					<td>{{$cliente->nombres}}</td>					
					<td>{{$cliente->direccion}}</td>
					<td>{{ $cliente->telefono}}</td>
					<td>					
						{{ HTML::link( 'cliente/modificar/'.$cliente->id,'Editar', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}					
						{{ HTML::link( 'cliente/ver/'.$cliente->id,'Ver', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}
						@if(Auth::user()->rol != 'administrador')
							{{ HTML::link( 'cliente/equipos/'.$cliente->id,'Equipos', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}
						@endif
					</td>
				</tr>
				@endforeach			
			</tbody>
		</table>
		<br>
		{{$clientes->links()}}
		<br><br>
	@else
		<span>No hay registros que mostrar</span>
	@endif
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
			<li data-icon="false" class="fondo">Clientes</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>
			<li data-icon="false">{{ HTML::link('presupuesto', 'Presupuestos'); }}</li>		
			<li data-icon="false">{{ HTML::link('informe', 'Informes'); }}</li>					
			<li data-icon="false">{{ HTML::link('logout', 'Cerrar sesión'); }}</li>	
		</ul>
	@elseif(Auth::user()->rol == 'tecnico')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
			<li data-icon="false">{{ HTML::link('ordenTrabajo', 'Ingresar orden de trabajo'); }}</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo/listado/1', 'Lista órdenes de trabajo'); }}</li>		 		
			<li data-icon="false">Clientes</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>		
			<li data-icon="false">{{ HTML::link('logout', 'Cerrar sesión'); }}</li>
		</ul>
	@elseif(Auth::user()->rol == 'vendedor')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
			<li data-icon="false">{{ HTML::link('ordenTrabajo', 'Ingresar orden de trabajo'); }}</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo/listado/1', 'Lista órdenes de trabajo'); }}</li>		 		
			<li data-icon="false">Clientes</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>		
			<li data-icon="false">{{ HTML::link('logout', 'Cerrar sesión'); }}</li>
		</ul>
	@endif
@stop
{{--Sección secripts--}}
@section('scripts')
	{{ HTML::script('js/mensajes.js'); }}
@stop

