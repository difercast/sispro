@extends('layout.base')
<?php
	if (isset($user)):		
		$accion = "Editar";
		$form = array('url'=>'user/editar','id'=>'formUser');
	else:		
		$accion = "Nuevo";
		$form = array('url'=>'user/ingresar','id'=>'formUser');
	endif;		
?>
{{--Sección título--}}
@section('titulo')
	<title> {{ $accion }} usuario</title>
@stop
{{--Sección head--}}
@section('head')
@stop
{{--Sección header--}}
@section('header')
	{{ HTML::link('user','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Sección principal--}}
@section('principal')
	<h1 align="center">{{$accion }} usuario</h1>
	<h3>Por favor, ingrese la información del usuario.</h3>
	<span style="color: red;">* elementos requeridos</span>
	<br><br>
	{{ Form::open($form)}}
		<div data-role="fieldcontain">
			{{Form::label('apellidos','* Apellidos:')}}
			@if(isset($user))		
			{{ Form::text('apellidos', $user->apellidos,array('id'=>'apellidos','class'=>'required'))}}
			@else
			{{ Form::text('apellidos','',array('id'=>'apellidos','class'=>'required')) }}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('nombres','* Nombres:')}}
			@if(isset($user))		
			{{ Form::text('nombres', $user->nombres,array('id'=>'nombres','class'=>'required'))}}
			@else
			{{ Form::text('nombres','',array('id'=>'nombres','class'=>'required')) }}
			@endif
		</div>
		<div data-role="fieldcontain">
			{{Form::label('cedula','* N° de Cédula:')}}
			@if(isset($user))		
				{{ Form::text('cedula', $user->cedula,array('id'=>'cedula','class'=>'required','maxlength'=>'10'))}}
			@else
				{{ Form::text('cedula','',array('id'=>'cedula','class'=>'required','maxlength'=>'10')) }}
			@endif
		</div>
		{{--Dirección--}}
		<div data-role="fieldcontain">
			{{Form::label('direccion','* Dirección:')}}
			@if(isset($user))		
			{{ Form::textarea('direccion', $user->direccion,array('id'=>'direccion','class'=>'required'))}}
			@else
			{{ Form::textarea('direccion','',array('id'=>'direccion','class'=>'required')) }}
			@endif
		</div>
		{{--Teléfono--}}
		<div data-role="fieldcontain">
			{{Form::label('telefono','Teléfono:')}}
			@if(isset($user))		
			{{ Form::text('telefono', $user->telefono, array('maxlength'=>'7'))}}
			@else
			{{ Form::text('telefono','',array('maxlength'=>'7')) }}
			@endif
		</div>
		{{--celular--}}
		<div data-role="fieldcontain">
			{{Form::label('celular','Teléfono celular:')}}
			@if(isset($user))		
			{{ Form::text('celular', $user->celular,array('maxlength'=>'10'))}}
			@else
			{{ Form::text('celular','',array('maxlength'=>'10')) }}
			@endif
		</div>
		{{--email--}}
		<div data-role="fieldcontain">
			{{Form::label('email','* Email:')}}
			@if(isset($user))		
			{{ Form::email('email', $user->email,array('id'=>'email','class'=>'required'))}}
			@else
			{{ Form::email('email','',array('id'=>'email','class'=>'required')) }}
			@endif
		</div>
		{{--sucursal--}}
		<div data-role="fieldcontain">
			@if(isset($user))
				{{Form::label('sucursal','* Sucursal:')}}
				@if(isset($sucursal))					
					{{ Form::select('sucursal',$sucursal,array('id'=>'sucursal','class'=>'required'))}}			
				@endif
			@else
				{{Form::label('sucursal','Sucursal')}}
				{{ Form::select('sucursal',$sucursal,array('id'=>'sucursal','class'=>'required'))}}
			@endif					
		</div>
		{{--Nombre de usuario--}}
		<div data-role="fieldcontain">
			{{Form::label('username','* Nombre de usuario:')}}
			@if(isset($user))		
				{{ Form::text('username', $user->username,array('id'=>'username','class'=>'required'))}}
			@else
				{{ Form::text('username','',array('id'=>'username','class'=>'required')) }}
			@endif	
		</div>
		{{--Rol--}}
		<div data-role="fieldcontain">
			@if(isset($user))
				@if($user->rol == 'administrador')
					{{Form::hidden('rol','administrador')}}
				@else
					{{Form::label('rol','* Rol:')}}
					{{Form::text('rol',$user->rol,(array('readonly'=>true)))}}
		
				@endif	
			@else
				{{Form::label('rol','* Rol:')}}
				{{Form::select('rol',array(
					'tecnico'=>'Técnico',
					'vendedor'=>'Vendedor'
				))}}
			@endif			
		</div>
		<br/>		
		{{--contraseña--}}
		@if(isset($user))			
		@else
			<div data-role="fieldcontain">
			{{Form::label('password','* Contraseña:')}}
			{{ Form::password('password','',array('id'=>'password','class'=>'required')) }}
			</div>
		@endif
		{{--Confirmar contraseña--}}
		@if(isset($user))			
		@else
			<div data-role="fieldcontain">
			{{Form::label('password2','* Repita la contraseña:')}}
			{{ Form::password('password2','',array('id'=>'password2','class'=>'required')) }}
			</div>
		@endif

		@if(isset($user))
			{{Form::hidden('id',$user->id)}}		
		@endif					
		<div data-role="controlgroup" data-type="horizontal" align="center">			
			{{ Form::submit('Guardar')}}
			@if(isset($user))			
				{{HTMl::link('user/cambiar/'.$user->id,'Cambiar contraseña',array('data-role'=>'button'))}}				
			@endif			
				{{HTMl::link('user','Regresar',array('data-role'=>'button', 'data-mini'=>'true'))}}			
		</div>
	{{Form::close()}}
@stop
@section('scripts')
	<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposUser.js');}}
@stop

