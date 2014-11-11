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
	{{ HTML::link('admin','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
@stop
{{--Sección primario--}}
@section('primario')
	<h1>Sucursales</h1>
	<?php $status=Session::get('status') ?>
	@if($status == 'error')
		<div id="error" align="center">
			<p>!Error!, por favor verifica la información ingresada</p>
		</div>
	@elseif($status == 'okCreado')
		<div id="mensajeCrear" align="center">
			<p>Información de la sucursal almacenada con éxito</p>
		</div>
	@elseif($status == 'okEditado')
		<div id="mensajeEditar" align="center">
			<p>La información de la sucursal se editó con éxito</p>			
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
	@if($sucursales)
		<div data-role="controlgroup" data-type="horizontal">
			{{ HTML::link('sucursal/nuevo', 'Nuevo',array('data-role'=>'button')); }}	
		</div>
		<table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive">
			<thead>
					<tr>
						<th>Nro</th>
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
					@foreach($sucursales as $sucursal)
					<tr>
						<td>{{$sucursal->id}}</td>										
						<td>{{ $sucursal->nombre}}</td>
						<td>{{ $sucursal->provincia}}</td>
						<td>{{ $sucursal->ciudad}}</td>
						<td>{{ $sucursal->direccion}}</td>
						<td>{{ $sucursal->telefono}}</td>					
						@if($sucursal->estado == '1')					
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
		<br/>
			{{$sucursales->links()}}
		<br/><br><br><br><br>
	@else
		<p>No hay registros para mostrar</p>
	@endif	
@stop
{{--Sección secundario--}}
@section('secundario')
	<p>Bienvenido <strong>{{Auth::user()->nombres}}</strong></p>
	<ul data-role="listview" class="ui-listview-outer" data-inset="true">
		<li data-role="list-divider">Opciones</li>
		<li data-icon="false">{{ HTML::link('empresa', 'Empresa'); }}</li>
		<li data-icon="false" class="fondo">Sucursales</li>		
		<li data-icon="false">{{ HTML::link('user', 'Usuarios'); }}</li>			
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
@section('')


