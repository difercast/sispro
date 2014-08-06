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
	    		{{ Form::open(array('url'=>'informes/ingreso','id'=>'formIngreso'))}}	    		
	    			<div class="ui-grid-a ui-responsive">
						<div class="ui-block-a bloque">
							<div data-role="fieldcontain">
								{{Form::label('fechaInicio','Inicio:')}}
								<input name="fechaInicio" id="fechaInicio" type="date" data-role="datebox"
   									data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>	
							</div>
						</div>
						<div class="ui-block-b bloque">
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
			{{--Ingresos de órdenes por usuario--}}
			<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-inset="false">
	    		<h2>Equipos ingresados a la empresa en un periodo de tiempo por usuario</h2>
	    		{{ Form::open(array('url'=>'informe/ingresoEquiposUser','id'=>'formIngresoUser'))}}	    		
	    			<div class="ui-grid-a ui-responsive">
						<div class="ui-block-a bloque">
							<div data-role="fieldcontain">
								{{Form::label('fechaInicio','Inicio:')}}
								<input name="fechaIni" id="fechaIni" type="date" required data-role="datebox"
   									data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>					
							</div>
						</div>
						<div class="ui-block-b bloque">
							<div data-role="fieldcontain">
								{{Form::label('fechafinal','Término:')}}
								<input name="fechaFin" id="fechaFin" type="date" required data-role="datebox"
   									data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>
							</div>
						</div>
						
					</div>
					<div data-role="fieldcontain">
						{{Form::label('user','Usuario:')}}
						{{Form::select('user',$user,array('data-mini'=>'true'))}}						
					</div>
					<div data-role="controlgroup" data-type="horizontal" align="center">
						{{Form::submit('Ver')}}
					</div>
	    		{{Form::close()}}	    		
			</li> 
			{{--Equipos reparados--}}
			<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-inset="false">
	    		<h2>Reparaciones terminadas por técnico</h2>
	    		{{ Form::open(array('url'=>'informe/reparadosTecnico','id'=>'reparacionTerminadaTecnico'))}}	    		
	    			<div class="ui-grid-a ui-responsive">
						<div class="ui-block-a bloque">
							<div data-role="fieldcontain">
								{{Form::label('fechaInicio','Inicio:')}}
								<input name="inicio" id="inicio" type="date" data-role="datebox"
   									data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>					
							</div>
						</div>
						<div class="ui-block-b bloque">
							<div data-role="fieldcontain">
								{{Form::label('fechafinal','Término')}}
								<input name="fFinal" id="fFinal" type="date" data-role="datebox"
								data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d",
								"useNewStyle":true}'/>
							</div>
						</div>
						
					</div>
					<div data-role="fieldcontain">
						{{Form::label('tecnicos','Técnico:')}}
						{{Form::select('tecnicos',$tecnicos,array('data-mini'=>'true'))}}						
					</div>
					<div data-role="controlgroup" data-type="horizontal" align="center">
						{{Form::submit('Ver')}}
					</div>
	    		{{Form::close()}}	    		
			</li>
			{{--Equipos sin revisar--}}
			<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-inset="false">
	    		<h2>Equipos sin revisar</h2>
	    		{{ Form::open(array('url'=>'informe/sinRevisar','id'=>'sinRevisar'))}}	    		
	    			<div class="ui-grid-a ui-responsive">
						<div class="ui-block-a bloque">
							<div data-role="fieldcontain">
								{{Form::label('fechaInicio','Inicio:')}}
								<input name="inicial" id="inicial" type="date" data-role="datebox"
   									data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>					
							</div>
						</div>
						<div class="ui-block-b bloque">
							<div data-role="fieldcontain">
								{{Form::label('fechafinal','Término')}}
								<input name="terminado" id="terminado" type="date" data-role="datebox"
								data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d",
								"useNewStyle":true}'/>
							</div>
						</div>						
					</div>								
					<div data-role="controlgroup" data-type="horizontal" align="center">
						{{Form::submit('Ver')}}
					</div>
	    		{{Form::close()}}	    		
			</li>
			{{--Equipos entregados por vendedor--}}
			<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-inset="false">
	    		<h2>Órdenes de trabajo entregados por vendedor</h2>
	    		{{ Form::open(array('url'=>'informe/entregadosPorVendedor','id'=>'entregadosVendedor'))}}
	    			<div class="ui-grid-a ui-responsive">
						<div class="ui-block-a bloque">
							<div data-role="fieldcontain">
								{{Form::label('fechaInicio','Inicio:')}}
								<input name="principio" id="principio" type="date" data-role="datebox"
   									data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>					
							</div>
						</div>
						<div class="ui-block-b bloque">
							<div data-role="fieldcontain">
								{{Form::label('fechafinal','Término')}}
								<input name="termino" id="termino" type="date" data-role="datebox"
								data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d",
								"useNewStyle":true}'/>
							</div>
						</div>						
					</div>
					<div data-role="fieldcontain">
						{{Form::label('vendedores','Vendedor:')}}
						{{Form::select('vendedores',$vendedores,array('data-mini'=>'true'))}}						
					</div>					
					<div data-role="controlgroup" data-type="horizontal" align="center">
						{{Form::submit('Ver')}}
					</div>
	    		{{Form::close()}}	    		
			</li>
			{{--Equipos reparados por técnico entregados por vendedor--}}
			<li data-role="collapsible" data-iconpos="right" data-shadow="false" data-inset="false">
	    		<h2>Órdenes de trabajo reparados por técnico y entregados</h2>
	    		{{ Form::open(array('url'=>'informe/repTecnicoEntr','id'=>'repTecnicoEntr'))}}
	    			<div class="ui-grid-a ui-responsive">
						<div class="ui-block-a bloque">
							<div data-role="fieldcontain">
								{{Form::label('fechaInicio','Inicio:')}}
								<input name="ini" id="ini" type="date" data-role="datebox"
   									data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d","useNewStyle":true}'/>					
							</div>
						</div>
						<div class="ui-block-b bloque">
							<div data-role="fieldcontain">
								{{Form::label('fechafinal','Término')}}
								<input name="fin" id="fin" type="date" data-role="datebox"
								data-options='{"mode": "calbox","overrideDateFormat":"%Y-%m-%d",
								"useNewStyle":true}'/>
							</div>
						</div>						
					</div>
					<div data-role="fieldcontain">
						{{Form::label('tecnicos','Técnico:')}}
						{{Form::select('tecnicos',$tecnicos,array('data-mini'=>'true'))}}						
					</div>				
					<div data-role="controlgroup" data-type="horizontal" align="center">
						{{Form::submit('Ver')}}
					</div>
	    		{{Form::close()}}	    		
			</li>  					
		</ul>
	</div>
@stop
{{--Scripts--}}
@section('scripts')
	{{--Script--}}
	{{HTML::script('js/validadores/jquery-validation-1.12.0/dist/jquery.validate.js');}}
	{{HTML::script('js/validadores/camposInformeIngreso.js');}}
	{{HTML::script('js/validadores/jqm-datebox-1.4.2.core.js');}}
	{{HTML::script('js/validadores/jqm-datebox-1.4.2.mode.calbox.js');}}
@stop




{{--
	{{HTML::script('js/validadores/camposInfIngUser.js');}}
	{{HTML::script('js/validadores/camposEquiposRep.js');}}
	{{HTML::script('js/validadores/camposSinRevisar.js');}}
	{{HTML::script('js/validadores/camposEntregados.js');}}
	{{HTML::script('js/validadores/camposEntregadoTecnico.js');}}
--}}