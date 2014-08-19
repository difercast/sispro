@extends('layout.base')
<?php
	if (isset($sucursal)):		
		$accion = "Editar";
		$form = array('url'=>'sucursal/editar','id'=>'formSucursal');
	else:		
		$accion = "Nueva";
		$form = array('url'=>'sucursal/ingresar','id'=>'formSucursal');
	endif;	
?>
@section('titulo')
	@if($status == "ver")
		<title>Información sucursal</title>
	@else
		<title> {{ $accion }} sucursal</title>
	@endif
	@show
@stop
{{--Sección head--}}
@section('head')	
@stop
{{--Sección header--}}
@section('header')	
	{{ HTML::link('sucursal','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Sección principal--}}
@section('principal')
	@if(isset($accion) && $status != 'ver')
		<h1 align="center">{{$accion }} sucursal</h1>
	@endif
	@if($status == "ver")
		<h2 align="center">Información de {{ $sucursal->nombre}}</h2><br>
	@else
		<h3>Por favor, ingrese la información de la sucursal.</h3>
		<span style="color: red;">* elementos requeridos</span>
		{{ Form::open($form) }}
	@endif
	<div data-role="fieldcontain">						
		@if($status == "ver")
			{{ Form::label('provincia','Provincia:')}}
			{{Form::text('provincia',$sucursal->provincia,array('readonly'=>'true'))}}
		@else
		{{ Form::label('provincia','* Provincia:')}}
		{{ Form::select('provincia',array(
			'Azuay' => 'Azuay',
			'Bolivar' => 'Bolivar',
			'Cañar' => 'Cañar',
			'carchi' => 'Carchi',
			'Chimborazo' => 'Chimborazo',
			'Cotopaxi' => 'Cotopaxi',
			'El Oro' => 'El Oro',
			'Esmeraldas' => 'Esmerldas',
			'Galápagos' => 'Galápagos',
			'Guayas' => 'Guayas',
			'Imbabura' => 'Imbabura',
			'Loja' => 'Loja',
			'Los Ríos' => 'Los Ríos',
			'Manabí' => 'Manabí',
			'Morona Santiago' => 'Morona Santiago',
			'Napo' => 'Napo',
			'Orellana' => 'Orellana',
			'Pastaza' => 'Pastaza',
			'Pichincha' => 'Pichincha',
			'Santa Elena' => 'Santa Elena',
			'Santo Domingo' => 'Santo Domingo de los Tsáchilas',
			'Sucumbíos' => 'Sucumbíos',
			'Tungurahua' => 'Tungurahua',
			'Zamora Chinchipe' => 'Zamora Chinchipe'),'Loja'			
		,array('id'=>'provincia','class'=>'required'))}}
		@endif
	</div>
	<div data-role="fieldcontain">						
		@if(isset($sucursal))			
			@if($status == "ver")
				{{ Form::label('ciudad','Ciudad:') }}
				{{Form::text('ciudad',$sucursal->ciudad,array('readonly'=>'true'))}}
			@else
				{{ Form::label('ciudad','* Ciudad:') }}		
				{{ Form::text('ciudad', $sucursal->ciudad,array('id'=>'ciudad','class'=>'required'))}}
			@endif
		@else
			{{ Form::label('ciudad','* Ciudad:') }}
			{{ Form::text('ciudad','',array('id'=>'ciudad','class'=>'required')) }}
		@endif
	</div>
	<div data-role="fieldcontain">						
		@if(isset($sucursal))
			@if($status == "ver")
				{{ Form::label('direccion','Dirección:') }}
				{{Form::textarea('direccion',$sucursal->direccion,array('readonly'=>'true'))}}		
			@else
				{{ Form::label('direccion','* Dirección:') }}
				{{ Form::textarea('direccion', $sucursal->direccion,array('id'=>'direccion','class'=>'required')) }}
			@endif
		@else
			{{ Form::label('direccion','* Dirección:') }}
			{{ Form::textarea('direccion','',array('id'=>'direccion','class'=>'required')) }}
		@endif
	</div>
	<div data-role="fieldcontain">				
		@if(isset($sucursal))
			@if($status == "ver")
				{{ Form::label('telefono','Teléfono:') }}
				{{Form::text('telefono',$sucursal->telefono,array('readonly'=>'true'))}}
			@else
				{{ Form::label('telefono','* Teléfono:') }}		
				{{ Form::text('telefono',$sucursal->telefono,array('id'=>'telefono','class'=>'required','maxlength'=>'7')) }}
			@endif					
		@else
			{{ Form::label('telefono','* Teléfono:') }}
			{{ Form::text('telefono','',array('id'=>'telefono','class'=>'required','maxlength'=>'7')) }}
		@endif	
	</div>
	<div data-role="fieldcontain">				
		@if(isset($sucursal))
			@if($status == "ver")
				{{ Form::label('celular','Celular:') }}
				{{Form::text('celular',$sucursal->celular,array('readonly'=>'true'))}}
			@else
				{{ Form::label('celular','* Celular:') }}		
				{{ Form::text('celular',$sucursal->celular,array('id'=>'celular','class'=>'required','maxlength'=>'10')) }}
			@endif		
		@else
			{{ Form::label('celular','* Celular:') }}
			{{ Form::text('celular','',array('id'=>'celular','class'=>'required','maxlength'=>'10'))}}
		@endif
	</div>
	<div data-role="fieldcontain">				
		@if(isset($sucursal))
			@if($status == "ver")
				{{ Form::label('email','Email:') }}
				{{Form::text('email',$sucursal->email,array('readonly'=>'true'))}}
			@else
				{{ Form::label('email','* Email:') }}		
				{{ Form::email('email',$sucursal->email,array('id'=>'email','class'=>'required')) }}
			@endif		
		@else
			{{ Form::label('email','* Email:') }}
			{{ Form::email('email','',array('id'=>'email','class'=>'required')) }}
		@endif		
	</div>
	@if($status != "ver")
		@if(isset($sucursal))
			{{ Form::hidden('id',$sucursal->id)}}
		@endif
		<div data-role="controlgroup" data-type="horizontal" align="center">
			{{ Form::submit('Guardar')}}
			{{HTML::link('sucursal','Regresar',array('data-role'=>'button'))}}
		</div>
	@else
		<div data-role="controlgroup" data-type="horizontal" align="center">
			{{ HTML::link('sucursal','Regresar',array('data-role'=>'button'))}}
		</div>
	@endif	
	{{ Form::close() }}
@stop
{{--Scripts--}}
@section('scripts')
	<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposSucursal.js');}}
@stop


