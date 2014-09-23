@extends('layout.base')
<?php
	if(isset($presupuesto)):
		$accion = "Editar";
		$form = array('url'=>'presupuesto/editar','id'=>'formPresupuesto');
	else:
		$accion = "Nuevo";
		$form = array('url'=>'presupuesto/ingresar','id'=>'formPresupuesto');
	endif;
?>
{{--Sección título--}}
@section('titulo')
	<title>{{$accion }} presupuesto</title>
	@show
@stop
{{--Sección head--}}
@section('head')
	
@stop
{{--Sección Header--}}
@section('header')
	{{ HTML::link('presupuesto','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Sección principal--}}
@section('principal')
	<h1 align="center">{{$accion }} presupuesto</h1>
	@if($accion == 'Editar')
		<h3>Por favor, ingrese los nuevos datos del presupuesto</h3>
		<span style="color:red">* Campos obligatorios</span>
	@else
		<h3>Por favor, ingrese los datos del nuevo presupuesto</h3>
		<span style="color:red">* Campos obligatorios</span>
	@endif
	<br/>
	{{--Formulario--}}
	{{Form::open($form)}}
	<div data-role="fieldcontain">
		{{Form::label('detalle','* Detalle:')}}
		@if(isset($presupuesto))
			{{Form::textArea('detalle',$presupuesto->detalle,array('id'=>'detalle','class'=>'required'))}}
		@else
			{{Form::textArea('detalle','',array('id'=>'detalle','class'=>'required'))}}
		@endif
	</div>
	<div data-role="fieldcontain">
		{{Form::label('valor','* Valor:')}}
		@if(isset($presupuesto))
			{{Form::text('valor',number_format($presupuesto->valor,2),array('id'=>'valor','class'=>'required'))}}
			{{Form::hidden('id',$presupuesto->id)}}
		@else
			{{Form::text('valor','',array('id'=>'valor','class'=>'required'))}}
		@endif
	</div> <br/>
	<div data-role="controlgroup" data-type="horizontal" align="center">
		{{Form::submit('Guardar')}}
		{{HTML::link('presupuesto','Regresar',array('data-role'=>'button'))}}
	</div>
@stop
@section('scripts')
	<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.min.js');}}
	{{HTML::script('js/validadores/camposPresupuesto.js')}}
@stop