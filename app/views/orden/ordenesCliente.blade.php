@extends('layout.base')
@include('includes.styles')

{{--Sección header--}}
@section('titulo')
	<title>Ordenes de trabajo</title>
	@show
@stop
{{--Sección header--}}
@section('header')	
	@if(Auth::user()->rol == 'tecnico')
		{{ HTML::link('tecnico','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
	@elseif(Auth::user()->rol == 'vendedor')
		{{ HTML::link('vendedor','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
	@endif
@stop
{{--Sección principal--}}
@section('principal')
	@if($cliente)
	<h3>Órdenes de trabajo por cliente</h3>
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

