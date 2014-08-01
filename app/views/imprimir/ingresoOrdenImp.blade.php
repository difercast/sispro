<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
</head>
<body>
	<h2 align="center">{{$empresa->razon_comercial}}</h2>
	<p align="center">{{$sucursal->nombre}}<br>
		{{$sucursal->direccion}}<br>
		{{$sucursal->telefono}} - {{$sucursal->celular}}</p>
	<h3 align="center">Orden de trabajo: {{$orden->id}}</h3>
	<p><strong>Fecha de ingreso: </strong>{{$orden->fecha_ingreso}} <strong aling="right">Usuario que ingres&oacute; el equipo: </strong> 
		{{$usuario->nombres}}</p>
	<p><strong>Cliente:</strong> {{$cliente->nombres}}</p>
	<p><strong>Datos del equipo:</strong><br/>
		<strong>Tipo: </strong>{{$equipo->tipo}}<br/>
		<strong>Marca: </strong>{{$equipo->marca}}<br/>
		<strong>Modelo: </strong>{{$equipo->modelo}}<br/>
		<strong>Serie: </strong>{{$equipo->serie}}
	</p>
	<p><strong>Problema:</strong><br/>
		{{$orden->problema}}</p>	
	<p><strong>Accesorios:</strong><br/>
		{{$orden->accesorios}}</p>
	<p><strong>Fecha de prometido: </strong>{{$orden->fechaPrometido}} <strong>T&eacute;cnico asignado: </strong> 
		{{$tecnico->nombres}}</p>
</body>
</html>