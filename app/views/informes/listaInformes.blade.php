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
			<li data-icon="false">{{HTML::link('informe/ingreso','Equipos ingresados a la empresa en un periodo de tiempo')}}</li>
			<li data-icon="false">{{HTML::link('#', 'Equipos reparados por técnico')}}</li>
			<li data-icon="false">{{HTML::link('#', 'Equipos entregados por  vendedor')}}</li>
			<li data-icon="false">{{HTML::link('#', 'Equipos sin revisar')}}</li>
			<li data-icon="false">{{HTML::link('#', 'Equipos dados de baja')}}</li>			
		</ul>
	</div>
@stop