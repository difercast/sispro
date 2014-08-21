@extends('layout.base')
@if(Auth::user()->rol == 'vendedor')
	{{--Título--}}
	@section('titulo')
	<title>Vendedor</title>
	@stop
	{{--Head--}}
	@section('head')
		{{ HTML::style('css/mensajes.css'); }}
		{{HTML::style('css/listas.css')}}
	@stop
	{{--Header--}}
	@section('header')
	@stop
	{{--Sección primario--}}
	@section('primario')
		<h1>Sisprocompu</h1>
		<p>Bienvenido al sistema de administración y control de servicios de mantenimiento técnico, para empezar por favor eliga una opción</p>
		{{--Mensajes de error--}}
		<?php $status=Session::get('status') ?>
		@if($status == "ordenCreada")
			<div  class="mensajeOrdenCreada" id="mensajeOrdenCreada" align="center">
				<p>Orden de trabajo N° {{Session::get('orden')}} ingresada correctamente				
				 {{ HTML::link('ingOrden/'.Session::get('orden'), 'Generar documento',array('target'=>'_blank','data-role'=>'button','data-mini'=>'true','data-inline'=>'true')); }}</p>
		</div>
		@elseif($status == "errorDatos")
			<div id="errorDatos"  align="center">
				<p>Error al ingresar la información del cliente, verifica los datos e intenta de nuevo </p>
			</div>
		@elseif($status == "errorEquipo")
			<div id="error"  align="center">
				<p>¡Error!, el equipo ya se encuenta ingresado a la empresa</p>
			</div>
		@elseif($status == "error")
			<div id="error"  align="center">
				<p>Error al ingresar la orden de trabajo, por favor verifique los datos ingresados</p>
			</div>
		@elseif($status == "okCreado")
			<div id="mensajeCrear"  align="center">
				<p>Orden de trabajo ingresada correctamente</p>
			</div>
		@endif
	@stop
	{{--Sección secundario--}}
	@section('secundario')
		<p>Bienvenido <strong>{{Auth::user()->nombres}}</strong></p>
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
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
			<li data-icon="false">{{ HTML::link('logout', 'Cerrar sesión'); }}</li>
		</ul>
		{{--Popups para la búsqueda de órdenes de trabajo--}}
		<div data-role="popup" id="popupCliente" align="center">
			<div style="padding:10px 20px;">
				<p>por favor, seleccione el cliente</p>
				{{Form::open(array('url'=>'ordenTrabajo/porcliente'))}}
					{{Form::select('cliente',$cliente)}}
					{{Form::submit('Buscar')}}			
				{{Form::close()}}
			</div>		
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
	{{--Secripts--}}
	@section('scripts')
		{{ HTML::script('js/mensajes.js'); }}
	@stop
@else
	{{Redirect::to('/')}}
@endif