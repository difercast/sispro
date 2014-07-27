@extends('layout.base')

{{--Título--}}
@section('titulo')
    <title>Sistema de gestion de reparaciones de la empresa Sisprocompu</title>
@show
{{--Header--}}
@section('header')

@stop
{{--Sección primario--}}
@section('primario') 
    <div class="log">
        <h1 align="center">Ingreso usuarios</h3>    
        {{ Form::open(array('url'=>'log')) }}            
            <div class="avatar" align="center"><img src="images/avatar.png"></div>            
            @if(Session::has('login_errors'))
                <p style="color: #FB1D1D" align="center"> El nombre de usuario o contraseña no son correctos </p>
            @else
                <p style="color: #FB1D1D" align="center"> Error al ingresar, por favor contáctese con el administrador del sistema </p>
            @endif
            {{ Form::text('username',Input::old('username'),array('data-mini'=>'true','placeholder'=>'Usuario')) }}
            {{ Form::password('password',array('data-mini'=>'true','placeholder'=>'Contraseña')) }}
            <div data-role="controlgroup" data-type="horizontal" align="center">            
                    {{ Form::submit('Ingresar')}}
            </div>
        {{Form::close()}}
    </div>   	
@stop
@section('secundario')
    <br/><br/><br/><br/>
    <ul data-role="listview" class="ui-listview-outer" data-inset="true">
        <li data-role="list-divider">Opciones de ingreso</li>
        <li class="fondo">Ingreso usuarios</li>
        <li>{{ HTML::link('logCliente', 'Ingreso clientes'); }}</li>              
    </ul>
@stop

