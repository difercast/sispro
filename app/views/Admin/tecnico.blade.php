@extends('layout.base')
@include('includes.styles')

@if(Auth::user()->rol == 'tecnico')

	{{ HTML::style('css/mensajes.css'); }}
	{{--Título--}}
	@section('titulo')
	<title>Técnico</title>
	@stop
	{{--Header--}}
	@section('header')
		<h1>Técnico</h1>
	@stop

	{{--Sección primario--}}
	@section('primario')
		{{--Mensajes de errores--}}
		<p align="center">Bienvenido<strong> {{ Auth::user()->nombres }} </strong>para empezar por favor elija  una opción</p>
		<?php $status=Session::get('status') ?>
		@if($status == "errorDatos")
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
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">		
			<li data-icon="false">{{ HTML::link('ordenTrabajo', 'Ingresar orden de trabajo'); }}</li>
			<li data-icon="false">{{ HTML::link('#', 'Lista Órdenes de trabajo'); }}</li>		
			<li data-role="collapsible" data-iconpos="right" data-corners="false">
	    		<h2>Buscar orden</h2>
	    		<ul data-role="listview" data-inset="false" data-shadow="false" data-corners="false" >
					<li data-icon="false">{{ HTML::link('ordenTrabajo/buscarporcliente', 'Por cliente',array('data-rel'=>'dialog')); }}</li>
					<li data-icon="false">{{ HTML::link('ordenTrabajo/buscar', 'Por número de orden',array('data-rel'=>'dialog')); }}</li>
				</ul>
			</li> 		
			<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>		
			<li data-icon="false">{{ HTML::link('logout', 'Salir'); }}</li>
		</ul>

	@stop
	{{ HTML::script('js/mensajes.js'); }}
	<script type="text/javascript">
		$(document).ready(function(){
			$('#mensajeCrear').click(function(){
				$('#mensajeCrear').hide();
			});
		});
	</script>

@else
	{{Redirect::to('/')}}
@endif


