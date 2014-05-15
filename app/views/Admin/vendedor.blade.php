@extends('layout.base')
@include('includes.styles')

@if(Auth::user()->rol == 'vendedor')
{{--Título--}}
@section('titulo')
<title>Vendedor</title>
@stop
{{--Header--}}
@section('header')
	<h1>Vendedor</h1>
@stop

{{--Sección primario--}}
@section('primario')
	<span>Bienvenido <strong>{{ Auth::user()->nombres }}</strong> para empezar por favor elija  una opción</span>
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
		<li data-icon="false"><a href="#">Ingresar orden</a></li>
		<li data-icon="false"><a href="#">Clientes</a></li>
		<li data-icon="false"><a href="#">Equipos</a></li>
		<li data-icon="false"><a href="#">Cambiar contrase&ntildea </a></li>
		<li data-icon="false"><a href="logout">Salir</a></li>
	</ul>
@stop
@else
	{{Redirect::to('/')}}
@endif