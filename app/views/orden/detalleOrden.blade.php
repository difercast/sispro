@extends('layout.base')
@include('includes.styles')

{{--Sección título--}}
@if($orden)
@section('titulo')
<title>Detalle orden de trabajo </title>
@stop

{{--Sección header--}}
@section('header')
	<h1>Orden de trabajo N° {{ $orden->id}}</h1>
	{{ HTML::link('tecnico','',array('class'=>'ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all')); }}
@stop

{{--Sección primario--}}
@section('primario')
	<div class="ui-grid-a">
	    <div class="ui-block-a"><div style="height:60px">
		   <strong>Fecha y hora de ingreso:</strong> {{ date("d M Y",strtotime($orden->created_at)) }} a las {{ date("g:ha",strtotime($orden->created_at)) }} 
	    </div></div>
	    <div class="ui-block-b"><div {{--class="ui-bar ui-bar-a"--}} style="height:60px">
	    	<strong>Ingresado por: </strong>{{ $user->nombres}}
	    </div></div>
	</div>		
	<p><strong>Detalles del cliente:</strong><br/>
		<strong>Nombres: </strong>{{ $cliente->nombres}}&nbsp;&nbsp; <strong>Cédula: </strong>{{ $cliente->cedula}}<br/>
		<strong>Dirección: </strong>{{ $cliente->direccion}}<br/>
		<strong>Teléfono: </strong>{{ $cliente->telefono}}&nbsp;&nbsp; <strong> Celular:</strong>{{$cliente->celular}}&nbsp;&nbsp; <strong> Email:</strong>{{ $cliente->email}}<br/><br/>			
	</p>
	<p><strong>Detalles del equipo:</strong><br/>
		<strong>Tipo: </strong>{{ $equipo->tipo }}<br/>
		<strong>Marca: </strong>{{ $equipo->marca }}<br/>
		<strong>Modelo: </strong>{{ $equipo->modelo}}<br/>
		<strong>Número de serie: </strong>{{ $equipo->serie}}<br/><br/>
	</p>
	<div class="ui-grid-a">
	    <div class="ui-block-a"><div style="height:60px">
		    <strong>Problema:</strong><br/>
			{{ $orden->problema}}<br/><br/>			
	    </div></div>
	    <div class="ui-block-b"><div {{--class="ui-bar ui-bar-a"--}} style="height:60px">
	    	<strong>Accesorios:</strong><br/>
			{{ $orden->accesorios}}<br/><br/>			
	    </div></div>
	</div>
	<div class="ui-grid-a">
		<div class="ui-block-a"><div style="height:60px">
			<strong>Detalle de actividades:</strong>
			{{ $orden->detalle }}
	</div></div>
		<div class="ui-block-b"><div {{--class="ui-bar ui-bar-a"--}} style="height:60px">
	    	<strong>Informe al cliente:</strong><br/>
			{{ $orden->informe}}<br/><br/>			
	    </div></div>
	</div>
	<div class="ui-grid-a">
		<div class="ui-block-a"><div style="height:60px">
			<strong>Estado de reparación del equipo:</strong>
			@if($orden->estado == '0')				
				Sin revisar
			@elseif($orden->estado == '1')
				En revisión
			@elseif($orden->estado == '2')
				Reparación terminada
			@endif
	</div></div>
		<div class="ui-block-b"><div {{--class="ui-bar ui-bar-a"--}} style="height:60px">
	    	<strong>Informe al cliente:</strong><br/>
			{{ $orden->informe}}<br/><br/>			
	    </div></div>
	</div>		
@stop
@endif
