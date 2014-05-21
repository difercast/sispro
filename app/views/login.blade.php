@extends('layout.base')
@include('includes.styles')
{{--Título--}}
@section('titulo')
    <title>Sistema de gestion de reparaciones de la empresa Sisprocompu</title>
@show
{{--Header--}}
@section('header')
	<h1>Sistema de gestion de reparaciones de equipos informáticos</h1>
@stop
{{--Sección primario--}}
@section('primario')
	<h3 align="center">Ingreso usuarios</h3>    
    {{ Form::open(array('url'=>'log')) }}
        @if(Session::has('login_errors'))
            <p style="color: #FB1D1D" align="center"> El nombre de usuario o contraseña no son correctos </p>
            @else 
            <p align="center">Por favor ingrese sus credenciales de acceso para ingresar al sistema</p>
        @endif
    	<div data-role="fiedcontain" align="center"> 
			{{ Form::text('username',Input::old('username'), array('placeholder' => 'Usuario')) }}						
			{{ Form::password('password',  array('placeholder' => 'Contraseña')) }}
    	</div>
    	<div data-role="controlgroup" data-type="horizontal" align="center">    		
    		{{ Form::submit('Ingresar')}}
        </div>
    {{Form::close()}}
@stop

