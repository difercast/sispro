@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Presupuestos</title>
@stop
{{--Sección head--}}
@section('head')
	{{ HTML::style('css/mensajes.css'); }}	
@stop
{{--Sección header--}}
@section('header')
	@if(Auth::user()->rol == 'administrador')
		{{ HTML::link('admin','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@endif
@stop
{{--Sección primario--}}
@section('primario')
	<h2>Presupuestos</h2>
	{{--Mensajes de Errores --}}
	<?php $status=Session::get('status') ?>
	@if($status == 'error')
		<div id="error" align="center">
			<p>!Error!, por favor verifica la información </p>
		</div>
	@elseif($status == 'okCreado')
		<div id="mensajeCrear" align="center">
			<p>Información almacenada con éxito</p>
		</div>
	@elseif($status == 'okEditado')
		<div id="mensajeEditar" align="center">
			<p>La información se editó con éxito</p>			
		</div>
	@elseif($status == 'okInactivo') 
		<div id="mensajeEstado" align="center">
			<p>Se inactivó la sucursal correctamente</p>
		</div>
	@elseif($status == 'okActivo') 
		<div id="mensajeEstado" align="center">
			<p>Se activó la sucursal correctamente</p>
		</div>
	@endif
	<div data-role="controlgroup" data-type="horizontal">
		{{HTML::link('presupuesto/nuevo','Nuevo',array('data-role'=>'button'))}}
	</div>
	<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" align="center" >
		<thead>
			<tr>
				<th>Número</th>
				<th>Detalle</th>
				<th>Valor</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($presupuesto as $presup)
				<tr>
					<td>{{$presup->id}}</td>
					<td>{{$presup->detalle}}</td>
					<td>USD {{number_format($presup->valor,2)}}</td>
					<td>
						{{ HTML::link( 'presupuesto/modificar/'.$presup->id,'Editar', array('data-role'=>'button','data-mini'=>'true','data-inline'=>'true')) }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table><br/>	
	<p>NOTA: La moneda por defectos es el dólar de Estados Unidos y el valor del IVA está fijado en 12%.<br/>
		Los valores no incluyes el valor del IVA</p>
@stop
{{--Sección secundario--}}
@section('secundario')
@stop
{{--Sección scripts--}}
@section('scripts')
	{{ HTML::script('js/mensajes.js'); }}
@stop
