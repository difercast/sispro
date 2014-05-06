@extends('layout.base')
@include('includes.styles')

{{--Sección título--}}
@section('titulo')
	<title>Equipos</title>
@stop

{{--Sección header--}}
@section('header')
	<h1>Modificar Equipos</h1>
	{{ HTML::link('equipo','',array('class'=>'ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all')); }}
@stop

{{--Sección primario--}}
@section('primario')
		<h4 align="center">Modificar información del equipo</h4>
		{{ Form::open(array('url'=>'equipo/editar'))}}
			<div data-role="fieldcontain">
				{{ Form::label('tipo','Tipo de equipo:')}}
				{{ Form::text('tipo',$equipo->tipo,array('data-mini'=>'true'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('marca','Marca:')}}
				{{ Form::text('marca',$equipo->marca,array('data-mini'=>'true'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('modelo','Modelo:')}}
				{{ Form::text('modelo',$equipo->modelo,array('data-mini'=>'true'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('serie','Número de serie:')}}
				{{ Form::text('serie',$equipo->serie,array('data-mini'=>'true'))}}
			</div>
			{{ Form::hidden('id',$equipo->id)}}
			<div data-role="controlgroup" data-type="horizontal" align="center">
				{{Form::submit('Modificar')}}
				
			</div>			
		{{ Form::close()}}	
@stop
