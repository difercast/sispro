<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	@section('titulo')
		<title>Sistema de administraci&oacute;n y control de servicios de mantenimiento t&eacute;cnico/title>
	@show
	<meta name="viewport" content="width=device-width, initial-scale=1" />				
	{{HTML::style('css/jquery.mobile-1.4.2.min.css')}}
	{{HTML::style('css/sispro/sispro.css');}}
	{{HTML::style('css/sispro/jquery.mobile.icons.min.css');}}
</head>
<body>
	@if($orden)
	<?php 
		$local = Sucursal::findOrFail($orden->Sucursal_id);
		$user = User::findOrFail($orden->user_id);
		$cliente = Cliente::findOrFail($orden->cliente_id);
		$equipo = Equipo::findOrFail($orden->equipo_id);
		$tecnico = User::findOrFail($orden->tecnico);
	?>
	<div data-role="page">
		<div data-role="header">
			<?php  $emp = Empresa::findOrFail(1); ?>
		</div>
		<div data-role="content" style="font-size: 75%;">							 	
	 		<h2 align="center">{{$emp->razon_comercial}}</h2>
	 		<p align="center">
	 			{{$local->nombre}}<br/>
	 			{{$local->direccion}} <br/>
	 			{{$local->telefono}} - {{$local->celular}}
	 		</p>
	 		<h3 align="center">Orden de trabajo Nro {{$orden->id}}</h3>
	 		<p>
	 			<strong>Fecha de ingreso: </strong>{{$orden->fecha_ingreso}} 
	 			<strong>Ingresado por: </strong>{{$user->nombres}} {{$user->apellidos}} 
	 		</p>
	 		<p><strong>Cliente:</strong><br/>
	 			<strong>Nombres:</strong> {{$cliente->nombres}}<br/>
	 			<strong>Direcci&oacute;n</strong> {{$cliente->direccion}}<br/>
	 			<strong>Tel&eacute;fono</strong> {{$cliente->telefono}}  - 
	 			<strong>Celular: </strong> {{$cliente->celular}}
	 		</p>
	 		<p><strong>Equipo</strong><br/>
	 			<strong>Tipo: </strong> {{$equipo->tipo}}<br/>
	 			<strong>Marca: </strong> {{$equipo->marca}}<br/>
	 			<strong>Modelo: </strong> {{$equipo->modelo}}<br/>
	 			<strong>Serie: </strong> {{$equipo->serie}}<br/>
	 		</p>
	 		<p>
	 			<strong>Problema:</strong><br/>
	 			{{$orden->problema}}<br/>
	 			<strong>Accesorios:</strong><br/>
	 			{{$orden->accesorios}}
	 		</p>
	 		<p>
	 			<strong>Fecha de prometido:</strong> {{$orden->fechaPrometido}}
	 			<strong>T&eacute;cnico asignado a la reparaci&oacute;n:</strong> {{$tecnico->nombres }} {{$tecnico->apellidos}}
	 		</p>

		</div>
	</div>
	@endif
</body>
</html>
{{HTML::script('js/jquery.js');}}
{{HTML::script('js/jquery.mobile-1.4.2.js')}}

