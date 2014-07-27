@extends('layout.base')
{{--sucursal, empresa, orden, cliente, equipo, usuario, técnico--}}

{{--Principal--}}
@if(isset($empresa) && isset($sucursal) &&isset($orden) && isset($cliente) && isset($equipo) &&isset($usuario) &&isset($tecnico))
@section('principal')
	{{--Encabezado--}}
	<h2 align="center">{{$empresa->razon_comercial}}</h2>
	<span align="center">{{$sucursal->nombre}}</span><br>
	<span align="center">{{$sucursal->direccion}}</span><br>
	<span align="center">{{$sucursal->telefono}} - {{$sucursal->celular}}</span><br>
	
	{{--Datos de la orden de trabajo--}}
	<h3 align="center">Orden de trabajo Nro {{$orden->id}}</h3>
	<p><strong>Fecha y hora de ingreso: </strong>{{date("d M Y",strtotime($orden->created_at ))}} a las 
		{{date("G i",strtotime($orden->created_at ))}}</p>
	<p><strong>Integrante que recepta el equipo: </strong> {{$usuario->nombres}} {{$usuario->apellidos}}</p>
	<p><strong>Cliente: </strong> {{$cliente->nombres}}</p>
	<p><strong>Datos del equipo:</strong><br>
		<strong>Tipo:</strong> {{$equipo->tipo}}<br/>
		<strong>Marca:</strong> {{$equipo->marca}}<br/>
		<strong>Modelo:</strong> {{$equipo->modelo}}<br/>
		<strong>Número de serie:</strong> {{$equipo->serie}}<br/>
	</p>
	<p><strong>Problema del equipo:</strong><br/>
		{{$orden->problema}}
	</p>
	<p><strong>Accesorios</strong><br/>
		{{$orden->accesorios}}
	</p>
	<p><strong>Técnico asignado a la reparación: </strong> {{$tecnico->nombres}} {{$tecnico->apellidos}}</p>
	<p><strong>Fecha de prometido: </strong> {{$orden->fechaPrometido}}</p>
@stop
@endif