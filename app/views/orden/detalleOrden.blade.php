@extends('layout.base')
@include('includes.styles')

{{--Sección título--}}
@if($orden)
	@section('titulo')
		<title>Detalle orden de trabajo </title>
	@stop

	{{--Sección header--}}
	@section('header')
		<h1>Orden de trabajo N° {{ $orden->id}}</h1>
		{{ HTML::link('tecnico','',array('class'=>'ui-btn ui-icon-back ui-btn-icon-notext ui-corner-all')) }}
	@stop

	{{--Sección primario--}}
	@section('primario')
		{{Form::open()}}
			<div class="rwd-example">
				<div class="ui-block-a">
					<div data-role="fieldcontain">
						{{Form::label('fechaIngreso','Fecha de ingreso:')}}
						{{Form::text('fechaIngreso',date("d M Y",strtotime($orden->created_at)),array('data-mini'=>'true','readonly'=>'true'))}}
					</div>
				</div>
				<div class="ui-block-b">
					<div data-role="fieldcontain" >
						{{Form::label('integrante','Integrante:')}}
						{{Form::text('user',$user,array('data-mini'=>'true','readonly'=>'true'))}}
					</div>
				</div>
			</div>	
			<span><strong>Datos del cliente:</strong></span><br/>
			<div data-role="controlgroup">
				<div data-role="fieldcontain">
					{{Form::label('nombres','Nombres:')}}
					{{Form::text('nombres',$cliente->nombres,array('data-mini'=>'true','readonly'=>'true'))}}
				</div>
				<div data-role="fieldcontain">
					{{Form::label('cedula','Cédula:')}}
					{{Form::text('cedula',$cliente->cedula,array('data-mini'=>'true','readonly'=>'true'))}}
				</div>
				<div data-role="fieldcontain">
					{{Form::label('direccion','Dirección:')}}
					{{Form::textarea('direccion',$cliente->direccion,array('data-mini'=>'true','readonly'=>'true'))}}
				</div>
				<div data-role="fieldcontain">
					{{Form::label('telefono','Teléfono:')}}
					{{Form::text('telefono',$cliente->telefono,array('data-mini'=>'true','readonly'=>'true'))}}
				</div>
			</div>
			<span><strong>Datos del equipo:</strong></span><br/>
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
			<div class="rwd-example">
				<div class="ui-block-a">
						{{Form::label('detalle','Detalle de la reparación:')}}
						{{Form::textarea('detalle',$orden->detalle,array('data-mini'=>'true','readonly'=>'true'))}}
				</div>
				<div class="ui-block-b">
						{{Form::label('informe','Informe al cliente:')}}
						{{Form::textarea('informe',$orden->informe,array('data-mini'=>'true','readonly'=>'true'))}}
				</div>
			</div><br/>
			<div data-role="fieldcontain">
				{{Form::label('estado','Estado de reparación:')}}
				@if($orden->estado == '0')
					{{Form::text('serie','Sin revisar',array('data-mini'=>'true','readonly'=>'true'))}}
				@elseif($orden->estado == '1')
					{{Form::text('serie','En reparación',array('data-mini'=>'true','readonly'=>'true'))}}
				@else
					{{Form::text('serie','Reparción terminada',array('data-mini'=>'true','readonly'=>'true'))}}
				@endif
			</div>			
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
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">
			<li data-role="listdivider">Acciones</li>
			@if(Auth::user()->rol == 'tecnico')
				<li data-icon="false">{{ HTML::link( 'ordenTrabajo/gestion/'.$orden->id,'Administrar orden') }}</li>
				<li data-iucon="false">{{ HTML::link("#", 'Detalle del presupuesto')}}</li>
				<li data-icon="false">{{ HTML::link('#', 'Generar documento'); }}</li>			
			@endif
			@if($orden->entregado == '0' && Auth::user()->rol == 'vendedor')
				<li data-icon="false">{{ HTML::link('#', 'Entregar'); }}</li>	
				<li data-icon="false">{{ HTML::link('#', 'Generar documento'); }}</li>
			@endif
		</ul>
	@stop
@endif
