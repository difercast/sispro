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
 	{{ HTML::link('admin','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
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
 		<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-in set="false">
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
 	</ul>
 @endif
 @stop

 {{--scripts--}}
 @section('scripts')
 	{{HTML::script('js/mensajes.js')}}
 	{{HTML::script('js/validadores/jqm-datebox-1.4.2.core.js');}}
	{{HTML::script('js/validadores/jqm-datebox-1.4.2.mode.calbox.js');}}
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposInformeIngreso.js');}}
 @stop