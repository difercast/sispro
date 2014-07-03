@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Editar empresa</title>
	@show
@stop
{{--Sección head--}}
@section('head')
		
@stop
{{--Sección header--}}
@section('header')
	{{ HTML::link('empresa','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Sección primario--}}
@section('principal')		
	<h1 align="center">Modificar datos de la empresa</h1>
	<p><strong>Por favor, ingrese la nueva información de la empresa</strong></p>
	<span style="color: red;">* elementos requeridos</span>
	{{ Form::open(array('url'=>'empresa/editar','id'=>'formEditar')) }}
		<div class="ui-field-contain">
			{{Form::label('ruc','* RUC:')}}
			{{ Form::text('ruc',$empresa->ruc,array('id'=>'ruc','maxlength'=>'13')) }}
		</div>
		<div data-role="fieldcontain">
			{{ Form::label('razonSocial','* Razón Social:') }}
			{{ Form::text('razon_social',$empresa->razon_social,array('id'=>'razon_social')) }}
		</div>
		<div data-role="fieldcontain">
			{{ Form::label('razonComercial', '* Razón Comercial:')}}
			{{ Form::text('razon_comercial',$empresa->razon_comercial,array('id'=>'razon_comercial'))}}
		</div>
		<div data-role="fieldcontain">
			{{ Form::label('actividad','* Actividad:')}}
			{{ Form::text('actividad',$empresa->actividad,array('id'=>'actividad','maxlength'=>'3'))}}
		</div>		
		{{ Form::hidden('id',$empresa->id)}}
		<div data-role="controlgroup" data-type="horizontal" align="center">
			{{ Form::submit('Editar')}}
		</div>
	{{ Form::close() }}
@stop
{{--Sección Scripts--}}
@section('scripts')
	<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposEmpresa.js');}}
@stop






