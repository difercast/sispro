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
		{{Form::open(array('url'=>'ordenTrabajo/administrar'))}}

			{{Form::label('detalle','Detalle del trabajo realizado')}}
			{{Form::textarea('detalle',$orden->detalle, array('data-mini'=>'true'))}}

			{{Form::label('informe','Informe de reparación')}}
			{{Form::textarea('detalle',$orden->detalle, array('data-mini'=>'true'))}}
					
			{{--Errores al presentar radio buttons con sintaxis de laravel, por eso escribimos con sitaxis html--}}
			@if($orden->estado == '0')
				<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
				    <legend>Estado de la reparación:</legend>
				        <input type="radio" name="estado" id="0" value="0" checked="checked">
				        <label for="0">No revisado</label>
				        <input type="radio" name="estado" id="1" value="1">
				        <label for="1">En reparación</label>
				        <input type="radio" name="estado" id="2" value="2">
				        <label for="2">Reparación terminada</label>
				</fieldset>
			@elseif($orden->estado == '1')
				<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
				    <legend>Estado de la reparación:</legend>
				        <input type="radio"  id="0" value="0" >
				        <label for="0">No revisado</label>
				        <input type="radio" name="estado" id="1" value="1" checked="checked">
				        <label for="1">En reparación</label>
				        <input type="radio" name="estado" id="2" value="2">
				        <label for="2">Reparación terminada</label>
				</fieldset>
			@elseif($orden->estado == '2')
				<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
				    <legend>Estado de la reparación:</legend>
				        <input type="radio" id="0" value="0" >
				        <label for="0">No revisado</label>
				        <input type="radio" id="1" value="1" >
				        <label for="1">En reparación</label>
				        <input type="radio" name="estado" id="2" value="2" checked="checked">
				        <label for="2">Reparación terminada</label>
				</fieldset>
			@endif
			
		<div data-role="controlgroup" align="center" data-type="horizontal">
				{{Form::submit('Guardar')}}
			</div>
		{{Form::close()}}
	@stop
@endif
