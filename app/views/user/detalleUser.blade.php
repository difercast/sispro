@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title> Detalles de usuario</title>
@stop
{{--Sección head--}}
@section('head')
@stop
{{--Sección header--}}
@section('header')	
	{{ HTML::link('user','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Sección principal--}}
@section('principal')
	@if($user)
	<h2 align="center">Información del usuario</h2><br/>
	{{ Form::open()}}
		<div data-role="fieldcontain">
			{{Form::label('apellidos','Apellidos:')}}		
			{{ Form::text('apellidos', $user->apellidos,array('readonly'=>'true'))}}
		</div>
		<div data-role="fieldcontain">
			{{Form::label('nombres','Nombres:')}}
			{{ Form::text('nombres', $user->nombres,array('readonly'=>'true'))}}
		</div>
		<div data-role="fieldcontain">
			{{Form::label('cedula','N° de Cédula:')}}		
			{{ Form::text('cedula', $user->cedula,array('readonly'=>'true'))}}
		</div>
		<div data-role="fieldcontain">
			{{Form::label('direccion','Dirección:')}}		
			{{ Form::textarea('direccion', $user->direccion,array('readonly'=>'true'))}}
		</div>
		<div data-role="fieldcontain">
			{{Form::label('telefono','Teléfono:')}}		
			{{ Form::text('telefono', $user->telefono,array('readonly'=>'true'))}}
		</div>
		<div data-role="fieldcontain">
			{{Form::label('celular','Teléfono celular:')}}	
			{{ Form::text('celular', $user->celular,array('readonly'=>'true'))}}
		</div>
		<div data-role="fieldcontain">
			{{Form::label('email','Email:')}}		
			{{ Form::email('email', $user->email,array('readonly'=>'true'))}}
		</div>
		{{--sucursal--}}
		<div data-role="fieldcontain">
			{{Form::label('sucursal','Sucursal')}}
			{{ Form::email('email', $sucursal->nombre,array('readonly'=>'true'))}}					
		</div>
		{{--Nombre de usuario--}}
		<div data-role="fieldcontain">
			{{Form::label('username','Nombre de usuario:')}}	
			{{ Form::text('username', $user->username,array('readonly'=>'true'))}}	
		</div>
		{{--Rol--}}
		<div data-role="fieldcontain">
			{{Form::label('rol','Rol:')}}	
			@if($user->rol == 'administrador')
				{{ Form::text('rol', 'Administrador',array('readonly'=>'true'))}}
			@elseif($user->rol == 'tecnico')
				{{ Form::text('rol', 'Técnico',array('readonly'=>'true'))}}
			@elseif($user->rol == 'vendedor')
				{{ Form::text('rol', 'Vendedor',array('readonly'=>'true'))}}
			@endif		
		</div>
		{{--Regresar--}}
		<div data-role="controlgroup" data-type="horizontal" align="center">
			{{HTML::link('user','Regresar',array('data-role'=>'button'))}}
		</div>
	{{Form::close()}}
	@endif

@stop
