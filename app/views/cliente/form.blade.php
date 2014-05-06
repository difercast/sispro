@extends('layout.base')
@include('includes.styles')

<?php
	if ($estado == 'editar'):		
		$accion = "Editar";
		$form = array('url'=>'cliente/editar');
		$detalle = "Por favor, ingrese los nuevos datos del cliente";
	else:		
		$accion = "Detalle de";
		$detalle = "información detallada del usuario";		
		$form = array();
	endif;		
?>
{{--Sección título--}}
@section('titulo')
	<title> {{ $accion }} cliente</title>
@stop
{{--Sección header--}}
@section('header')
	<h1> {{ $accion}} cliente</h1>
	{{ HTML::link('cliente','',array('class'=>'ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all')); }}
@stop
{{--Sección primario--}}
@section('primario')
	<h3>{{ $detalle}}</h3>
	{{Form::open($form)}}
		<div data-role="fieldcontain">
			{{Form::label('nombres','Nombres:')}}
			@if($estado == "editar")
				{{Form::text('nombres',$cliente->nombres,array('data-mini'=>'true'))}}
			@else
				{{Form::text('nombres',$cliente->nombres,array('data-mini'=>'true','readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('cedula','Cédula:')}}
			@if($estado == "editar")
				{{Form::text('cedula',$cliente->cedula,array('data-mini'=>'true'))}}
			@else
				{{Form::text('cedula',$cliente->cedula,array('data-mini'=>'true','readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('direccion','Dirección:')}}
			@if($estado == "editar")
				{{Form::textarea('direccion',$cliente->direccion)}}
			@else
				{{Form::textarea('direccion',$cliente->direccion,array('readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('telefono','Teléfono:')}}
			@if($estado == "editar")
				{{Form::text('telefono',$cliente->telefono,array('data-mini'=>'true'))}}
			@else
				{{Form::text('telefono',$cliente->telefono,array('data-mini'=>'true','readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('celular','Celular:')}}
			@if($estado == "editar")
				{{Form::text('celular',$cliente->celular,array('data-mini'=>'true'))}}
			@else
				{{Form::text('celular',$cliente->celular,array('data-mini'=>'true','readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('email','Email:')}}
			@if($estado == "editar")
				{{Form::email('email',$cliente->email,array('data-mini'=>'true'))}}
			@else
				{{Form::email('email',$cliente->email,array('data-mini'=>'true','readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('observaciones','Observaciones:')}}
			@if($estado == "editar")
				{{Form::textarea('observaciones',$cliente->observaciones)}}
			@else
				{{Form::textarea('observaciones',$cliente->observaciones,array('readonly'=>'true'))}}
			@endif
		</div>
		@if($estado == "editar")
				{{Form::hidden('id',$cliente->id)}}
				<div data-role="controlgroup" data-type="horizontal" align="center">
					{{Form::submit('Guardar')}}
				</div>
		@endif
	{{Form::close()}}
@stop