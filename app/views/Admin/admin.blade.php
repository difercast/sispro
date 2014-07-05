@extends('layout.base')
@include('includes.styles')

@if(Auth::user()->rol == 'administrador')
	{{--Header--}}
	@section('header')	
	@stop
	{{--Head--}}
	@section('head')
		{{HTML::style('css/listas.css')}}
	@stop
	{{--Sección primario--}}
	@section('primario')
		<h1>Sisprocompu</h1>
		<span>Bienvenido al sistema de gestión de reparaciones de equipos informáticos, para emprezar por favor eliga una opción</span>
	@stop
	{{--Sección secundario--}}
	@section('secundario')
		<p>Bienvenido <strong>{{Auth::user()->nombres}}</strong></p>
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">
			<li data-role="list-divider">Opciones</li>
			<li data-icon="false">{{ HTML::link('empresa', 'Empresa'); }}</li>
			<li data-icon="false">{{ HTML::link('sucursal', 'Sucursales'); }}</li>
			<li data-icon="false">{{ HTML::link('user', 'Usuarios'); }}</li>
			 <li data-role="collapsible" data-iconpos="right" data-shadow="false" data-corners="false">
			    <h2 class="bordes">Informes</h2>
			    <ul data-role="listview" data-shadow="false" data-inset="true" data-corners="false">
					<li data-icon="false">{{ HTML::link('#', 'Reparaciones realizadas por técnico',array('data-rel'=>'popup')); }}</li>
					<li data-icon="false">{{ HTML::link('#', 'Equipos entregados por vendedor',array('data-rel'=>'popup')); }}</li>
				</ul>
			</li> 
			<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>
			<li data-icon="false">{{ HTML::link('presupuesto', 'Presupuesto'); }}</li>		
			<li data-icon="false"><a href="#">Cambiar contrase&ntildea</a></li>
			<li data-icon="false"><a href="logout">Salir</a></li>
		</ul>	
	@stop
@else
	{{Redirect::to('/')}}
@endif