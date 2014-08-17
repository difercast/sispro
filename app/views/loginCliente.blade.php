@extends('layout.base')
{{--Título--}}
@section('titulo')
	<title>Ingreso cliente</title>
@stop
{{--Head--}}
{{--Header--}}
@section('header')

@stop
{{--Primario--}}
@section('primario')
	<div class="log">
        <h1 align="center">Ingreso clientes</h3>    
        {{ Form::open(array('url'=>'listaOrdenes', 'method'=>'GET', 'id'=>'formLogCliente')) }}            
            <div class="avatar" align="center"><img src="images/avatar.png"></div>            
            {{Form::text('cedula','',array('data-mini'=>'true','placeholder'=>'Número de cédula','id'=>'cedula',
            'maxlength'=>'10'))}}            
            <div data-role="controlgroup" data-type="horizontal" align="center">            
                    {{ Form::submit('Ingresar')}}
            </div>
        {{Form::close()}}
    </div>
@stop
{{--Secundario--}}
@section('secundario')
	<br/><br/><br/><br/>
    <ul data-role="listview" class="ui-listview-outer" data-inset="true">
        <li data-role="list-divider">Opciones de ingreso</li>        
        <li class="fondo">{{HTML::link('/','Ingreso usuarios')}}</li>              
        <li class="fondo">Ingreso clientes</li>
    </ul>
@stop

@section('scripts')
    <!-- scripts -->
    {{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
    {{HTML::script('js/validadores/camposConsultaCliente.js');}}
@stop