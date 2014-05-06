@extends('layout.base')
@include('includes.styles')

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

{{--Sección header--}}
@section('header')
	<h1>Ingresar una orden de trabajo</h1>
	{{ HTML::link($accion,'',array('class'=>'ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all')); }}
@stop

{{--Sección primario--}}
@section('primario')
	<h3 align="center">Ingresar una nueva orden de trabajo</h3>
	{{Form::open(array('url'=>'ordenTrabajo/ingresar'))}}		
		<div data-role="fieldcontain">
			@if(isset($clientes))
			{{Form::label('cliente','Seleccione un cliente:')}}
			{{Form::select('cliente',$clientes,array('data-mini'=>'true','id'=>'cliente'))}}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{ Form::label('datosCliente','Información del cliente:')}}
			<div id="datosCliente" data-role="controlgroup" data-type="horizontal" align="center" >
				{{ Form::text('nombres','',array('placeholder'=>'Nombres','data-mini'=>'true','id'=>'nombres'))}}
				{{ Form::text('cedula','',array('placeholder'=>'Cédula','data-mini'=>'true','id'=>'cedula'))}}
				{{ Form::textarea('direccion','',array('placeholder'=>'Dirección','id'=>'direccion'))}}
				{{ Form::text('telefono','',array('placeholder'=>'Teléfono','data-mini'=>'true','id'=>'telefono'))}}
				{{ Form::text('celular','',array('placeholder'=>'Celular','data-mini'=>'true','id'=>'celular'))}}
				{{ Form::email('email','',array('placeholder'=>'Email','data-mini'=>'true','id'=>'email'))}}
				{{ Form::textarea('observaciones','',array('placeholder'=>'Observaciones','id'=>'observaciones'))}}
				{{ Form::hidden('id_cliente','0',array('id'=>'id_cliente'))}}
			</div> 			
		</div>
		<div data-role="fieldcontain">
			{{ Form::label('equipo','Información del equipo:')}}
			<div data-role="controlgroup" data-type="horizontal" align="center">
				{{ Form::text('tipo','',array('placeholder'=>'Tipo de equipo','data-mini'=>'true'))}}
				{{ Form::text('marca','',array('placeholder'=>'Marca','data-mini'=>'true'))}}
				{{ Form::text('modelo','',array('placeholder'=>'Modelo','data-mini'=>'true'))}}
				{{ Form::text('serie','',array('placeholder'=>'Número de serie','data-mini'=>true))}}
				{{ Form::textarea('problema','',array('placeholder'=>'Problema del equipo'))}}
				{{ Form::textarea('accesorios','',array('placeholder'=>'Accesorios del equipo'))}}
			</div>
		</div>
		<div data-role="fieldcontain">
			@if(isset($tecnicos))
			{{ Form::label('tecnico','Técnico asignado:')}}
			{{ Form::select('tecnico',$tecnicos,array('data-mini'=>'true'))}}
			@endif
		</div>
		{{--<div data-role="fieldcontain">
			{{ Form::label('fechaPrometido','Fecha y hora de prometido')}}			
			{{ Form::datetime('fechaPrometido',array('placeholder'=>'Fecha de prmometido','data-mini'=>'true'))}}
			{{ Form::text('horaPrometido',array('placeholder'=>'Hora de prometido','data-mini'=>'true'))}}
		</div>--}}
		<div data-role= "controlgroup" data-type="horizontal" align="center">
			{{ Form::submit('Ingresar')}}
			{{ Form::button('Cancelar',array('url'=>'#'))}}
		</div>		
		{{ Form::hidden('user_id',Auth::user()->id)}}
		
	{{Form::close()}}
@stop

{{--Sección secundario--}}
@section('secundario')
@stop

<script type="text/javascript">
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
