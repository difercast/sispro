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
	<h3>Bienvenido {{ Auth::user()->nombres }} para empezar por favor elija  una opción</h3>
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