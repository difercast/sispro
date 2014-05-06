@extends('layout.basePopup')
@include('includes.styles')



{{--Cuerpo del dialogo--}}
@section('primario')
	<div data-role="header">
		<h1>Buscar orden de trabajo</h1>		
	</div>
	<div data-role="content">
		<p>por favor, seleccione el cliente</p>
		{{Form::open(array('url'=>'ordenTrabajo/porcliente'))}}
			{{Form::select('cliente',$cliente)}}
			{{Form::submit('Buscar')}}			
		{{Form::close()}}
	</div>
@stop