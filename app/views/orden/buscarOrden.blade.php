@extends('layout.basePopup')
@include('includes.styles')



{{--Cuerpo del dialogo--}}
@section('primario')
	<div data-role="header">
		<h1>Buscar orden de trabajo</h1>		
	</div>
	<div data-role="content">
		<p>por favor, ingrese el número de orden de trabajo</p>
		{{Form::open(array('url'=>'ordenTrabajo/mostrar'))}}
			{{Form::text('NumOrden')}}
			{{Form::submit('Buscar')}}			
		{{Form::close()}}
	</div>
@stop
