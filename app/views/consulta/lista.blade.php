@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>lista de órdenes de trabajo activas</title>
@stop
{{--Sección head--}}
@section('head')
		
@stop
{{--Sección header--}}
@section('header')	
	{{ HTML::link('/','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
@stop
{{--Sección principal--}}
@section('principal')
	@if($ordenes)
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">
			<li data-role="list-divider">Ordenes de trabajo</li>
			@foreach($ordenes as $orden)
				<li data-icon="false">{{HTML::link('consultaOrden/'.$orden->id, $orden->id)}} </li>
			@endforeach			
		</ul>
	@endif
@stop
@section('scripts')
<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposClienteMod.js');}}
@stop