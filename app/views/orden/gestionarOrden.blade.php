@extends('layout.base')
@include('includes.styles')
{{--Sección título--}}
@if($orden)
	@section('titulo')
		<title>Gestión orden de trabajo </title>
	@stop
	{{--Sección header--}}
	@section('header')
		<h1>Orden de trabajo N° {{ $orden->id}}</h1>
		{{ HTML::link('tecnico','',array('class'=>'ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all')) }}
	@stop
	{{--Sección primario--}}
	@section('primario')
		<h4>Gestión de orden de trabajo</h4>
		{{Form::open()}}
			{{ Form::label('color_panda', 'Los pandas son') }}
			{{ Form::radio('color_panda', 'rojos', true) }} Rojos
			{{ Form::radio('color_panda', 'negros') }} Negros
			{{ Form::radio('color_panda', 'blancos') }} Blancos		
		{{Form::close()}}
	@stop
@endif
