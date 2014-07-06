@extends('layout.base')
{{--titulo--}}
@section('titulo')
	<title>Equipos ingresados a la empresa</title>
@stop
{{--head--}}
@section('head')

@stop
{{--header--}}
@section('header')
	{{ HTML::link('informe','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Principal--}}
@section('principal')
	<h1>Equipos ingresados a la empresa</h1>	
	<div class="listas">
		{{Form::open(array('url'=>'#','id'=>'formIngreso'))}}
			<div data-role="fieldcontain" class="field">
				{{Form::label('fechaInicio','Fecha de inicio:')}}
				<input name="fechaInicio" id="fechaInicio" type="date" data-mini="true" data-role="datebox"
   				data-options='{"mode": "calbox","overrideDateFormat":"%d/%m/%Y","useNewStyle":true}'/>			
			</div>
			<div data-role="fieldcontain" class="field">
				{{Form::label('fechaTerminado','Fecha de terminado:')}}
				<input name="fechaTerminado" id="fechaTerminado" type="date" data-mini="true" data-role="datebox"
   				data-options='{"mode": "calbox","overrideDateFormat":"%d/%m/%Y","useNewStyle":true}'/>
			</div>
			<div data-role="fieldcontain" class="field">
				{{Form::label('sucursal','Sucursal:')}}
				{{Form::select('sucursal',$sucursal,array('data-mini'=>'true'))}}			
			</div>
			<div data-role="controlgroup" data-type="horizontal" align="center">
				{{Form::submit('Buscar')}}
			</div>
		{{Form::close()}}
	</div>
@stop
{{--Scripts--}}
@section('scripts')
	{{--Script--}}
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposInformeIngreso.js');}}
	{{HTML::script('js/validadores/jqm-datebox-1.4.2.core.js')}}
	{{HTML::script('js/validadores/jqm-datebox-1.4.2.mode.calbox.js')}}
@stop

