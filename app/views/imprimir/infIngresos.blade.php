<!DOCTYPE html>
<html lang="es">
</--sucursal, fecha inicio, fecha final, ordenes--/>
<head>
	<title>Ingresos órdenes de trabajo</title>
	<meta charset="utf-8" />
</head>
<body>
	<h1 align="center">{{$empresa->razon_comercial}}</h1>
	<h2>Equipos ingresados a la empresa entre {{$fechaInicio}} y {{$fechaFinal}}</h2>
	<h3 align="center">Local {{$sucursal}}</h3>
	<p><strong>N&uacute;mero de &oacute;rdenes de trabajo ingresados: </strong> {{count($ordenes)}}</p><br/>
	<table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive">
		<thead>
			<tr>
				<th>Nro de orden</th>					
				<th>Cliente</th>
				<th>Fecha de ingreso</th>
				<th>Usuario</th>
				<th>Equipo</th>
				<th>Problema</th>
			</tr>
		</thead>
		<tbody>
			@foreach($ordenes as $orden)
				<tr>
					<td>{{$orden->id}}</td>
					<td>
						<?php $cliente = Cliente::findOrFail($orden->cliente_id); ?>
						{{$cliente->nombres}}
					</td>
					<td>{{$orden->fecha_ingreso}}</td>
					<td>
						<?php $user = User::findOrFail($orden->user_id); ?>
						{{$user->nombres}}
					</td>
					<td>
						<?php $equipo = Equipo::findOrFail($orden->equipo_id); ?>
						{{$equipo->tipo}}
					</td>
					<td>{{$orden->problema}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>