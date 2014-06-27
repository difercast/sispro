<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	@section('titulo')
		<title>Sistema de reparación de equipos informáticos de Sisprocompu</title>
	@show
	<meta name="viewport" content="width=device-width, initial-scale=1" />	
	{{HTML::style('css/normalize.css');}}	
	<link href="//fonts.googleapis.com/css?family=Roboto:100italic,100,300italic,300,400italic,400,500italic,500,700italic,700,900italic,900" rel="stylesheet" type="text/css">
	
	{{HTML::style('css/tema/jquery.mobile.icons.min.css');}}
	{{HTML::style('css/jquery.mobile-1.4.2.min.css')}}
	{{HTML::style('css/tema/sispro.css');}}	
	@yield('head')
</head>
<body>
	<div data-role="page" id="pag">
		<div data-role="header">
			<div class="logo">
				<img src="images/logo.png" alt="Sisprocompu"/>
			</div>
			<div class="titular">
					<h1 class="titulo">Sistema de gestión de reparaciones</h1>
			</div>
			@yield('header')									
		</div>
		<div data-role="content">
			<div class="primario">
				@yield('primario')
			</div>
			<div class="secundario">
				@yield('secundario')
			</div>
		</div>		
		@yield('paneles')	
	</div>
</body>
</html>
	{{HTML::script('js/jquery.js')}}
	{{HTML::script('js/jquery.mobile-1.4.2.js')}}
@yield('scripts')




