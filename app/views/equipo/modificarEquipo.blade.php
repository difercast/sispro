@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Modificar equipo</title>
@stop
{{--Sección head--}}
@section('head')
@stop
{{--Sección header--}}
@section('header')	
	{{ HTML::link('equipo','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Sección principal--}}
@section('principal')
		<h1 align="center">Modificar equipo</h1>
		<p><strong>Por favor, ingrese la nueva informacipon del equipo</strong></p>
		<span style="color: red;">* Elementos requeridos</span>
		{{ Form::open(array('url'=>'equipo/editar','id'=>'formEquipoMod'))}}
			<div data-role="fieldcontain">
				{{ Form::label('tipo','Tipo de equipo: *')}}
				{{ Form::text('tipo',$equipo->tipo,array('data-mini'=>'true','id'=>'tipo','class'=>'required'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('marca','Marca: *')}}
				{{ Form::text('marca',$equipo->marca,array('data-mini'=>'true','id'=>'marca'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('modelo','Modelo: *')}}
				{{ Form::text('modelo',$equipo->modelo,array('data-mini'=>'true','id'=>'modelo'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('serie','Número de serie: *')}}
				{{ Form::text('serie',$equipo->serie,array('data-mini'=>'true','id'=>'serie'))}}
			</div>
			{{ Form::hidden('id',$equipo->id)}}
			<div data-role="controlgroup" data-type="horizontal" align="center">
				{{Form::submit('Modificar')}}				
			</div>			
		{{ Form::close()}}	
@stop
{{--Scripts--}}
@section('scripts')
		<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposEquipoMod.js');}}	
@stop