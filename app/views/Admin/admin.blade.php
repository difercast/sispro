@extends('layout.base')
@include('includes.styles')

@if(Auth::user()->rol == 'administrador')
{{--Header--}}
@section('header')	
@stop

{{--Sección primario--}}
@section('primario')
	<h2>Sisprocompu</h2>
	<span>Bienvenido al sistema de gestión de reparaciones de equipos informáticos, para emprezar por favor eliga una opción</span>
@stop

{{--Sección secundario--}}
@section('secundario')
	<p>Bienvenido <strong>{{Auth::user()->nombres}}</strong></p>
	<ul data-role="listview" class="ui-listview-outer" data-inset="true">
		<li data-icon="false">{{ HTML::link('empresa', 'Empresa'); }}</li>
		<li data-icon="false">{{ HTML::link('sucursal', 'Sucursales'); }}</li>
		<li data-icon="false">{{ HTML::link('user', 'Usuarios'); }}</li>
		<li data-icon="false"><a href="#">Informes</a></li>
		<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
		<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>
		<li data-icon="false"><a href="#">Presupuestos</a></li>		
		<li data-icon="false"><a href="#">Cambiar contrase&ntildea </a></li>
		<li data-icon="false"><a href="logout">Salir</a></li>
	</ul>
@stop
@else
	{{Redirect::to('/')}}
@endif