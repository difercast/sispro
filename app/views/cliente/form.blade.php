@extends('layout.base')
<?php
	if ($estado == 'editar'):		
		$accion = "Editar cliente";
		$form = array('url'=>'cliente/editar','id'=>'formCliente');
		$detalle = "Por favor, ingrese los nuevos datos del cliente";
	else:		
		$accion = "Información del cliente";
		$detalle = "";		
		$form = array();
	endif;		
?>
{{--Sección título--}}
@section('titulo')
	<title> {{ $accion }} cliente</title>
@stop
{{--Sección head--}}
@section('head')
		
@stop
{{--Sección header--}}
@section('header')	
	{{ HTML::link('cliente','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Sección principal--}}
@section('principal')
	<h1 align="center">{{$accion}}</h1>
	<p><strong>{{ $detalle}}</strong></p>
	@if($estado == 'editar')
		<span style="color: red;">* Elementos requeridos</span>
	@endif
	{{Form::open($form)}}
		<div data-role="fieldcontain">			
			@if($estado == "editar")
				{{Form::label('nombres','Nombres: *')}}
				{{Form::text('nombres',$cliente->nombres,array('data-mini'=>'true','id'=>'nombres'))}}
			@else
				{{Form::label('nombres','Nombres:')}}
				{{Form::text('nombres',$cliente->nombres,array('data-mini'=>'true','readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">			
			@if($estado == "editar")
				{{Form::label('cedula','Cédula: *')}}
				{{Form::text('cedula',$cliente->cedula,array('data-mini'=>'true','id'=>'cedula','maxlength'=>'10'))}}
			@else
				{{Form::label('cedula','Cédula:')}}
				{{Form::text('cedula',$cliente->cedula,array('data-mini'=>'true','readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">			
			@if($estado == "editar")
				{{Form::label('direccion','Dirección: *')}}
				{{Form::textarea('direccion',$cliente->direccion,array('id'=>'direccion'))}}
			@else
				{{Form::label('direccion','Dirección:')}}
				{{Form::textarea('direccion',$cliente->direccion,array('readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('telefono','Teléfono:')}}
			@if($estado == "editar")
				{{Form::text('telefono',$cliente->telefono,array('data-mini'=>'true','id'=>'telefono','maxlength'=>'7'))}}
			@else
				{{Form::text('telefono',$cliente->telefono,array('data-mini'=>'true','readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('celular','Celular:')}}
			@if($estado == "editar")
				{{Form::text('celular',$cliente->celular,array('data-mini'=>'true','id'=>'celular','maxlength'=>'10'))}}
			@else
				{{Form::text('celular',$cliente->celular,array('data-mini'=>'true','readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('email','Email:')}}
			@if($estado == "editar")
				{{Form::email('email',$cliente->email,array('data-mini'=>'true','id'=>'email'))}}
			@else
				{{Form::email('email',$cliente->email,array('data-mini'=>'true','readonly'=>'true'))}}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('observaciones','Observaciones:')}}
			@if($estado == "editar")
				{{Form::textarea('observaciones',$cliente->observaciones,array('id'=>'observaciones'))}}
			@else
				{{Form::textarea('observaciones',$cliente->observaciones,array('readonly'=>'true'))}}
			@endif
		</div>
		@if($estado == "editar")
			{{Form::hidden('id',$cliente->id)}}
			<div data-role="controlgroup" data-type="horizontal" align="center">
				{{Form::submit('Editar')}}
				{{HTML::link('cliente','Regresar',array('data-role'=>'button'))}}
			</div>
		@else
			<div data-role="controlgroup" data-type="horizontal" align="center">
				{{HTML::link('cliente','Regresar',array('data-role'=>'button'))}}
			</div>
		@endif
	{{Form::close()}}
@stop
@section('scripts')
<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposClienteMod.js');}}
@stop