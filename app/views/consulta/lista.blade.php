@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Lista de órdenes activas</title>
@stop
{{--Sección head--}}
@section('head')
		
@stop
{{--Sección header--}}
@section('header')	
	{{ HTML::link('/logCliente','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}	
@stop
{{--Sección principal--}}
@section('primario')
	@if($ordenes && $estado == 'ok')		
		<p>La siguiente lista presenta las órdenes de trabajo activas...</p>
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">
			<li data-role="list-divider">Lista de órdenes de trabajo activas</li>
			@foreach($ordenes as $orden)
				<li data-icon="false">{{HTML::link('consultaOrden/'.$orden->id,'Orden Nro '.$orden->id)}} </li>
			@endforeach			
		</ul>
	@else
		<p>No existan órdenes de trabajo activas para el cliente seleccionado. O el cliente ingresado no existe</p>
	@endif
@stop
{{--Sección secundario--}}
@section('secundario')
	@if($ordenes && $estado == 'ok')		
		<h2>Cliente:</h2>
		<p><strong>Nombres: </strong> {{$cliente->nombres}}</p>
		<p><strong>Dirección: </strong> {{$cliente->direccion}}</p>
		<p><strong>Cédula: </strong>{{$cliente->cedula}}</p>
		<p><strong>Teléfono: </strong>{{$cliente->telefono}}</p>		
	@endif	
@stop
@section('scripts')
<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposClienteMod.js');}}
@stop