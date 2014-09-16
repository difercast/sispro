@extends('layout.base')
{{--Título--}}
 @section('titulo')
 	<title>informes estadísticos</title>
 @stop
 {{--Head--}}
 @section('head')
 @stop
 {{--Header--}}
 @section('header')
 	{{ HTML::link('informe','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
 @stop
 {{--principal--}}
 @section('todo') 	
 	@if($inicio && $final && $vend) 
 		<?php  $emp = Empresa::findOrFail(1); ?>		 		
 		<h2 align="center">{{$emp->razon_comercial}}</h2>
 		<h3 align="center">Ordenes de trabajo entregados por un vendedor</h3>
 		<p align="center">
 			<strong>Período: </strong> 	{{$inicio}} a {{$final}}<br/>
 			<strong>Técnico: </strong> {{$vend->nombres}} {{$vend->apellidos}}</p>
 		@if($ordenes && $ordenes2 && count($ordenes2)!= 0)
 			<?php $totalGeneral = 0; ?>
 			<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" >
	 			<thead>
	 				<tr>
	 					<th>Nro de orden</th>						
						<th>cliente</th>
						<th>Equipo</th>
						<th>Fecha de entrega</th>					
						<th>Informe</th>
						<th>Técnico</th>
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
	 					<td align="center">{{$orden->fecha_entregado}}</td>
	 					<td>{{$orden->informe}}</td>
	 					<?php $tecn = User::findOrFail($orden->tecnico) ?>
	 					<td>{{$tecn->nombres}}</td>
	 					<td>$ {{$orden->total}}</td> 					
	 				</tr>
	 				<?php $totalGeneral += $orden->total; ?>
	 				@endforeach
	 			</tbody>
	 		</table><br/>	 		
	 			{{$ordenes->appends(array('fechaInicio'=>$inicio,'fechaFinal'=>$final,'vendedor'=>$vendedor))->links()}}
	 			<br/><br><br><br><br>		
	 		<p><strong>Número de órdenes:</strong> {{count($ordenes2)}}<br/><br/>
				<strong>Total presupuestado:</strong> ${{ $totalGeneral}} </p>
 		@else
 			<br/>
 			<p><strong>No existen registros para mostrar</strong></p>
 			<br/>
 		@endif
 		<div  data-role="controlgroup" data-type="horizontal" align="center" data-mini="true">
 			{{HTML::link('ordenEntregadaPDF/'.$inicio.'/'.$final.'/'.$vendedor,'Generar documento',array('target'=>'_blank',
 			'data-role'=>'button'))}}
 			{{HTML::link('informe','Regresar',array('data-role'=>'button'))}}
 		</div>
 	@else 
 		<p>Error al procesar el informe solicitado</p>	 		
 	@endif
 @stop