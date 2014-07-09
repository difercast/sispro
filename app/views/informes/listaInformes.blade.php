@extends('layout.base')
{{--Título--}}
@section('titulo')
	<title>Informes</title>
@stop
{{--head--}}
{{--header--}}
@section('header')
	{{ HTML::link('admin','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'home','data-iconpos'=>'notext')); }}
@stop
{{--principal--}}
@section('principal')
	<h1>Informes estadísticos</h1>	
	<p>Por favor, seleccione el informe que desea consultar</p>
	<div class="lista">
		<ul data-role="listview" class="ui-listview-outer" data-inset="true">			
			<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-inset="false">
	    		<h2>Equipos ingresados a la empresa en un periodo de tiempo</h2>
	    		{{ Form::open(array('url'=>'informe/ingresoEquipos','id'=>'formIngreso'))}}	    		
	    			<div class="ui-grid-a ui-responsive">
						<div class="ui-block-a">
							<div data-role="fieldcontain">
								{{Form::label('fechaInicio','Inicio:')}}
								<input name="fechaInicio" id="fechaInicio" type="date" data-role="datebox"
   									data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>					
							</div>
						</div>
						<div class="ui-block-b">
							<div data-role="fieldcontain">
								{{Form::label('fechaFinal','Término:')}}
								<input name="fechaFinal" id="fechaFinal" type="date" data-role="datebox"
   									data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>	
							</div>
						</div>
					</div>
					<div data-role="fieldcontain">
						{{Form::label('sucursal','Sucursal:')}}
						{{Form::select('sucursal',$sucursal,array('data-mini'=>'true'))}}						
					</div>
					<div data-role="controlgroup" data-type="horizontal" align="center">
						{{Form::submit('Ver')}}
					</div>
	    		{{Form::close()}}	    		
			</li> 
			<li data-icon="false">{{HTML::link('#', 'Equipos reparados por técnico')}}</li>
			<li data-icon="false">{{HTML::link('#', 'Equipos entregados por  vendedor')}}</li>
			<li data-icon="false">{{HTML::link('#', 'Equipos sin revisar')}}</li>
			<li data-icon="false">{{HTML::link('#', 'Equipos dados de baja')}}</li>			
		</ul>
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