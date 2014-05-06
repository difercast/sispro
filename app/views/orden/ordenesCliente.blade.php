@extends('layout.base')
@include('includes.styles')

{{--Sección header--}}
@section('titulo')
	<title>Ordenes de trabajo</title>
	@show
@stop

@section('header')
	<h1>Ordenes de trabajo por clientes</h1>
	{{ HTML::link('tecnico','',array('class'=>'ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all')); }}
@stop

@section('primario')
	@if($cliente)
	<p><strong>Cliente: </strong> {{ $cliente -> nombres}}</p>
	<table data-role="table" data-mode="reflow" class="movie-list ui-responsive" align="center" >
		<thead>
			<tr>
				<th>Número de orden</th>
				<th>Fecha de ingreso</th>
				<th>Estado</th>
				<th>Entregado</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>			
			@foreach($orden as $orden)
			<tr>
				
				<td>{{$orden->id}}</td>
				<td>{{ date("d M Y",strtotime($orden->created_at)) }} a las {{ date("g:ha",strtotime($orden->created_at)) }}</td>
				@if($orden -> estado == 0)
					<td>Sin revisar</td>
				@elseif($orden->estado == 1)
					<td>En revisión</td>
				@elseif($orden->estado == 2)
					<td>Terminado</td>
				@endif
				@if($orden->entregado == '1')
					<td>Entregado</td>
				@else
					<td>No entregado</td>
				@endif
				<td>{{Form::open(array('url'=>'ordenTrabajo/mostrar'))}}
						{{Form::hidden('NumOrden',$orden->id)}}
						{{Form::submit('Ver orden')}}
					{{form::close()}}
					</td>
			</tr>
			@endforeach			
		</tbody>
	</table>
	@endif
@stop

