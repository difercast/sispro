@extends('layout.base')
{{--Sección título--}}
@if($orden)
	@section('titulo')
		<title>Detalle orden de trabajo</title>
	@stop
	{{--Sección head--}}
	@section('head')
	<!-- scripts -->
	@stop
	{{--Sección header--}}
	@section('header')		
		@if(Auth::user()->rol == 'tecnico')	
			{{ HTML::link('tecnico','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); 
		}}
		@else
			{{ HTML::link('vendedor','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); 
			}}
		@endif	
	@stop
	{{--Sección principal--}}
	@section('principal')
		{{--Mensajes de errores--}}
		<?php $status = Session::get('status') ?>
		@if($status == 'okGestion')
			<div id='okGestion' class='okGestion'>
				<p>Los cambios se han registrado correctamente</p>
			</div>
		@elseif($status == 'errorGestion')
			<div class="errorGestion" id="errorGestion">
				<p>Error al registrar los cambios en la orden de trabajo</p>
			</div>
		@endif
		<h3 align="center">Orden de trabajo N° {{$orden->id}}</h3>		
		{{--Opción de la orden de trabajo--}}
		@if($orden->getSucursal($orden->id) == Auth::user()->sucursal_id)
			@if(Auth::user()->rol == 'tecnico')
				@if($orden->entregado != '1' && ($orden->estado != '2') && $orden->presupuestado == '0')
					<div data-role="controlgroup" data-type="horizontal" data-mini="true">
						{{ HTML::link( '#AdminOrden','Administrar orden',array('class'=>'ui-btn')); }}
						{{ HTML::link("#", 'Detalle del presupuesto',array('data-role'=>'button','class'=>'ui-state-disabled')); }}
						{{ HTML::link('DetalleOrden/'.$orden->id, 'Generar documento',array('data-role'=>'button','target'
						=>'_blank')); }}
					</div>					
				@elseif($orden->entregado == '0' && $orden->estado == '2' && $orden->presupuestado == '0')
					<div data-role="controlgroup" data-type="horizontal" data-mini="true">
						{{ HTML::link( '#','Administrar orden',array('data-role'=>'button','class'=>'ui-state-disabled')); }}
						{{ HTML::link("#detallePresupuesto", 'Detalle del presupuesto',array('class'=>'ui-btn')); }}
						{{ HTML::link('DetalleOrden/'.$orden->id, 'Generar documento',array('data-role'=>'button','target'
						=>'_blank')); }}
					</div>					
				@elseif($orden->entregado == '1' || $orden->presupuestado == '1')					
					<div data-role="controlgroup" data-type="horizontal" data-mini="true">
						{{ HTML::link('DetalleOrden/'.$orden->id, 'Generar documento',array('data-role'=>'button','target'
						=>'_blank')); }}
					</div>					
				@endif
			@elseif (Auth::user()->rol == 'vendedor')
				@if($orden->presupuestado == '1' && $orden->entregado == '0')
					<div data-role="controlgroup" data-type="horizontal" data-mini="true">
						{{ HTML::link('#panelEntrega', 'Entregar',array('data-role'=>'button')); }}
						{{ HTML::link('DetalleOrden/'.$orden->id, 'Generar documento',array('data-role'=>'button','target'
						=>'_blank')); }}
					</div>
				@else
					<div data-role="controlgroup" data-type="horizontal" data-mini="true">
						{{ HTML::link('#panelEntrega', 'Entregar',array('data-role'=>'button','class'=>'ui-state-disabled')); }}
						{{ HTML::link('DetalleOrden/'.$orden->id, 'Generar documento',array('data-role'=>'button','target'
						=>'_blank')); }}
					</div>
				@endif
			@endif
		@else
			<span style="color:red;">Las opciones para moficicar la información de la orden de trabajo no están disponibles porque la misma fue ingresada en otra sucursal</span><br/>
		@endif
		{{Form::open(array('id'=>'ordenForm'))}}
			{{--Fecha de ingreso y usuario que ingresó el equipo--}}
			<div class="ui-grid-a ui-responsive">
				<div class="ui-block-a">
					<div class="bloque">
						{{Form::label('fechaIngreso','Ingreso:')}}
						{{Form::text('fechaIngreso',date("d M Y",strtotime($orden->created_at ))." en ". $sucursal,array('data-mini'=>'true','readonly'=>'true'))}}
					</div>											
				</div>
				<div class="ui-block-b">
					<div class="bloque">
						{{Form::label('integrante','Integrante:')}}
						{{Form::text('user',$user,array('data-mini'=>'true','readonly'=>'true'))}}
					</div>						
				</div>						
			</div>
			<br><br>
			{{--Datos del cliente--}}
			<span><strong>Cliente:</strong></span>	
			<div class="ui-grid-a ui-responsive">
				<div class="ui-block-a">
					<div class="bloque">
						{{Form::text('nombres',$cliente->nombres,array('readonly'=>'true'))}}				
					</div>											
				</div>
				<div class="ui-block-b">
					<div data-role="controlgroup" data-type="horizontal" class="bloque">
						{{ HTML::link('#panelCliente', 'Detalles del cliente',array('class'=>'ui-btn')); }}
					</div>						
				</div>						
			</div><br/>
			{{--Datos del equipo--}}									
			<span><strong>Equipo:</strong></span><br/>
			<div data-role="fieldcontain">
				{{Form::label('tipo','Tipo:')}}
				{{Form::text('tipo',$equipo->tipo,array('data-mini'=>'true','readonly'=>'true'))}}
			</div>
			<div data-role="fieldcontain">
				{{Form::label('marca','Marca:')}}
				{{Form::text('marca',$equipo->marca,array('data-mini'=>'true','readonly'=>'true'))}}
			</div>
			<div data-role="fieldcontain">
				{{Form::label('modelo','Modelo:')}}
				{{Form::text('modelo',$equipo->modelo,array('data-mini'=>'true','readonly'=>'true'))}}
			</div>
			<div data-role="fieldcontain">
				{{Form::label('serie','Número de serie:')}}
				{{Form::text('serie',$equipo->serie,array('data-mini'=>'true','readonly'=>'true'))}}
			</div><br/>
			{{--Problemas y accesorios--}}
			<div class="ui-grid-a ui-responsive">
				<div class="ui-block-a">
					<div class="bloque">
						{{Form::label('problema','Problema:')}}
						{{Form::textarea('problema',$orden->problema,array('data-mini'=>'true','readonly'=>'true'))}}					
					</div>											
				</div>
				<div class="ui-block-b">
					<div class="bloque">
						{{Form::label('accesorios','Accesorios:')}}
						{{Form::textarea('accesorios',$orden->accesorios,array('data-mini'=>'true','readonly'=>'true'))}}
					</div>						
				</div>						
			</div>
			<br/>
			{{--Detalle de la reparación--}}
			<h4>Detalles de la reparación</h4>
			<div class="ui-grid-a ui-responsive">
				<div class="ui-block-a">
					<div class="bloque">
						{{Form::label('detalle','Detalle de la reparación:')}}
						{{Form::textarea('detalle',$orden->detalle,array('data-mini'=>'true','readonly'=>'true','id'=>'detalleRep'))}}					
					</div>											
				</div>
				<div class="ui-block-b">
					<div class="bloque">
						{{Form::label('informe','Informe al cliente:')}}
						{{Form::textarea('informe',$orden->informe,array('data-mini'=>'true','readonly'=>'true','id'=>'informeRep'))}}
					</div>
				</div>						
			</div>
			<br/>
			{{--Dertalles del presupuesto--}}
			<h4>Detalles del presupuesto</h4>
			@if($orden->presupuestado != '1')
				<span>No presupuestado</span>
			@else
				<table data-role="table"  class="movie-list ui-responsive" >
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
			{{--Estado de la reparación--}}
			<h4>Estado de la reparación</h4>
			<div data-role="fieldcontain">
				{{Form::label('estado','Estado de reparación:')}}
				@if($orden->estado == '0')
					{{Form::text('serie','Sin revisar',array('data-mini'=>'true','readonly'=>'true'))}}
				@elseif($orden->estado == '1')
					{{Form::text('serie','En reparación',array('data-mini'=>'true','readonly'=>'true'))}}
				@else
					{{Form::text('serie','Reparación terminada el '.date("d M Y",strtotime($orden->fecha_terminado)),array('data-mini'=>'true','readonly'=>'true'))}}
				@endif
			</div>	
			{{--Equipo entregado--}}
			<div data-role="fieldcontain">
				{{Form::label('terminado','Equipo entregado:')}}
				@if($orden->entregado == '1')
					{{Form::text('serie','Entregado el '.date("d M Y",strtotime($orden->fecha_entregado)),array('data-mini'=>'true','readonly'=>'true'))}}					
				@else
					{{Form::text('serie',' No entregado',array('data-mini'=>'true','readonly'=>'true'))}}
				@endif
			</div>
			<div data-role="controlgroup" data-type="horizontal" align="center">
				@if(Auth::user()->rol == 'tecnico')				
					{{HTML::link('tecnico','Regresar',array('data-role'=>'button','data-mini'=>'true'))}}
				@elseif(Auth::user()->rol == "vendedor")
					{{HTML::link('vendedor','Regresar',array('data-role'=>'button','data-mini'=>'true'))}}
				@endif
			</div>
		{{Form::close()}}	
	@stop
	{{--Sección secundario--}}
	@section('secundario')
	@stop
	{{--Sección paneles--}}
	@section('paneles')
		{{--Panel que contiene la información del cliente--}}
		<div data-role="panel" id="panelCliente" data-display="overlay">
			<h3 align="center">Detalles de cliente</h3>
			{{Form::open()}}				
				{{Form::label('nombres','Nombres:')}}
				{{Form::text('nombres',$cliente->nombres,array('readonly'=>'true'))}}				
				{{Form::label('cedula','Cédula:')}}
				{{Form::text('cedula',$cliente->cedula,array('readonly'=>'true'))}}
				{{Form::label('direccion','Dirección:')}}
				{{Form::textarea('direccion',$cliente->direccion)}}
				{{Form::label('telefono','Teléfono:')}}
				{{Form::text('telefono',$cliente->telefono,array('readonly'=>'true'))}}
				{{Form::label('celular','Celular:')}}
				{{Form::text('celular',$cliente->celular,array('readonly'=>'true'))}}
				{{Form::label('observaciones','Observaciones:')}}
				{{Form::textarea('observaciones',$cliente->observaciones)}}<br/>
				<a href="#" data-role="button" data-rel="close" data-theme="b">Aceptar</a>
			{{Form::close()}}
		</div>
		{{--Panel de administración de la orden de trabajo--}}
		<div data-role="panel" id="AdminOrden" data-display="overlay">
			<h3 align="center">Administrar orden de trabajo</h3>			
			{{ Form::open(array('url' => 'ordenTrabajo/gestion', 'id'=>'administrarOrden')) }}				
				{{--Errores al presentar radio buttons con sintaxis de laravel, por eso escribimos con sitaxis html--}}
				@if($orden->estado == '0')
					{{Form::label('detalle','Detalle de la reparación')}}
					{{Form::textarea('detalle',$orden->detalle,array('id'=>'detalle'))}}
					{{Form::label('informe','Informe al cliente')}}
					{{Form::textarea('informe',$orden->informe,array('id'=>'informe'))}}
					{{Form::label('estado','Estado de la reparación')}}
					<fieldset data-role="controlgroup">					    
					    <input type="radio" name="estado" id="check0" value="0" checked="checked">
					    <label for="check0">No revisado</label>
					    <input type="radio" name="estado" id="check1" value="1">
					    <label for="check1">En reparación</label>
					    <input type="radio" name="estado" id="check2" value="2">
					    <label for="check2">Reparación terminada</label>
					</fieldset>
				@elseif($orden->estado == '1')
						{{Form::label('detalle','Detalle de la reparación')}}
						{{Form::textarea('detalle',$orden->detalle,array('id'=>'detalle'))}}
						{{Form::label('informe','Informe al cliente')}}
						{{Form::textarea('informe',$orden->informe,array('id'=>'informe'))}}
						{{Form::label('estado','Estado de la reparación')}}
						<fieldset data-role="controlgroup">						    
						        <input type="radio"  id="check0" value="0" disabled="disable">
						        <label for="check0">No revisado</label>
						        <input type="radio" name="estado" id="check1" value="1" checked="checked">
						        <label for="check1">En reparación</label>
						        <input type="radio" name="estado" id="check2" value="2">
						        <label for="check2">Reparación terminada</label>
						</fieldset>
					@elseif($orden->estado == '2')
						{{Form::label('detalle','Detalle de la reparación')}}
						{{Form::textarea('detalle',$orden->detalle,array('id'=>'detalle','readonly'=>'true'))}}
						{{Form::label('informe','Informe al cliente')}}
						{{Form::textarea('informe',$orden->informe,array('id'=>'informe','readonly'=>'true'))}}
						{{Form::label('estado','Estado de la reparación')}}
						<fieldset data-role="controlgroup">
						        <input type="radio" id="check0" value="0" disabled="disable">
						        <label for="check0">No revisado</label>
						        <input type="radio" id="check1" value="1" disabled="disable">
						        <label for="check1">En reparación</label>
						        <input type="radio" name="estado" id="check2" value="2" checked="checked">
						        <label for="check2">Reparación terminada</label>
						</fieldset>					
				@endif
				{{Form::hidden('orden',$orden->id,array('id'=>'orden'))}}
				{{FOrm::hidden('tipo','gestion')}}
				{{Form::submit('Guardar')}}
			{{Form::close()}}
		</div>
		{{--Panel presupuesto--}}
		<div data-role="panel" id="detallePresupuesto" data-display="overlay">
			<h3>Detalle del presupesto</h3>
			{{Form::open(array('url' => 'ordenTrabajo/presupuestar'))}}
				<input id="filterTable-input" data-type="search">
				<table data-role="table" data-mode="reflow" data-filter="true" data-input="#filterTable-input" class="movie-list ui-responsive" align="center">
					<thead>
						<tr>
							<th>Opción</th>
							<th>Detalle</th>
						</tr>
					</thead>
					<tbody>
						@foreach($presupuesto as $presupuesto)
						<tr>						
							<td>{{ Form::checkbox('presupuesto[]', $presupuesto->id, false) }}</td>
							<td>{{$presupuesto->detalle}}</td>							
						</tr>
						@endforeach
					</tbody>
				</table>
				{{Form::hidden('orden',$orden->id,array('id'=>'orden'))}}							
				{{Form::submit('Guardar')}}
			{{Form::close()}}
		</div>
		{{--Panel de entrega de equipos--}}
		<div data-role="panel" id="panelEntrega" data-display="overlay">
			<h3 align="center">Entrega de un equipo</h3>
			{{Form::open(array('url' => 'ordenTrabajo/entregar'))}}				
				{{Form::label('cliente','Cliente:')}}
				{{Form::text('nombres',$cliente->nombres,array('readonly'=>'true'))}}
				<br/>
				{{Form::label('detalle','Detalle de reparación')}}
				{{Form::textarea('informe',$orden->informe,array('data-mini'=>'true','readonly'=>'true','id'=>'informeRep'))}}
				<br/>
				{{Form::label('valores','A pagar:')}}
				<table data-role="table"  class="movie-list ui-responsive" >
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
				{{Form::hidden('entregado','1')}}
				{{Form::hidden('orden',$orden->id)}}
				{{Form::hidden('vendedor',Auth::user()->id)}}
				{{Form::submit('Entregar')}}
			{{Form::close()}}
		</div>
	@stop	
	@section('scripts')
		<!-- scripts -->
		{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
		{{HTML::script('js/validadores/CamposDetalleOrden.js');}}
	@stop	
@endif



