@extends('layout.base')
@include('includes.styles')

@section('titulo')
	<title>Editar empresa</title>
	@show
@stop
{{--Sección header--}}
@section('header')
	<h1>Editar empresa</h1>
	{{ HTML::link('empresa','',array('class'=>'ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all')); }}

@stop

{{--Sección primario--}}
@section('primario')
	
		<h3 align="center">Por favor, ingrese la nueva información de la empresa</h3>
		{{ Form::open(array('url'=>'empresa/editar')) }}
			<div data-role="fieldcontain">
				{{ Form::label('ruc','RUC:') }}
				{{ Form::text('ruc',$empresa->ruc) }}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('razonSocial','Razón Social:') }}
				{{ Form::text('razon_social',$empresa->razon_social) }}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('razonComercial', 'Razón Comercial:')}}
				{{ Form::text('razon_comercial',$empresa->razon_comercial)}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('actividad','Actividad:')}}
				{{ Form::text('actividad',$empresa->actividad)}}
			</div>		
			{{ Form::hidden('id',$empresa->id)}}
			<div data-role="controlgroup" data-type="horizontal" align="center">
				{{ Form::submit('Editar')}}
			</div>
		{{ Form::close() }}		
@stop



