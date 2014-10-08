@extends('layout.base')
{{--Título--}}
 @section('titulo')
 	<title>informes estadísticos</title>
 @stop
 {{--Head--}}
 @section('head')
 	{{ HTML::style('css/mensajes.css'); }}
 @stop
 {{--Header--}}
 @section('header')
 	{{ HTML::link('admin','',array('class'=>'ui-btn-left ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
 @stop
 {{--primario--}}
 @section('primario')
 @if($sucursal)
 	<h2 align="center">Informes estadísticos</h2>
 	<?php $status=Session::get('status') ?>
	@if($status == 'error')
		<div id="error" align="center">			
				<p>¡Error!, por favor verifique los datos ingresados </p>
		</div>
	@endif
 	<ul data-role="listview" class="ui-listview-outer" data-inset="true">
 		{{--Ordenes ingresadas en una sucursal--}}
 		<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-in set="false" data-corners="false">
 			<h2>Ordenes de trabajo ingresadas a la empresa</h2> 			
 			{{ Form::open(array('url' => 'informe/ingreso', 'method' => 'GET', 'id' => 'FormIngreso')) }}
 			<div class="ui-grid-a ui-responsive">
 				<div class="ui-block-a bloque"> 					 					
 					{{Form::label('fechaInicio','Fecha de inicio:')}}
 					<input name="fechaInicio" id="fechaInicio" type="date" class="required" data-role="datebox"
   						data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
 				</div>
 				<div class="ui-block-b bloque">
 					{{Form::label('fechaFinal','Fecha de término:')}}
 					<input name="fechaFinal" id="fechaFinal" type="date" data-role="datebox" class="required" 
   						data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
 				</div> 				
 			</div>
 			<div data-role="fieldcontain">
 				{{Form::label('sucursal','Sucursal:')}}
 				{{Form::select('sucursal',$sucursal,array('data-mini'=>'true'))}}
 			</div>
 			<div data-role="controlgroup" data-type="horizontal" align="center">
 				{{Form::submit('Consultar')}}
 			</div>
 			{{Form::close()}}
 		</li>
 		{{--Ordenes ingresadas por usuario--}}		
 		<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-in set="false" data-corners="false">
 			<h2>Ordenes de trabajo ingresadas a la empresa por un usuario</h2>
 			{{ Form::open(array('url' => 'informe/ingresoUser', 'method' => 'GET', 'id' => 'FormIngresoUser')) }}
 			<div class="ui-grid-a ui-responsive">
 				<div class="ui-block-a bloque"> 					 					
 					{{Form::label('fechaInicio','Fecha de inicio:')}}
 					<input name="fechaInicio" id="fechaInicio1" type="date" class="required" data-role="datebox"
   						data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
 				</div>
 				<div class="ui-block-b bloque">
 					{{Form::label('fechaFinal','Fecha de término:')}}
 					<input name="fechaFinal" id="fechaFinal" type="date" data-role="datebox" class="required" 
   						data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
 				</div> 				
 			</div>
 			<div data-role="fieldcontain">
 				{{Form::label('user','Usuario:')}}
 				{{Form::select('user',$user,array('data-mini'=>'true'))}}
 			</div>
 			<div data-role="controlgroup" data-type="horizontal" align="center">
 				{{Form::submit('Consultar')}}
 			</div>
 			{{Form::close()}}
 		</li>

 		{{--Ordenes de trabajo terminadas por técnico--}}
 		<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-in set="false" data-corners="false">
 			<h2>Ordenes de trabajo terminadas por un técnico</h2>
 			{{Form::open(array('url'=>'informe/repTerminadas', 'method' => 'GET', 'id' => 'FormRepTerminadas'))}}
 				<div class="ui-grid-a ui-responsive">
	 				<div class="ui-block-a bloque"> 					 					
	 					{{Form::label('fechaInicio','Fecha de inicio:')}}
	 					<input name="fechaInicio" id="fechaInicio2" type="date" class="required" data-role="datebox"
	   						data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
	 				</div>
	 				<div class="ui-block-b bloque">
	 					{{Form::label('fechaFinal','Fecha de término:')}}
	 					<input name="fechaFinal" id="fechaFinal" type="date" data-role="datebox" class="required" 
	   						data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
	 				</div> 				
	 			</div>
	 			<div data-role="fieldcontain">
	 				{{Form::label('tecnico','Técnico:')}}
	 				{{Form::select('tecnico',$tecnicos, array('data-mini'=>'true'))}}
	 			</div>
	 			<div data-role="controlgroup" data-type="horizontal" align="center">
	 				{{Form::submit('Consultar')}}
	 			</div>
 			{{Form::close()}}
 		</li>

 		{{--Ordenes de trabajo entregados por un  vendedor--}}
 		<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-in set="false" data-corners="false">
 			<h2>Ordenes de trabajo entregados por un vendedor</h2>
 			{{Form::open(array('url'=>'informe/ordenEntreg','method'=>'GET','id'=>'formOrndenEntgd'))}}
 				<div class="ui-grid-a ui-responsive">
	 				<div class="ui-block-a bloque"> 					 					
	 					{{Form::label('fechaInicio','Fecha de inicio:')}}
	 					<input name="fechaInicio" id="fechaInicio3" type="date" class="required" data-role="datebox"
	   						data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
	 				</div>
	 				<div class="ui-block-b bloque">
	 					{{Form::label('fechaFinal','Fecha de término:')}}
	 					<input name="fechaFinal" id="fechaFinal" type="date" data-role="datebox" class="required" 
	   						data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
	 				</div> 				
	 			</div>
	 			<div data-role="fliedcontain">
	 				{{Form::label('vendedor','Vendedor:')}}
	 				{{Form::select('vendedor',$vendedores,array('data-mini'=>'true'))}}
	 			</div>
	 			<div data-role="controlgroup" data-type="horizontal" align="center">
	 				{{Form::submit('Consultar')}}
	 			</div>
 			{{Form::close()}}
 		</li>

 		{{--Ordenes de trabajo entregados en una sucursal--}}
 		<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-in set="false" data-corners="false">
 			<h2>Ordenes de trabajo entregados en una sucursal</h2>
 			{{Form::open(array('url'=>'informe/entregadoSuc','method'=>'GET','id'=>'formOrdenEntgdSuc'))}}
 				<div class="ui-grid-a ui-responsive">
	 				<div class="ui-block-a bloque"> 					 					
	 					{{Form::label('fechaInicio','Fecha de inicio:')}}
	 					<input name="fechaInicio" id="fechaInicio4" type="date" class="required" data-role="datebox"
	   						data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
	 				</div>
	 				<div class="ui-block-b bloque">
	 					{{Form::label('fechaFinal','Fecha de término:')}}
	 					<input name="fechaFinal" id="fechaFinal" type="date" data-role="datebox" class="required" 
	   						data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
	 				</div> 				
	 			</div>
	 			<div data-role="fliedcontain">
	 				{{Form::label('sucursal','Sucursal:')}}
	 				{{Form::select('sucursal',$sucursal,array('data-mini'=>'true'))}}
	 			</div>
	 			<div data-role="controlgroup" data-type="horizontal" align="center">
	 				{{Form::submit('Consultar')}}
	 			</div>
 			{{Form::close()}}
 		</li>

 		{{--Ordenes de trabajo reparados poe un técnico y entregados--}}
 		<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-in set="false" data-corners="false">
 			<h2>Equipos reparados por un técnico y entregados</h2>
 			{{Form::open(array('url'=>'informe/ordenEntTecnico','method'=>'GET','id'=>'OrdenRepEntregadaTec'))}}
 			<div class="ui-grid-a ui-responsive">
	 			<div class="ui-block-a bloque"> 					 					
	 				{{Form::label('fechaInicio','Fecha de inicio:')}}
	 				<input name="fechaInicio" id="fechaInicio5" type="date" class="required" data-role="datebox"
	   					data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
	 			</div>
	 			<div class="ui-block-b bloque">
	 				{{Form::label('fechaFinal','Fecha de término:')}}
	 				<input name="fechaFinal" id="fechaFinal" type="date" data-role="datebox" class="required" 
	   					data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
	 			</div> 				
	 		</div>
	 		<div data-role="fieldcontain">
	 			{{Form::label('tecnico','Técnico:')}}
	 			{{Form::select('tecnico',$tecnicos, array('data-mini'=>'true'))}}
	 		</div>
	 		<div data-role="controlgroup" align="center" data-type="horizontal">
	 			{{Form::submit('Consultar')}}
	 		</div>
	 		{{Form::close()}}
 		</li>
 	</ul>
 @endif
 @stop

 {{--sección secundario--}}
 @section('secundario')
 	<p>Bienvenido <strong>{{Auth::user()->nombres}}</strong></p>
	<ul data-role="listview" class="ui-listview-outer" data-inset="true">
		<li data-role="list-divider">Opciones</li>
		<li data-icon="false">{{ HTML::link('empresa', 'Empresa'); }}</li>
		<li data-icon="false">{{ HTML::link('sucursal', 'Sucursales'); }}</li>
		<li data-icon="false">{{ HTML::link('user', 'Usuarios'); }}</li>			
		<li data-icon="false">{{ HTML::link('cliente', 'Clientes'); }}</li>
		<li data-icon="false">{{ HTML::link('equipo', 'Equipos'); }}</li>
		<li data-icon="false">{{ HTML::link('presupuesto', 'Presupuestos'); }}</li>		
		<li data-icon="false" class ="fondo">Informes</li>					
		<li data-icon="false">{{ HTML::link('logout', 'Cerrar sesión'); }}</li>					
	</ul>	
 @stop

 {{--scripts--}}
 @section('scripts')
 	{{HTML::script('js/mensajes.js')}} 	
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposInformeIngreso.js');}}
 @stop
 {{--Datebox--}}
 @section('datebox')
 	{{HTML::script('js/validadores/jqm-datebox-1.4.2.core.js');}}
	{{HTML::script('js/validadores/jqm-datebox-1.4.2.mode.calbox.js');}}
 @stop
