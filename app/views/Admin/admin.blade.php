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
		<p>Bienvenido al sistema de administración y control de servicios de mantenimiento técnico, para empezar por favor eliga una opción</p>
	@stop
	{{--Sección secundario--}}
	@section('secundario')
		<p>Bienvenido <strong>{{Auth::user()->nombres}}</strong></p>
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">
			<li data-role="list-divider">Opciones</li>
			<li data-icon="false">{{ HTML::link('empresa', 'Empresa'); }}</li>
			<li data-icon="false">{{ HTML::link('sucursal', 'Sucursales'); }}</li>
			<li data-icon="false">{{ HTML::link('user', 'Usuarios'); }}</li>			
			<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
			<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>
			<li data-icon="false">{{ HTML::link('presupuesto', 'Presupuestos'); }}</li>		
			<li data-icon="false">{{ HTML::link('informe', 'Informes'); }}</li>					
			<li data-icon="false">{{ HTML::link('logout', 'Cerrar sesión'); }}</li>					
		</ul>	
	@stop
@else
	{{Redirect::to('/')}}
@endif