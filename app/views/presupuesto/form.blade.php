@extends('layout.base')
<?php
	if(isset($presupuesto)):
		$accion = "Editar";
		$form = array('url'=>'presupuesto/editar','id'=>'formPresupuesto');
	else:
		$accion = "Ingresar";
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
	<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	<!-- Validación js de datos -->
	<script type="text/javascript">
	$(document).ready(function(){
		$('#formPresupuesto').validate({
			rules: {
				detalle:{required: true},
				valor:{required: true, number: true}
			},
			messages: {
				detalle:{required: "Campos requeridos"},
				valor: {
					number: "El campo debe contener valores numéricos",
					required: "Campos requeridos"
				}
			}
		});
	});
	</script>
@stop
{{--Sección Header--}}
@section('header')
	{{ HTML::link('presupuesto','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Sección Primario--}}
@section('primario')
	@if($accion == 'Editar')
		<h3>Por favor, ingrese los nuevos datos del presupuesto</h3>
	@else
		<h3>Por favor, ingrese los datos del nuevo presupuesto</h3>
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
			{{Form::text('valor',$presupuesto->valor,array('id'=>'valor','class'=>'required'))}}
			{{Form::hidden('id',$presupuesto->id)}}
		@else
			{{Form::text('valor','',array('id'=>'valor','class'=>'required'))}}
		@endif
	</div> <br/>
	<div data-role="controlgroup" data-type="horizontal" align="center">
		{{Form::submit('Guardar')}}
		{{HTML::link('presupuesto','Cancelar',array('data-role'=>'button'))}}
	</div>
@stop