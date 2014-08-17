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
		$vendedor = User::findOrFail($orden->vendedor_id);
	?>
	<div data-role="page">
		<div data-role="header">
			<?php  $emp = Empresa::findOrFail(1); ?>
		</div>
		<div data-role="content" style="font-size: 75%;">							 	
			@if($orden)
				<h2 align="center">Orden de trabajo Nro {{$orden->id}}</h2>
				<table>
					<tr>
						<td style="width: 50%;"><strong>Ingreso: </strong>{{$orden->fecha_ingreso}} a las {{date('h:i a,',strtotime($orden->created_at))}} en {{ $local->nombre}}</td>
						<td style="width: 50%;"><strong>Usuario que ingres&oacute; la orden: </strong> {{$user->nombres}}
							{{$user->apellidos}}</td>
					</tr>
				</table><br>
				<p>
					<strong>Datos del Cliente:</strong><br/>
					<strong>Nombres: </strong> {{$cliente->nombres}}<br>
					<strong>C&eacute;dula:</strong> {{$cliente->cedula}}<br>
					<strong>Direcci&oacute;n</strong> {{$cliente->direccion}}<br>
				</p><br>
					<p><strong>Datos del Equipo</strong><br/>
		 			<strong>Tipo: </strong> {{$equipo->tipo}}<br/>
		 			<strong>Marca: </strong> {{$equipo->marca}}<br/>
		 			<strong>Modelo: </strong> {{$equipo->modelo}}<br/>
		 			<strong>Serie: </strong> {{$equipo->serie}}<br/>
		 		</p>
		 		<p><strong>Problema:</strong><br/>{{$orden->problema}}</p>
		 		<p><strong>Accesorios del equipo:</strong><br/>{{$orden->accesorios}}</p><br>
		 		<h3 align="center">Detalles de la reparaci&oacute;n del equipo</h3>
		 		<p><strong>Estado de la reparaci&oacute;n: </strong>
		 			@if($orden->estado == '0')
		 				Sin revisar
		 			@elseif($orden->estado == '1')
		 				En raparaci&oacute;
		 			@elseif($orden->estado == '2')
		 				Reparaci&oacute;n terminada a {{$orden->fecha_terminado}}
		 			@endif
		 		</p>
		 		<p><strong>Detalle de la reparaci&oacute;n: </strong><br/>{{$orden->detalle}}</p>
		 		<p><strong>Informe de la reparaci&oacute;n: </strong><br/>{{$orden->informe}}</p>
		 		<p><strong>Orden de trabajo presupuestada: </strong> 
		 			@if($orden->presupuestado == '0')
		 				No presupuestado
		 			@else
		 				Si presupuestado
		 			@endif
		 		</p>

		 		<p><strong>Detalle del presupuesto: </strong><br/>
		 			@if($orden->presupuestado == '0')
		 				Orden de trabajo sin presupuesto
		 			@else
		 				<table data-role="table" align="center"  class="movie-list ui-responsive" >
							<thead>
								<tr>
									<th>Detalle</th>
									<th>Valor</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orden->presupuestos as $valores)
								<tr>							
									<td>{{$valores->detalle}}</td>
									<td>$ {{number_format($valores->pivot->valor_actual,2) }}</td>							
								</tr>
								@endforeach
								<tr>
									<td style="text-align: right;"><b>Subtotal</b></td>
									<td>$ {{number_format($orden->subtotal,2) }}</td>							
								</tr>
								<tr>
									<td style="text-align: right;"><b>IVA</b></td>
									<td> 12%</td>							
								</tr>					
								<tr>
									<td style="text-align: right;"><b>TOTAL</b></td>
									<td>$ {{number_format($orden->total,2) }}</td>							
								</tr>		
							</tbody>
						</table>
		 			@endif
		 		</p>
		 		<p><strong>Orden de trabajo entregada: </strong><br/>
		 			@if($orden->entregado == '0')
		 				Orden de trabajo no entregada
		 			@else
		 				Orden de trabajo entregada al cliente en {{$orden->fecha_entregado}} por {{$vendedor->nombres}} 
		 				{{$vendedor->apellidos}}
		 			@endif
		 		</p>

			@endif
		</div>
	</div>
	@endif
</body>
</html>
{{HTML::script('js/jquery.js');}}
{{HTML::script('js/jquery.mobile-1.4.2.js')}}
