@extends('layout.base')
<?php
	if (isset($sucursal)):		
		$accion = "Editar";
		$form = array('url'=>'sucursal/editar','id'=>'formSucursal');
	else:		
		$accion = "Ingresar";
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
	<!-- scripts -->
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposSucursal.js');}}
@stop
{{--Sección header--}}
@section('header')	
	{{ HTML::link('sucursal','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Sección primario--}}
@section('primario')
	@if($status == "ver")
		<h3>Información detallada de {{ $sucursal->nombre}}</h3>
	@else
		<h3>Por favor, ingrese la información de la sucursal</h3>
		{{ Form::open($form) }}
	@endif
	<div data-role="fieldcontain">				
		{{ Form::label('provincia','Provincia:')}}
		@if($status == "ver")
			{{Form::text('provincia',$sucursal->provincia,array('readonly'=>'true'))}}
		@else
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
			'Zamora Chinchipe' => 'Zamora Chinchipe'
		,array('id'=>'provincia','class'=>'required')))}}
		@endif
	</div>
	<div data-role="fieldcontain">		
		{{ Form::label('ciudad','Ciudad:') }}		
		@if(isset($sucursal))
			@if($status == "ver")
				{{Form::text('ciudad',$sucursal->ciudad,array('readonly'=>'true'))}}
			@else		
				{{ Form::text('ciudad', $sucursal->ciudad,array('id'=>'ciudad','class'=>'required'))}}
			@endif
		@else
			{{ Form::text('ciudad','',array('id'=>'ciudad','class'=>'required')) }}
		@endif
	</div>
	<div data-role="fieldcontain">		
		{{ Form::label('direccion','Dirección:') }}		
		@if(isset($sucursal))
			@if($status == "ver")
				{{Form::textarea('direccion',$sucursal->direccion,array('readonly'=>'true'))}}		
			@else
				{{ Form::textarea('direccion', $sucursal->direccion,array('id'=>'direccion','class'=>'required')) }}
			@endif
		@else
			{{ Form::textarea('direccion','',array('id'=>'direccion','class'=>'required')) }}
		@endif
	</div>
	<div data-role="fieldcontain">		
		{{ Form::label('telefono','Teléfono:') }}
		@if(isset($sucursal))
			@if($status == "ver")
				{{Form::text('telefono',$sucursal->telefono,array('readonly'=>'true'))}}
			@else		
				{{ Form::text('telefono',$sucursal->telefono,array('id'=>'telefono','class'=>'required')) }}
			@endif					
		@else
			{{ Form::text('telefono','',array('id'=>'telefono','class'=>'required')) }}
		@endif	
	</div>
	<div data-role="fieldcontain">		
		{{ Form::label('celular','Celular:') }}
		@if(isset($sucursal))
			@if($status == "ver")
				{{Form::text('celular',$sucursal->celular,array('readonly'=>'true'))}}
			@else		
				{{ Form::text('celular',$sucursal->celular,array('id'=>'celular','class'=>'required')) }}
			@endif		
		@else
			{{ Form::text('celular','',array('id'=>'celular','class'=>'required'))}}
		@endif
	</div>
	<div data-role="fieldcontain">		
		{{ Form::label('email','Email:') }}
		@if(isset($sucursal))
			@if($status == "ver")
				{{Form::text('email',$sucursal->email,array('readonly'=>'true'))}}
			@else		
				{{ Form::email('email',$sucursal->email,array('id'=>'email','class'=>'required')) }}
			@endif		
		@else
			{{ Form::email('email','',array('id'=>'email','class'=>'required')) }}
		@endif		
	</div>
	@if($status != "ver")
		@if(isset($sucursal))
			{{ Form::hidden('id',$sucursal->id)}}
		@endif

		<div data-role="controlgroup" data-type="horizontal" align="center">
			{{ Form::submit('Guardar')}}
		</div>
	@endif	
	{{ Form::close() }}
@stop


