@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Usuarios</title>
@stop
{{--Sección head--}}
@section('head')
	{{ HTML::style('css/mensajes.css'); }}
@stop
{{--Sección header--}}
@section('header')
	{{ HTML::link('admin','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
@stop
{{--Sección primario--}}
@section('primario')
	@if($user)
	<h1>Usuarios</h1>
	<?php $status=Session::get('status') ?>
	@if($status == 'error')
		<div id="error"  align="center">
			<p>!Error!, por favor verifica la información ingresada</p>
		</div>
	@elseif($status == 'okCreado')
		<div id="mensajeCrear"  align="center">
			<p>Información almacenada con éxito</p>
		</div>
	@elseif($status == 'okEditado')
		<div id="mensajeEditar"  align="center">
			<p>Información editada con éxito</p>
		</div>
	@elseif($status == 'okEstado') 
		<div id="mensajeEstado"  align="center">
			<p>Se modificó la información del usuario correctamente</p>
		</div>
	@elseif($status == 'errorPass')
		<div id="error">
			<p>Las contraseñas ingresadas no coinciden</p>
		</div>
	@elseif($status == 'errorSuc')
		<div id="error"  align="center">
			<p>Ingrese o active una sucursal antes de ingresar un usuario</p>
		</div>
	@endif
	<div data-role="controlgroup" data-type="horizontal">
		{{ HTML::link('user/nuevo', 'Nuevo',array('data-role'=>'button')); }}	
	</div>
	<table data-role="table" data-mode="reflow" class="ui-responsive  movie-list " >
		<thead>
			<tr>
				<th>N°</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Teléfono</th>
				<th>Rol</th>
				<th>Estado</th>
				<th>Sucursal</th>					
				<th>Acciones</th>					
			</tr>
		</thead>
		<tbody>
			@foreach($user as $user)				
			<tr>
				<td>{{ $user -> id}}</td>
				<td>{{ $user -> nombres}}</td>
				<td>{{ $user -> apellidos}}</td>
				<td>{{ $user -> telefono}}</td>
				@if($user -> rol == 'tecnico')				
					<td>Técnico</td>
				@elseif ($user -> rol == 'vendedor')
					<td>Vendedor</td>
				@elseif ($user -> rol == 'administrador')
					<td>Administrador</td>	
				@endif			
				@if($user -> estado == '1')					
					<td>Activo</td>
					@else
					<td>Inactivo</td>
				@endif
				<td>
					<?php $suc = Sucursal::findOrFail($user->sucursal_id); ?>
					{{ $suc->nombre}}
				</td>									
				<td> 
					{{ HTML::link( 'user/detalle/'.$user->id,'Ver', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}
					{{ HTML::link( 'user/modificar/'.$user->id,'Editar', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}
					@if($user->rol == 'administrador')
					@else
						@if($user -> estado == '1')
						{{ HTML::link( 'user/inactivar/'.$user->id,'Inactivar', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}
						@else
						{{ HTML::link( 'user/activar/'.$user->id,'Activar', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}
						@endif
					@endif						
				</td>				
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
		<span>No hay registros que mostrar</span>
	@endif
@stop
{{--Sección secundario--}}
@section('secundario')
	<p>Bienvenido <strong>{{Auth::user()->nombres}}</strong></p>
	<ul data-role="listview" class="ui-listview-outer" data-inset="true">
		<li data-role="list-divider">Opciones</li>
		<li data-icon="false">{{ HTML::link('empresa', 'Empresa'); }}</li>
		<li data-icon="false">{{ HTML::link('sucursal', 'Sucursales'); }}</li>		
		<li data-icon="false" class="fondo">Usuarios</li>
		<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
		<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>
		<li data-icon="false">{{ HTML::link('presupuesto', 'Presupuestos'); }}</li>		
		<li data-icon="false">{{ HTML::link('informe', 'Informes'); }}</li>					
		<li data-icon="false">{{ HTML::link('logout', 'Cerrar sesión'); }}</li>
	</ul>
@stop
{{--Scripts--}}
@section('scripts')
	{{ HTML::script('js/mensajes.js'); }}
@stop


