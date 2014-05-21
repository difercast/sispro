<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	@section('titulo')
		<title>Sistema de reparación de equipos informáticos de Sisprocompu</title>
	@show
	<meta name="viewport" content="width=device-width, initial-scale=1" />   
</head>
<body>
	<div data-role="page">
		<div data-role="header">
			<div class="logo">
				<img src="images/logo.png" />
			</div>
			<div class="titular">
					<h1 class="titulo">Sistema de gestión de reparaciones de equipos informáticos</h1>
			</div>									
		</div>
		<div data-role="content">
			<div class="primario">
				@yield('primario')
			</div>
			<div class="secundario">
				@yield('secundario')
			</div>
		</div>		
	</div>
</body>
</html>


