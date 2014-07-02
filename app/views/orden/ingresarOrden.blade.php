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
		<div data-role="fieldcontain">
			@if(isset($clientes))
			{{Form::label('cliente','Seleccione un cliente:')}}
			{{Form::select('cliente',$clientes,array('data-mini'=>'true','id'=>'cliente'))}}
			@endif
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
			{{ Form::select('tecnico',$tecnicos,array('data-mini'=>'true','id'=>'tecnico'))}}
			@endif
		</div>
		{{--Fecha de prometido--}}
		<div data-role="fieldcontain">
			{{Form::label('fechaPrometido', '* Fecha de prometido:')}}
			<input type="date" id="fechaPrometido" name="fechaPrometido"/>
		</div>
		{{--Botones de ingreso--}}
		<div data-role= "controlgroup" data-type="horizontal" align="center" data-mini="true">
			{{ Form::submit('Ingresar')}}
			
		</div>		
		{{ Form::hidden('user_id',Auth::user()->id)}}
	{{Form::close()}}
@stop
{{--Sección secundario--}}
@section('secundario')	
@stop
{{--Sección scripts--}}
@section('scripts')
	<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposIngresoOrden.js');}}
	<script type="text/javascript">
	//Carga los datos del cliente cuando el usuario seleccione uno
    $(document).ready(function(){
        $('#cliente').change(function(){
            $.ajax({
            	url:"procesaCliente",
            	type:"POST",
            	data:"idCliente="+$('#cliente').val(),
            	success: function(clientes){            		
            		$('#nombres').val(clientes[0]);
            		$('#cedula').val(clientes[1]);
            		$('#direccion').val(clientes[2]);
            		$('#telefono').val(clientes[3]); 
            		$('#celular').val(clientes[4]);
            		$('#email').val(clientes[5]);
            		$('#observaciones').val(clientes[6]);
            		$('#id_cliente').val(clientes[7]);           		
            		//$('#datosCliente').html(clientes);
            	}
            })

        });    
    });
	</script>
@stop

