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
	@if($inicio && $final && $vendedor && $ordenes)
	<div data-role="page">
		<div data-role="header">
			<?php  $emp = Empresa::findOrFail(1); ?>
		</div>
		<div data-role="content" style="font-size: 75%;">							 	
	 		<h2 align="center">{{$emp->razon_comercial}}</h2>
	 		<h3 align="center">Ordenes de trabajo entregadas por un vendedor</h3>
	 		<p align="center">
	 			<strong>Per&iacute;odo: </strong> 	{{$inicio}} a {{$final}}<br/>
	 			<strong>Vendedor: </strong> {{$vendedor->nombres }} {{$vendedor->apellidos}}</p>
	 		<p>
	 			<strong>N&uacute;mero de &oacute;rdenes de trabajo: </strong>{{count($ordenes)}} 			 			
	 		</p>
	 		<?php $totalGeneral = 0; ?>
	 		<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" align="center">
		 		<thead>
		 			<tr>
		 				<th>Orden</th>						
						<th>cliente</th>
						<th>Equipo</th>
						<th>Entrega</th>					
						<th>Informe</th>
						<th>T&eacute;cnico</th>
						<th>Total</th>	 					
		 			</tr>
		 		</thead>
		 	    <tbody>
		 			@foreach($ordenes as $orden)
		 			<tr>	 					 		
		 				<td align="center">{{$orden->id}}</td>		 								
		 				<?php $cliente = Cliente::findOrFail($orden->cliente_id); ?>
		 				<td>{{$cliente->nombres}}</td>	 					
		 				<?php $equipo = Equipo::findOrFail($orden->equipo_id); ?>	 					 
		 				<td>{{$equipo->tipo}} {{$equipo->marca}} {{$equipo->modelo}}</td>
		 				<td>{{$orden->fecha_entregado}}</td>
		 				<td>{{$orden->informe}}</td>
		 				<?php $tecn = User::findOrFail($orden->tecnico) ?>
		 				<td>{{$tecn->nombres}}</td>
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
