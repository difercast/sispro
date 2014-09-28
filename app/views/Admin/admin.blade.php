@extends('layout.base')
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
		<?php $suc=Sucursal::findOrFail(Auth::user()->sucursal_id) ?>
		<h1 align="center">Sisprocompu - {{$suc->nombre}}</h1>						
		<h3 align='center'>Sistema de gestión de reparaciones de equipos informáticos</h3>
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