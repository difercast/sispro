@extends('layout.base')
{{--titulo--}}
@section('titulo')
	<title>Equipos ingresados a la empresa</title>
@stop
@section('head')
	
@stop
{{--header--}}

@if($ordenes)
{{--Principal--}}
@section('principal')				
		<table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive">
			<thead>
				<tr>
					<th>Nro de orden</th>										
				</tr>
			</thead>
			<tbody>
				@foreach($ordenes as $orden)
					<tr>
						<td>{{$orden->id}}</td>						
					</tr>
				@endforeach
			</tbody>
		</table>
		<br/>		
		{{ $ordenes->links() }}<br/>				
@stop
@endif

