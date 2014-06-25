@extends('layout.base')
{{--Sección título--}}
@if($estado)
	@section('titulo')
		<title>Detalle orden de trabajo</title>
	@stop
	{{--Sección head--}}
	@section('head')
	<!-- scripts -->
	@stop
	{{--Sección header--}}
	@section('header')		
		{{ HTML::link('tecnico','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
	@stop
	{{--Sección primario--}}
	@section('primario')
		@foreach($estado as $est)
			{{$est}}
		@endforeach
	@stop
@endif