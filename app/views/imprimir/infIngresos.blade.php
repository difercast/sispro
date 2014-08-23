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
		<script type="text/php">
        if ( isset($pdf) ) {
            $font = Font_Metrics::get_font("helvetica", "bold");
            $pdf->page_text(72, 18, "{PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(255,0,0));
        }
    </script> 
    </script>
	@if($inicio && $final && $local && $ordenes)
	<div data-role="page">
		<div data-role="header">
			<?php  $emp = Empresa::findOrFail(1); ?>
		</div>
		<div data-role="content" style="font-size: 75%;">							 	
	 		<h2 align="center">{{$emp->razon_comercial}}</h2>
	 		<h3 align="center">Ordenes de trabajo ingresadas a la empresa</h3>
	 		<p align="center">
	 			<strong>Per&iacute;odo: </strong> 	{{$inicio}} a {{$final}}<br/>
	 			<strong>Sucursal: </strong> {{$local}}</p>
	 		<p>
	 			<strong>N&uacute;mero de &oacute;rdenes de trabajo: </strong>{{count($ordenes)}} 			
	 		</p> 		
	 		<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" align="center" style="font-size:75%;"> 				
	 			<thead>
					<tr>
						<th>Orden</th>
						<th>Ingreso</th>
						<th>Usuario</th>
						<th>Cliente</th> 					
						<th>Equipo</th>	 					
						<th>T&eacute;cnico</th>		 					
						<th>Estado</th>
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
						@if($orden->estado == '0')
							<td align="center">Sin revisar</td>
						@elseif($orden->estado == '1')
							<td align="center">En reparación</td>
						@elseif($orden->estado == '2')
							<td align="center">Reparación terminada</td>
						@elseif ($orden->estado == '3')
							<td>Dado de baja</td>
						@endif
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


