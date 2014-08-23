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
	@if($user)
		<h2 align="center">Cambiar contraseña de: {{$user->nombres}} {{$user->apellidos}}</h2>
		<h3>Por favor, ingrese la nueva contraseña.</h3>
		<span style="color: red;">* elementos requeridos</span>
		<br><br>
		{{ Form::open(array('url'=>'user/cambiar','id'=>'formCambiarPass'))}}
			<div data-role="fieldcontain">
				{{Form::label('password','* Contraseña:')}}
				{{ Form::password('password','',array('id'=>'password','class'=>'required')) }}
			</div>
			<div data-role="fieldcontain">
				{{Form::label('password2','* Repita la contraseña:')}}
				{{ Form::password('password2','',array('id'=>'password2','class'=>'required')) }}
			</div>
			{{Form::hidden('user',$user->id)}}
			<div data-role="controlgroup" data-type="horizontal" align="center">			
				{{ Form::submit('Guardar')}}						
			</div>
		{{Form::close()}}
	@endif
@stop
@section('scripts')
	<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposModUser.js');}}
@stop
