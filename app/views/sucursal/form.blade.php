@extends('layout.base')
@include('includes.styles')
<?php
	if (isset($sucursal)):		
		$accion = "Editar";
		$form = array('url'=>'sucursal/editar');
	else:		
		$accion = "Ingresar";
		$form = array('url'=>'sucursal/ingresar');
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

@section('header')
	@if($status == "ver")
		<h1>Información sucursal</h1>
	@else
		<h1> {{ $accion }} sucursal</h1>
	@endif
	{{ HTML::link('sucursal','',array('class'=>'ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all')); }}
@stop

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
		))}}
		@endif
	</div>
	<div data-role="fieldcontain">		
		{{ Form::label('ciudad','Ciudad:') }}		
		@if(isset($sucursal))
			@if($status == "ver")
				{{Form::text('ciudad',$sucursal->ciudad,array('readonly'=>'true'))}}
			@else		
				{{ Form::text('ciudad', $sucursal->ciudad)}}
			@endif
		@else
			{{ Form::text('ciudad') }}
		@endif
	</div>

	<div data-role="fieldcontain">		
		{{ Form::label('direccion','Dirección:') }}		
		@if(isset($sucursal))
			@if($status == "ver")
				{{Form::textarea('direccion',$sucursal->direccion,array('readonly'=>'true'))}}		
			@else
				{{ Form::textarea('direccion', $sucursal->direccion) }}
			@endif
		@else
			{{ Form::textarea('direccion') }}
		@endif

	</div>

	<div data-role="fieldcontain">		
		{{ Form::label('telefono','Teléfono:') }}
		@if(isset($sucursal))
			@if($status == "ver")
				{{Form::text('telefono',$sucursal->telefono,array('readonly'=>'true'))}}
			@else		
				{{ Form::text('telefono',$sucursal->telefono) }}
			@endif					
		@else
			{{ Form::text('telefono') }}
		@endif
			
	</div>

	<div data-role="fieldcontain">		
		{{ Form::label('celular','Celular:') }}
		@if(isset($sucursal))
			@if($status == "ver")
				{{Form::text('celular',$sucursal->celular,array('readonly'=>'true'))}}
			@else		
				{{ Form::text('celular',$sucursal->celular) }}
			@endif		
		@else
			{{ Form::text('celular')}}
		@endif
	</div>

	<div data-role="fieldcontain">		
		{{ Form::label('email','Email:') }}
		@if(isset($sucursal))
			@if($status == "ver")
				{{Form::text('email',$sucursal->email,array('readonly'=>'true'))}}
			@else		
				{{ Form::email('email',$sucursal->email) }}
			@endif		
		@else
			{{ Form::email('email') }}
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


