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
        {{ Form::open(array('url'=>'listaOrdenes', 'method'=>'GET')) }}            
            <div class="avatar" align="center"><img src="images/avatar.png"></div>            
            {{Form::text('cedula','',array('data-mini'=>'true','placeholder'=>'Número de cédula'))}}            
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
        <li class="fondo">{{ HTML::link('logCliente', 'Ingreso clientes'); }}</li>
        <li class="fondo"></li>              
    </ul>
@stop