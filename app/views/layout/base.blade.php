<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	@section('titulo')
		<title>Sistema de reparación de equipos informáticos de Sisprocompu</title>
	@show
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	{{HTML::style('css/tema/sispro.css');}}
	{{HTML::style('css/tema/jquery.mobile.icons.min.css');}}
	{{HTML::style('http://code.jquery.com/mobile/1.4.2/jquery.mobile.structure-1.4.2.min.css');}}
	{{HTML::script('http://code.jquery.com/jquery-1.9.1.min.js');}}
	{{HTML::script('http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js');}} 	 	
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



