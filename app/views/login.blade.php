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
        <h3 align="center">Ingreso usuarios</h3>    
        {{ Form::open(array('url'=>'log')) }}
            @if(Session::has('login_errors'))
                <p style="color: #FB1D1D" align="center"> El nombre de usuario o contraseña no son correctos </p>
                @else 
                <p align="center">Por favor ingrese sus credenciales de acceso para ingresar al sistema</p>
            @endif
            <div id="contenedor">
                <div data-role="fieldcontain">
                    {{Form::label('user','Nombre de usuario:')}}
                    {{ Form::text('username',Input::old('username'),array('data-mini'=>'true')) }}                      
                </div>
                <div data-role="fieldcontain">
                    {{Form::label('pass','Contraseña:')}}
                    {{ Form::password('password',array('data-mini'=>'true')) }}
                </div>
                <div data-role="controlgroup" data-type="horizontal" align="center">            
                    {{ Form::submit('Ingresar')}}
                </div>
                </div>
            
        {{Form::close()}}
    </div>   	
@stop
@section('secundario')
    <br/><br/><br/><br/>
    <ul data-role="listview" class="ui-listview-outer" data-inset="true">
        <li data-role="list-divider">Opciones de ingreso</li>
        <li>Ingreso usuarios</li>
        <li>{{ HTML::link('#', 'Ingreso clientes'); }}</li>              
    </ul>
@stop

