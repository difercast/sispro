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
	@if($inicio && $final && $sucursal && $ordenes)
	<div data-role="page">
		<div data-role="header">
			<?php  $emp = Empresa::findOrFail(1); ?>
		</div>
		<div data-role="content" style="font-size: 75%;">							 	
 		<h2 align="center">{{$emp->razon_comercial}}</h2>
 		<h3 align="center">Ordenes de trabajo entregadas en una sucursal</h3>
 		<p align="center">
 			<strong>Per&iacute;odo: </strong> 	{{$inicio}} a {{$final}}<br/>
 			<strong>Sucursal: </strong> {{$sucursal}}</p>
 		<p>
 			<strong>N&uacute;mero de &oacute;rdenes de trabajo: </strong>{{count($ordenes)}} 			 			
 		</p>
 		<?php $totalGeneral = 0; ?> 
	 		<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" align="center">
		 			<thead>
		 				<tr>
		 					<th>Orden</th>
		 					@if($sucursal == 'Todos los locales')
		 						<th>Sucursal</th>					
		 					@endif						
							<th>cliente</th>
							<th>Equipo</th>
							<th>T&eacute;cnico</th>
							<th>Entrega</th>					
							<th>Informe</th>
							<th>Vendedor</th>
							<th>Total</th>	 					
		 				</tr>
		 			</thead>
		 			<tbody>
		 				@foreach($ordenes as $orden)
		 				<tr>	 					 		
		 					<td align="center">{{$orden->id}}</td>
		 					@if($sucursal == 'Todos los locales')
		 						<?php $suc = Sucursal::findOrFail($orden->Sucursal_id) ?> 
		 						<td>{{$suc->nombre}}</td> 					
		 					@endif		 								
		 					<?php $cliente = Cliente::findOrFail($orden->cliente_id); ?>
		 					<td>{{$cliente->nombres}}</td>	 					
		 					<?php $equipo = Equipo::findOrFail($orden->equipo_id); ?>	 					 
		 					<td>{{$equipo->tipo}} {{$equipo->marca}} {{$equipo->modelo}}</td>
		 					<?php $tecnic = User::findOrFail($orden->tecnico) ?>
		 					<td>{{$tecnic->nombres}}</td>
		 					<td>{{$orden->fecha_entregado}}</td>
		 					<td>{{$orden->informe}}</td>
		 					<?php $vend = User::findOrFail($orden->vendedor_id) ?>
		 					<td>{{$vend->nombres}}</td>
		 					<td>$ {{$orden->total}}</td> 					
		 				</tr>
		 				<?php $totalGeneral += $orden->total; ?>
		 				@endforeach
		 			</tbody>
		 		</table><br/>
	 		<p><strong>Total presupuestado:</strong> ${{ $totalGeneral}}</p>
		</div>
	</div>
	@endif
</body>
</html>
{{HTML::script('js/jquery.js');}}
{{HTML::script('js/jquery.mobile-1.4.2.js')}}