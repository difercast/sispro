@extends('layout.base')
{{--Sección título--}}
@section('titulo')
	<title>Lista de órdenes de trabajo</title>
@show
{{--Head--}}
@section('head')
	{{HTML::style('css/paginacion.css')}}
@stop
{{--Sección header--}}
@section('header')		
	@if(Auth::user()->rol == 'tecnico')
		{{ HTML::link('tecnico','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@elseif(Auth::user()->rol == 'vendedor')
		{{ HTML::link('vendedor','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
	@endif
@stop
@if($ordenes)
	{{--Sección todo--}}
	@section('todo')
		<h2 align="center">Listado de órdenes de trabajo</h2>
		<div class="listas">
			<?php $status=Session::get('estado') ?>
			<p align="center">Filtros de búsqueda</p>
			<div class="opciones">
				@if($estado == 'todos')
					<div data-role="controlgroup" data-type="horizontal" data-mini="true" align="center">
						{{ HTML::link( '#','Todos',array('data-role'=>'button','class'=>'ui-state-disabled controlG')); }}
						{{ HTML::link("ordenTrabajo/listado/2", 'Entregados',array('class'=>'ui-btn controlG')); }}
						{{ HTML::link('ordenTrabajo/listado/3', 'Reparación terminada',array('class'=>'ui-btn controlG')); }}
						{{ HTML::link('ordenTrabajo/listado/4', 'Sin revisar',array('class'=>'ui-btn controlG')); }}		
					</div>
				@elseif($estado == 'entregados')
					<div data-role="controlgroup" data-type="horizontal" data-mini="true" align="center">
						{{ HTML::link( 'ordenTrabajo/listado/1','Todos',array('class'=>'ui-btn controlG')); }}
						{{ HTML::link("#", 'Entregados',array('data-role'=>'button','class'=>'ui-state-disabled')); }}
						{{ HTML::link('ordenTrabajo/listado/3', 'Reparación terminada',array('class'=>'ui-btn controlG')); }}
						{{ HTML::link('ordenTrabajo/listado/4', 'Sin revisar',array('class'=>'ui-btn controlG')); }}		
					</div>
				@elseif($estado == 'terminado')
					<div data-role="controlgroup" data-type="horizontal" data-mini="true" align="center">
						{{ HTML::link( 'ordenTrabajo/listado/1','Todos',array('class'=>'ui-btn controlG')); }}
						{{ HTML::link("ordenTrabajo/listado/2", 'Entregados',array('class'=>'ui-btn controlG')); }}
						{{ HTML::link('#', 'Reparación terminada',array('data-role'=>'button','class'=>'ui-state-disabled')); }}
						{{ HTML::link('ordenTrabajo/listado/4', 'Sin revisar',array('class'=>'ui-btn controlG')); }}		
					</div>
				@elseif($estado == 'sinRevisar')
					<div data-role="controlgroup" data-type="horizontal" data-mini="true" align="center">
						{{ HTML::link( 'ordenTrabajo/listado/1','Todos',array('class'=>'ui-btn controlG')); }}
						{{ HTML::link("ordenTrabajo/listado/2", 'Entregados',array('class'=>'ui-btn controlG')); }}
						{{ HTML::link('ordenTrabajo/listado/3', 'Reparación terminada',array('class'=>'ui-btn controlG')); }}
						{{ HTML::link('#', 'Sin revisar',array('data-role'=>'button','class'=>'ui-state-disabled')); }}		
					</div>				
				@endif
			</div>
			<br>
		</div>				
		{{Form::open()}}
			<br>
					
			<input id="buscar" data-type="search" placeholder="Buscar orden de trabajo"/>
		{{Form::close()}}
		<br>
		<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" data-filter="true" data-input="#buscar">
			<thead>
				<tr>
					<th>Orden</th>
					<th>Sucursal</th>
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
							<?php $suc = Sucursal::findOrFail($orden->Sucursal_id) ?>
							{{$suc->nombre}}
						</td>
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
								reparación terminada
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
							{{Form::open(array('url'=>'ordenTrabajo/mostrar', 'method' => 'GET'))}}
								{{Form::hidden('NumOrden',$orden->id)}}
								{{Form::submit('Ver')}}			
							{{Form::close()}}
						</td>
					</tr>
				@endforeach
			</tbody>			 
		</table>
		<br>
		{{ $ordenes->links() }}
		<br><br>
	@stop
	{{--Sección secundario--}}
	@section('secundario')
	@stop
@else
	<h3>no hay órdenes de trabajo que mostrar.</h3>
@endif

