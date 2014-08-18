<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	@section('titulo')
		<title>Sistema de reparación de equipos informáticos de Sisprocompu</title>
	@show
	<meta name="viewport" content="width=device-width, initial-scale=1" />		
	{{HTML::style('css/normalize.css')}}
	{{HTML::style('css/jquery.mobile-1.4.2.min.css')}}	
	{{HTML::style('css/sispro/sispro.css');}}	
	{{HTML::style('css/listas.css')}}
	{{HTML::style('css/jqm-datebox-1.4.2.css');}}
	{{HTML::style('css/paginacion.css')}}
	@yield('head')
	{{HTML::style('css/sispro/jquery.mobile.icons.min.css');}}		
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<div data-role="page" id="pag">
		<div data-role="header">
			<div class="titular">
					<h1 class="titulo">Sistema de administración y control de servicios de mantenimiento técnico</h1>
			</div>
			@yield('header')									
		</div>
		<div data-role="content" id="contenido" style="font-size: 90%;">
			<div class="principal">
				@yield('principal')
			</div>
			<div class="primario">
				@yield('primario')
			</div>
			<div class="secundario">
				@yield('secundario')
			</div>
			<div class="todo">
				@yield('todo')
			</div>
		</div>		
		@yield('paneles')						
		@yield('scripts')		
	</div>		
</body>
</html>
{{HTML::script('js/jquery.js');}}
{{HTML::script('js/jquery.mobile-1.4.2.js')}}


	
	







