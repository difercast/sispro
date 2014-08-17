@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>SISPROCOMPU</title>
@stop
{{--Sección head--}}
@section('head')
		
@stop
{{--Sección header--}}
@section('header')	
	{{ HTML::link('/','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}	
@stop
{{--Sección principal--}}
@section('primario')
	@if($ordenes)
		<h2>Sistema de administración y control de servicios de mantenimiento técnico</h2>
		<p>La siguiente lista presenta las órdenes de trabajo activas...</p>
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">
			<li data-role="list-divider">Lista de órdenes de trabajo activas</li>
			@foreach($ordenes as $orden)
				<li data-icon="false">{{HTML::link('consultaOrden/'.$orden->id,'Orden Nro '.$orden->id)}} </li>
			@endforeach			
		</ul>
	@endif
@stop

@section('secundario')
	<h2>Cliente:</h2>
	<p><strong>Nombres: </strong> {{$cliente->nombres}}</p>
	<p><strong>Dirección: </strong> {{$cliente->direccion}}</p>
	<p><strong>Cédula: </strong>{{$cliente->cedula}}</p>
	<p><strong>Teléfono: </strong>{{$cliente->telefono}}</p>	
@stop
@section('scripts')
<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposClienteMod.js');}}
@stop