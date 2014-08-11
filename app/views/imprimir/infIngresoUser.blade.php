<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	@section('titulo')
		<title>Sistema de reparaci&oacute;n de equipos inform&aacute;ticos de Sisprocompu</title>
	@show
	<meta name="viewport" content="width=device-width, initial-scale=1" />				
	{{HTML::style('css/jquery.mobile-1.4.2.min.css')}}
	{{HTML::style('css/sispro/sispro.css');}}
	{{HTML::style('css/sispro/jquery.mobile.icons.min.css');}}
</head>
<body>
	@if($inicio && $final && $usuario && $ordenes)
	<div data-role="page">
		<div data-role="header">
			<?php  $emp = Empresa::findOrFail(1); ?>
		</div>
		<div data-role="content">							 	
 		<h2 align="center">{{$emp->razon_comercial}}</h2>
 		<h3 align="center">Ordenes de trabajo ingresadas a la empresa por un usuario</h3>
 		<p align="center">
 			<strong>Per&iacute;odo: </strong> 	{{$inicio}} a {{$final}}<br/>
 			<strong>Usuario: </strong> {{$usuario->nombres }} {{$usuario->apellidos}}</p>
 		<p>
 			<strong>N&uacute;mero de &oacute;rdenes de trabajo: </strong>{{count($ordenes)}} 			
 		</p>
 		<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" >
	 			<thead>
	 				<tr>
	 					<th>Orden</th>
	 					<th>Ingreso</th>
	 					<th>Usuario</th>
	 					<th>Cliente</th> 					
	 					<th>Equipo</th>	 					
	 					<th>T&eacute;cnico</th>
	 				</tr>
	 			</thead>
	 			<tbody>
	 				@foreach($ordenes as $orden)
	 				<tr>	 					 		
	 					<td align="center">{{$orden->id}}</td>
	 					<td>{{$orden->fecha_ingreso}}</td>
	 					<?php $user = User::findOrFail($orden->user_id) ?>
	 					<td align="center">{{$user->username}}</td>
	 					<?php $cliente = Cliente::findOrFail($orden->cliente_id); ?>
	 					<td>{{$cliente->nombres}}</td>
	 					<?php $equipo = Equipo::findOrFail($orden->equipo_id); ?>	 					 
	 					<td>{{$equipo->tipo}} {{$equipo->marca}} {{$equipo->modelo}}</td>	 					
	 					<?php $tec = User::findOrFail($orden->tecnico) ?>
	 					<td align="center">{{$tec->nombres}}</td>
	 				</tr>
	 				@endforeach
	 			</tbody>
	 		</table><br/>
		</div>
	</div>
	@endif
</body>
</html>
{{HTML::script('js/jquery.js');}}
{{HTML::script('js/jquery.mobile-1.4.2.js')}}
