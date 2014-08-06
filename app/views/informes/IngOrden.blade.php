@extends('layout.base')
{{--Título--}}
 @section('titulo')
 	<title>informes estadísticos</title>
 @stop
 {{--Head--}}
 @section('head')
 @stop
 {{--Header--}}
 @section('header')
 	{{ HTML::link('informe','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
 @stop
 {{--principal--}}
 @section('principal')
 	<h2>Ordenes de trabajo ingresadas a la empresa</h2>
 	@if($ordenes)
 		@foreach($ordenes as $orden)
 			{{$orden->problema}}<br>
 		@endforeach
 	@endif
 	<br>
 	{{$ordenes->links()}}
 @stop