@extends('layout.base')
@include('includes.styles')

{{--Sección clientes--}}
@section('titulo')
<title>Clientes</title>
@stop

{{--Sección header--}}
@section('header')
	<h1>Clientes</h1>
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
	<h3 align="center">Clientes de la empresa</h3>
	{{Form::open()}}
		<input id="filterTable-input" data-type="search">
	{{Form::close()}}
	<table data-role="table" data-mode="reflow" data-filter="true" data-input="#filterTable-input" class="movie-list ui-responsive" align="center" >
		<thead>
			<tr>
				<th>Nombres</th>
				<th>Dirección</th>
				<th>Teléfono</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($cliente as $cliente)
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
			<br />
			{{--{{ $cliente->links() }}--}}
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
			<li data-icon="false">Clientes</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>
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
			<li data-icon="false">Clientes</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>		
			<li data-icon="false">{{ HTML::link('logout', 'Salir'); }}</li>
		</ul>
	@elseif(Auth::user()->rol == 'vendedor')
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
			<li data-icon="false"><a href="#">Ingresar orden</a></li>
			<li data-icon="false">Clientes</li>
			<li data-icon="false"><a href="#">Equipos</a></li>
			<li data-icon="false"><a href="#">Cambiar contrase&ntildea </a></li>
			<li data-icon="false"><a href="logout">Salir</a></li>
		</ul>
	@endif
@stop
