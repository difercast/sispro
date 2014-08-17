@extends('layout.base')
@if(Auth::user()->rol == 'tecnico')	
	{{--Título--}}
	@section('titulo')
		<title>Técnico</title>
	@stop
	{{--Head--}}
	@section('head')
		{{ HTML::style('css/mensajes.css'); }}		
	@stop
	{{--Header--}}
	@section('header')		
	@stop
	{{--Sección primario--}}
	@section('primario')		
		<h2>Sisprocompu</h2>
		<span>Bienvenido al sistema de gestión de reparaciones de equipos informáticos, para emprezar por favor elija una opción</span>
		{{--Mensajes de errores--}}
		<?php $status=Session::get('status') ?>
		@if($status == "ordenCreada")
			<div  class="mensajeOrdenCreada" id="mensajeOrdenCreada" align="center">
				<p>Orden de trabajo N° {{Session::get('orden')}} ingresada correctamente				
				 {{ HTML::link('ingOrden/'.Session::get('orden'), 'Generar documento',array('target'=>'_blank','data-role'=>'button','data-mini'=>'true','data-inline'=>'true')); }}</p>
		</div>	
		@elseif($status == "errorEquipo")
			<div id="error"  align="center">
				<p>¡Error!, el equipo ya se encuenta ingresado a la empresa</p>
			</div>
		@elseif($status == "error")
			<div id="error"  align="center">
				<p>Error al ingresar la orden de trabajo, por favor inténtelo de nuevo más tarde</p>
			</div>
		@elseif($status == "errorDatos")
			<div id="error"  align="center">
				<p>Error al ingresar la información del cliente, verifica los datos e intenta de nuevo </p>
			</div>
		@endif					
	@stop
	{{--Sección secundario--}}	
	@section('secundario')
		<p>Bienvenido <strong>{{Auth::user()->nombres}}</strong></p>
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
			<li data-role="list-divider">Opciones</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo', 'Ingresar orden de trabajo'); }}</li>
			<li data-icon="false">{{ HTML::link('ordenTrabajo/listado/1', 'Lista órdenes de trabajo'); }}</li>		
			<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-inset="false">
	    		<h2>Buscar orden</h2>
	    		<ul data-role="listview" data-corners="false" >				
					<li data-icon="false">{{ HTML::link('#popupNumOrden', 'Por número de orden',array('data-rel'=>'popup')); }}</li>
					<li data-icon="false">{{ HTML::link('#popupCliente', 'Por cliente',array('data-rel'=>'popup')); }}</li>
				</ul>
			</li> 
			<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>		
			<li data-icon="false">{{ HTML::link('logout', 'Salir'); }}</li>
		</ul>
		{{--Popups para la búsqueda de órdenes de trabajo--}}
		<div data-role="popup" id="popupCliente" align="center">			
			{{--Prueba--}}
			<h2 align="center">Buscar cliente</h2>
			@if($cliente)
				{{Form::open()}}
					<input id="buscarCliente" data-type="search" placeholder="Buscar equipo">
				{{Form::close()}}
				{{Form::open(array('url'=>'ordenTrabajo/porcliente','id'=>'formBuscar'))}}
					<table data-role="table" data-mode="reflow" data-filter="true" data-input="#buscarCliente" class="movie-list ui-responsive">
						<thead>
							<tr>
								<th>OK</th>
								<th>Cliente</th>
								<th>CI</th>
							</tr>
						</thead>
						<tbody>
							@foreach($cliente as $cliente)
							<tr>
								<td>{{ Form::radio('cliente',$cliente->id)}}</td>
								<td>{{$cliente->nombres}}</td>
								<td>{{$cliente->cedula}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{Form::submit('Buscar')}}			
				{{Form::close()}}
			@endif	
		</div>
		<div data-role="popup" id="popupNumOrden">
			<div style="padding:10px 20px;">
				<p>por favor, ingrese el número de orden de trabajo</p>
				{{Form::open(array('url'=>'ordenTrabajo/mostrar'))}}
					{{Form::text('NumOrden')}}
					{{Form::submit('Buscar')}}			
				{{Form::close()}}
			</div>		
		</div>
	@stop	
	{{--Scripts--}}
	@section('scripts')
		{{ HTML::script('js/mensajes.js'); }}		
	@stop
@else
	{{Redirect::to('/')}}
@endif



