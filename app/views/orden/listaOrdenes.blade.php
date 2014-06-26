@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Lista de órdenes de trabajo</title>
@show
{{--Sección header--}}
@section('header')		
	@if(Auth::user()->rol == 'tecnico')
		{{ HTML::link('tecnico','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@elseif(Auth::user()->rol == 'vendedor')
		{{ HTML::link('vendedor','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@endif
@stop
@if($ordenes)
	{{--Sección primario--}}
	@section('primario')
		<h3>Órdenes de trabajo</h3>
		{{Form::open()}}
			<input id="filterTable-input" data-type="search"/>
		{{Form::close()}}
		<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" data-filter="true" data-input="#filterTable-input">
			<thead>
				<tr>
					<th>Número</th>
					<th>Cliente</th>
					<th>Tipo</th>
					<th>Problema</th>
					<th>Estado</th>
					<th>Entregado</th>
					<th>Acciones</th>
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
						<td>
							<?php $equipo = Equipo::findOrFail($orden->equipo_id); ?>
							{{$equipo->tipo}}
						</td>
						<td>{{$orden->problema}}</td>
						<td>
							@if($orden->estado == '0')
								Sin revisar
							@elseif($orden->estado == '1')
								En reparación
							@elseif($orden->estado == '2')
								repración terminada
							@endif
						</td>
						<td>
							@if($orden->entregado == '0')
								No entregado
							@else
								Entregado
							@endif
						</td>
						<td>
							{{Form::open(array('url'=>'ordenTrabajo/mostrar'))}}
								{{Form::hidden('NumOrden',$orden->id)}}
								{{Form::submit('Ver')}}			
							{{Form::close()}}
						</td>
					</tr>
				@endforeach
			</tbody>			 
		</table>
		{{ $ordenes->links() }}
	@stop
	{{--Sección secundario--}}
	@section('secundario')
	@stop
@else
	<h3>no hay órdenes de trabajo que mostrar.</h3>
@endif

