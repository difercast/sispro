@extends('layout.base')
@include('includes.styles')

<?php
	if (isset($user)):		
		$accion = "Editar";
		$form = array('url'=>'user/editar');
	else:		
		$accion = "Ingresar";
		$form = array('url'=>'user/ingresar');
	endif;		
?>

{{--Título de la página--}}
@section('titulo')
	<title> {{ $accion }} usuario</title>
@stop

{{--Sección header--}}
@section('header')
	<h1> {{ $accion }} usuario</h1>
	{{ HTML::link('user','',array('class'=>'ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all')); }}
@stop
{{--Sección primario--}}
@section('primario')
	<h3 align="center">Por favor, ingrese la información del usuario</h3>
	{{ Form::open($form)}}
		<div data-role="fieldcontain">
			{{Form::label('apellidos','Apellidos:')}}
			@if(isset($user))		
			{{ Form::text('apellidos', $user->apellidos)}}
			@else
			{{ Form::text('apellidos') }}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('nombres','Nombres:')}}
			@if(isset($user))		
			{{ Form::text('nombres', $user->nombres)}}
			@else
			{{ Form::text('nombres') }}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('cedula','N° de Cédula:')}}
			@if(isset($user))		
			{{ Form::text('cedula', $user->cedula)}}
			@else
			{{ Form::text('cedula') }}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('direccion','Dirección:')}}
			@if(isset($user))		
			{{ Form::textarea('direccion', $user->direccion)}}
			@else
			{{ Form::textarea('direccion') }}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('telefono','Teléfono:')}}
			@if(isset($user))		
			{{ Form::text('telefono', $user->telefono)}}
			@else
			{{ Form::text('telefono') }}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('celular','Teléfono celular:')}}
			@if(isset($user))		
			{{ Form::text('celular', $user->celular)}}
			@else
			{{ Form::text('celular') }}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('email','Email:')}}
			@if(isset($user))		
			{{ Form::email('email', $user->email)}}
			@else
			{{ Form::email('email') }}
			@endif
		</div>
		{{--sucursal--}}
		<div data-role="fieldcontain">
			@if(isset($user))
				{{Form::label('sucursal','Sucursal')}}
				@if(isset($sucursal))
					{{ Form::select('sucursal',$sucursal)}}			
				@endif
			@else
				{{Form::label('sucursal','Sucursal')}}
				{{ Form::select('sucursal',$sucursal)}}
			@endif
					
		</div>
		{{--Nombre de usuario--}}
		<div data-role="fieldcontain">
			{{Form::label('username','Nombre de usuario:')}}
			@if(isset($user))		
			{{ Form::text('username', $user->username)}}
			@else
			{{ Form::text('username') }}
			@endif	
		</div>
		{{--Rol--}}
		<div data-role="fieldcontain">
			@if(isset($user))
				@if($user->rol == 'administrador')
					{{Form::hidden('rol','administrador')}}
				@else
				{{Form::label('rol','Rol:')}}
				{{Form::select('rol',array(
					'tecnico'=>'Técnico',
					'vendedor'=>'Vendedor'
				))}}			
				@endif	
			@else
				{{Form::label('rol','Rol:')}}
				{{Form::select('rol',array(
					'tecnico'=>'Técnico',
					'vendedor'=>'Vendedor'
				))}}
			@endif			
		</div>
		
		@if(isset($user))
		@else
			<div data-role="fieldcontain">
			{{Form::label('password','Contraseña:')}}
			{{ Form::password('password') }}
			</div>
		@endif

		@if(isset($user))
		@else
			<div data-role="fieldcontain">
			{{Form::label('password2','Repita la contraseña:')}}
			{{ Form::password('password2') }}
			</div>
		@endif

		@if(isset($user))
			{{Form::hidden('id',$user->id)}}		
		@endif
					
		<div data-role="controlgroup" data-type="horizontal" align="center">			
			{{ Form::submit('Guardar')}}			
		</div>
	{{Form::close()}}
@stop

