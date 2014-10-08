@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>¡Error 404!</title>
	@show
@stop
{{--Sección head--}}
@section('head')
	
@stop
@section('header')	
@stop
{{--Sección primario--}}
@section('principal')

	<h1 align="center">ERROR 404</h1>
	<div class="log">
		<img src="images/msjError.jpg">
	</div><br/><br/><br>
	<span style="font-family:arial; font-size:22px; width:100%; max-width:150px; ">Los sentimos, la página solicitada no se encuentra disponible. Por favor intenta más tarde o comunícate con el administrador de sistema.</span><br/><br/><br>
	<div data-role="controlgroup" data-type="horizontal" align="center">		
		{{ HTML::link('#','Regresar',array('data-role'=>'button','data-rel'=>'back'))}}
	</div>

	
@stop
{{--Sección secundario--}}
@section('secundario')

@stop
{{--Scripts--}}
@section('scripts')
	{{ HTML::script('js/mensajes.js'); }}
@stop
