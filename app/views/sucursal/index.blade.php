@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Sucursales</title>
@stop
{{--Head--}}
@section('head')
	{{ HTML::style('css/mensajes.css'); }}
@stop
{{--Sección header--}}
@section('header')	
	{{ HTML::link('admin','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
@stop
{{--Sección primario--}}
@section('primario')
	<h1>Sucursales</h1>
	<?php $status=Session::get('status') ?>
	@if($status == 'error')
		<div id="error" align="center">
			<p>!Error!, por favor verifica la información </p>
		</div>
	@elseif($status == 'okCreado')
		<div id="mensajeCrear" align="center">
			<p>Información almacenada con éxito</p>
		</div>
	@elseif($status == 'okEditado')
		<div id="mensajeEditar" align="center">
			<p>La información se editó con éxito</p>			
		</div>
	@elseif($status == 'okInactivo') 
		<div id="mensajeEstado" align="center">
			<p>Se inactivó la sucursal correctamente</p>
		</div>
	@elseif($status == 'okActivo') 
		<div id="mensajeEstado" align="center">
			<p>Se activó la sucursal correctamente</p>
		</div>
	@endif

	<div data-role="controlgroup" data-type="horizontal">
		{{ HTML::link('sucursal/nuevo', 'Nuevo',array('data-role'=>'button')); }}	
	</div>
	<table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive">
		<thead>
				<tr>
					<th>Nombre</th>
					<th>Provincia</th>
					<th>Ciudad</th>
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>Estado</th>					
					<th>Acciones</th>					
				</tr>
			</thead>
			<tbody>
				@foreach($sucursal as $sucursal)
				<tr>										
					<td>{{ $sucursal -> nombre}}</td>
					<td>{{ $sucursal -> provincia}}</td>
					<td>{{ $sucursal -> ciudad}}</td>
					<td>{{ $sucursal -> direccion}}</td>
					<td>{{ $sucursal -> telefono}}</td>					
					@if($sucursal -> estado == '1')					
						<td>Activo</td>
					@else
						<td>Inactivo</td>
					@endif
					<td> 
						{{ HTML::link( 'sucursal/ver/'.$sucursal->id,'Ver', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}
						{{ HTML::link( 'sucursal/modificar/'.$sucursal->id,'Editar', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}
						@if($sucursal->nombre == 'Matriz')
						@else
							@if($sucursal -> estado == '1')
							{{ HTML::link( 'sucursal/inactivar/'.$sucursal->id,'Inactivar', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}
							@else
							{{ HTML::link( 'sucursal/activar/'.$sucursal->id,'Activar', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}
							@endif
						@endif
						
					</td>					
				</tr>
				@endforeach
			</tbody>	
	</table>	
@stop
{{--Sección secundario--}}
@section('secundario')
	<p>Bienvenido <strong>{{Auth::user()->nombres}}</strong></p>
	<ul data-role="listview" class="ui-listview-outer" data-inset="true">
		<li data-role="list-divider">Opciones</li>
		<li data-icon="false">{{ HTML::link('empresa', 'Empresa'); }}</li>
		<li data-icon="false" class="fondo">Sucursales</li>		
		<li data-icon="false">{{ HTML::link('user', 'Usuarios'); }}</li>
		<li data-icon="false">{{ HTML::link('informe','Informes')}}</li>
		<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
		<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>
		<li data-icon="false"><a href="#">Cambiar contrase&ntildea </a></li>
		<li data-icon="false">{{ HTML::link('logout', 'Salir'); }}</li>		
	</ul>
@stop
{{--Scripts--}}
@section('scripts')
	{{ HTML::script('js/mensajes.js'); }}
@stop


