@extends('layout.base')
<?php
	if (Auth::user()->rol == "tecnico"):		
		$accion = "tecnico";
	else:		
		$accion = "vendedor";		
	endif;	
?>
{{--Sección título--}}
@section('titulo')	
	<title>Ingresar orden de trabajo</title>
@stop
{{--Sección head--}}
@section('head')
	{{HTML::style('js/validadores/ui/jquery-ui.css');}}	
@stop
{{--Sección header--}}
@section('header')	
	{{ HTML::link($accion,'',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
@stop
{{--Sección principal--}}
@section('principal')
	<h1 align="center">Ingresar una nueva orden de trabajo</h1>
	<span style="color: red;">* Elementos requeridos</span><br>	
	{{--Formulario de ingreso de orden de trabajo--}}
	{{Form::open(array('url'=>'ordenTrabajo/ingresar','id'=>'formIngresarOrden'))}}
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
			{{Form::label('fechaIngreso','Fecha de ingreso:')}}
			{{Form::text('fechaIngreso',date("d/m/Y"),array('readonly'=>'true','id'=>'fechaIngreso'))}}
		</div>
		{{--Usuario que recepta el equipo--}}		
		<div data-role="fieldcontain">
			{{Form::label('usuario','Integrante que recepta el equipo:')}}
			{{Form::text('usuario',Auth::user()->nombres,array('data-mini'=>'true','readonly'=>'true'))}}
		</div><br/>
		{{--Selección del cliente--}}		
		<h2>Información del cliente</h2>
		<div data-role= "controlgroup" data-type="horizontal">
			{{HTML::link('#ingresoCliente','Buscar cliente',array('class'=>'btnBuscar ui-btn'))}}
			
		</div>
		{{--Datos del cliente--}}		
		<div id="datosCliente">
			<div data-role="fieldcontain">
				{{ Form::label('nombres','* Nombres:')}}	
				{{ Form::text('nombres','',array('data-mini'=>'true','id'=>'nombres'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('cedula','* Cédula:')}}	
				{{ Form::text('cedula','',array('data-mini'=>'true','id'=>'cedula','maxlength'=>'10'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('direccion','* Dirección:')}}	
				{{ Form::textarea('direccion','',array('id'=>'direccion'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('telefono','Teléfono:')}}	
				{{ Form::text('telefono','',array('data-mini'=>'true','id'=>'telefono','maxlength'=>'7'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('celular','Celular:')}}	
				{{ Form::text('celular','',array('data-mini'=>'true','id'=>'celular','maxlength'=>'10'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('email','Email:')}}	
				{{ Form::textarea('email','',array('id'=>'email'))}}
			</div>
			<div data-role="fieldcontain">
				{{ Form::label('observaciones','Observaciones:')}}	
				{{ Form::textarea('observaciones','',array('id'=>'observaciones'))}}
			</div>
			{{ Form::hidden('id_cliente','0',array('id'=>'id_cliente'))}}
		</div><br/>
		{{--Datos del equipo--}}
		<h2>Información del equipo</h2>
		<div data-role="fieldcontain">
			{{ Form::label('tipo','* Tipo de equipo:')}}	
			{{ Form::text('tipo','',array('data-mini'=>'true','id'=>'tipo'))}}
		</div>
		<div data-role="fieldcontain">
			{{ Form::label('marca','* Marca:')}}	
			{{ Form::text('marca','',array('data-mini'=>'true','id'=>'marca'))}}
		</div>
		<div data-role="fieldcontain">
			{{ Form::label('modelo','* Modelo:')}}	
			{{ Form::text('modelo','',array('data-mini'=>'true','id'=>'modelo'))}}
		</div>
		<div data-role="fieldcontain">
			{{ Form::label('serie','* Número de serie:')}}	
			{{ Form::text('serie','',array('data-mini'=>'true','id'=>'serie'))}}
		</div><br/>
		{{--Detalles de la orden de trabajo--}}
		<h2>Detalles de la orden de trabajo</h2>
		<div data-role="fieldcontain">
			{{ Form::label('problema','* Problema del equipo:')}}	
			{{ Form::textarea('problema','',array('id'=>'problema'))}}<br/>
		</div>
		<div data-role="fieldcontain">
			{{ Form::label('accesorios','Accesorios:')}}	
			{{ Form::textarea('accesorios','',array('id'=>'accesorios'))}}<br/>
		</div>		
		{{--Técnico asignado a la reparación--}}
		<div data-role="fieldcontain">
			@if(isset($tecnicos))
			{{ Form::label('tecnico','Técnico asignado:')}}
			{{ Form::select('tecnico',$tecnicos,array('id'=>'tecnico'))}}
			@endif
		</div>
		{{--Fecha de prometido--}}
		<div data-role="fieldcontain">
			{{Form::label('fechaPrometido', '* Fecha de prometido:')}}
			{{Form::text('fechaPrometido','',array('id'=>'datepicker'))}}
		</div>
		{{--Botones de ingreso--}}
		<div data-role= "controlgroup" data-type="horizontal" align="center" data-mini="true">
			{{ Form::submit('Ingresar')}}
		</div>		
		{{ Form::hidden('user_id',Auth::user()->id)}}
	{{Form::close()}}
@stop
{{--Sección paneles--}}
@section('paneles')
	<div data-role="panel" id="ingresoCliente" data-display="overlay">
		<h2 align="center">Buscar cliente</h2>
		@if($todosClientes)
		{{Form::open()}}
			<input id="buscarCliente" data-type="search" placeholder="Buscar equipo">
		{{Form::close()}}
		{{Form::open(array('id'=>'formBuscar'))}}
			<table data-role="table" data-mode="reflow" data-filter="true" data-input="#buscarCliente" class="movie-list ui-responsive">
				<thead>
					<tr>
						<th>OK</th>
						<th>Cliente</th>
						<th>CI</th>
					</tr>
				</thead>
				<tbody>
					@foreach($todosClientes as $cliente)
					<tr>
						<td>{{ Form::radio('idCli',$cliente->id,array('id'=>'idCli'))}}</td>
						<td>{{$cliente->nombres}}</td>
						<td>{{$cliente->cedula}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{Form::button('Buscar',array('id'=>'enviar'))}}
		{{Form::close()}}
		@endif
	</div>
@stop
@section('scripts')
<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposIngresoOrden.js');}}
	{{HTML::script('js/validadores/cargarCliente.js');}}
	{{HTML::script('js/validadores/ui/jquery-ui.js');}}
		<script>
		  $(function() {
		    $( "#datepicker" ).datepicker();
		  });
		</script>

@stop


