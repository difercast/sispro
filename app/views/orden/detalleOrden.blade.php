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
		{{ HTML::link('tecnico','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
	@stop
	{{--Sección primario--}}
	@section('primario')
		<h3 align="center">Orden de trabajo N° {{$orden->id}}</h3>		
		{{--Opción de la orden de trabajo--}}
		@if(Auth::user()->rol == 'tecnico' && $orden->entregado != '1')
			<div data-role="controlgroup" data-type="horizontal" data-mini="true">
			    {{ HTML::link( '#AdminOrden','Administrar orden',array('class'=>'ui-btn')); }}
				{{ HTML::link("#detallePresupuesto", 'Detalle del presupuesto',array('class'=>'ui-btn')); }}
				{{ HTML::link('#', 'Generar documento',array('class'=>'ui-btn')); }}	
			</div>
		@elseif($orden->entregado == '0' && Auth::user()->rol == 'vendedor')
			<div data-role="controlgroup" data-type="horizontal" data-mini="true">
			    {{ HTML::link('#', 'Entregar',array('class'=>'ui-btn')); }}	
				{{ HTML::link('#', 'Generar documento',array('class'=>'ui-btn')); }}
			</div>
		@endif		
		{{Form::open(array('id'=>'ordenForm'))}}
			{{--Fecha de ingreso y usuario que ingresó el equipo--}}
			<div class="rwd-example">
				<div class="ui-block-a">
					<div data-role="fieldcontain">
						{{Form::label('fechaIngreso','Ingreso:')}}
						{{Form::text('fechaIngreso',date("d M Y",strtotime($orden->created_at)),array('data-mini'=>'true','readonly'=>'true'))}}
					</div>
				</div>
				<div class="ui-block-b">
					<div data-role="fieldcontain" data-position="horizontal">
						{{Form::label('integrante','Integrante:')}}
						{{Form::text('user',$user,array('data-mini'=>'true','readonly'=>'true'))}}
					</div>
				</div>
			</div>
			{{--Datos del cliente--}}
			<span><strong>Cliente:</strong></span>	
			<div class="rwd-example">
				<div class="ui-block-a">					
						{{Form::text('nombres',$cliente->nombres,array('readonly'=>'true'))}}				
				</div>
				<div class="ui-block-b">					
					<div data-role="controlgroup" data-type="horizontal" data-mini="true">
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
			<div class="rwd-example">
				<div class="ui-block-a">
						{{Form::label('problema','Problema:')}}
						{{Form::textarea('problema',$orden->problema,array('data-mini'=>'true','readonly'=>'true'))}}
				</div>
				<div class="ui-block-b">
						{{Form::label('accesorios','Accesorios:')}}
						{{Form::textarea('accesorios',$orden->accesorios,array('data-mini'=>'true','readonly'=>'true'))}}
				</div>
			</div><br/>
			{{--Detalle de la reparación--}}
			<h4>Detalles de la reparación</h4>
			<div class="rwd-example">
				<div class="ui-block-a">
						{{Form::label('detalle','Detalle de la reparación:')}}
						{{Form::textarea('detalle',$orden->detalle,array('data-mini'=>'true','readonly'=>'true','id'=>'detalleRep'))}}
				</div>
				<div class="ui-block-b">
						{{Form::label('informe','Informe al cliente:')}}
						{{Form::textarea('informe',$orden->informe,array('data-mini'=>'true','readonly'=>'true','id'=>'informeRep'))}}
				</div>
			</div><br/>
			{{--Estado de la reparación--}}
			<div data-role="fieldcontain">
				{{Form::label('estado','Estado de reparación:')}}
				@if($orden->estado == '0')
					{{Form::text('serie','Sin revisar',array('data-mini'=>'true','readonly'=>'true'))}}
				@elseif($orden->estado == '1')
					{{Form::text('serie','En reparación',array('data-mini'=>'true','readonly'=>'true'))}}
				@else
					{{Form::text('serie','Reparación terminada',array('data-mini'=>'true','readonly'=>'true'))}}
				@endif
			</div>			
			{{--Equipo entregado--}}
			<div data-role="fieldcontain">
				{{Form::label('terminado','Equipo entregado:')}}
				@if($orden->entregado == '1')
					{{Form::text('serie','Entregado',array('data-mini'=>'true','readonly'=>'true'))}}
				@else
					{{Form::text('serie',' No entregado',array('data-mini'=>'true','readonly'=>'true'))}}
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
			{{ Form::open(array('url' => 'ordenTrabajo/mostrar')) }}				
				{{--Errores al presentar radio buttons con sintaxis de laravel, por eso escribimos con sitaxis html--}}
				@if($orden->estado == '0')
					{{Form::label('detalle','Detalle de la reparación')}}
					{{Form::textarea('detalle',$orden->detalle,array('id'=>'detalle'))}}
					{{Form::label('informe','Informe al cliente')}}
					{{Form::textarea('informe',$orden->informe,array('id'=>'informe'))}}
					{{Form::label('estado','Estado de la reparación')}}
					<fieldset data-role="controlgroup">					    
					    <input type="radio" name="estado" id="0" value="0" checked="checked">
					    <label for="0">No revisado</label>
					    <input type="radio" name="estado" id="1" value="1">
					    <label for="1">En reparación</label>
					    <input type="radio" name="estado" id="2" value="2">
					    <label for="2">Reparación terminada</label>
					</fieldset>
					@elseif($orden->estado == '1')
						{{Form::label('detalle','Detalle de la reparación')}}
						{{Form::textarea('detalle',$orden->detalle,array('id'=>'detalle'))}}
						{{Form::label('informe','Informe al cliente')}}
						{{Form::textarea('informe',$orden->informe,array('id'=>'informe'))}}
						{{Form::label('estado','Estado de la reparación')}}
						<fieldset data-role="controlgroup">						    
						        <input type="radio"  id="0" value="0" disabled="disable">
						        <label for="0">No revisado</label>
						        <input type="radio" name="estado" id="1" value="1" checked="checked">
						        <label for="1">En reparación</label>
						        <input type="radio" name="estado" id="2" value="2">
						        <label for="2">Reparación terminada</label>
						</fieldset>
					@elseif($orden->estado == '2')
						{{Form::label('detalle','Detalle de la reparación')}}
						{{Form::textarea('detalle',$orden->detalle,array('id'=>'detalle','readonly'=>'true'))}}
						{{Form::label('informe','Informe al cliente')}}
						{{Form::textarea('informe',$orden->informe,array('id'=>'informe','readonly'=>'true'))}}
						{{Form::label('estado','Estado de la reparación')}}
						<fieldset data-role="controlgroup">
						        <input type="radio" id="0" value="0" disabled="disable">
						        <label for="0">No revisado</label>
						        <input type="radio" id="1" value="1" disabled="disable">
						        <label for="1">En reparación</label>
						        <input type="radio" name="estado" id="2" value="2" checked="checked">
						        <label for="2">Reparación terminada</label>
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
		</div>
	@stop		
@endif



