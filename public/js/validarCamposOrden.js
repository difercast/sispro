//JavaScript document

function validarCamposOrden(){
	//Guardamos los datos del formulario en variables
	var integrante = document.getElementById("integrante").value;
	var fechaIngreso = document.getElementById("fechaIngreso").value;
	var horaIngreso = document.getElementById("horaIngreso").value;
	var nombreCliente = document.getElementById("nombreCliente").value;
	var cedulaCliente = document.getElementById("cedulaCliente").value;
	var direccionCliente = document.getElementById("direccionCliente").value;
	var tipoEquipo = document.getElementById("tipoEquipo").value;
	var marcaEquipo = document.getElementById("marcaEquipo").value;
	var modeloEquipo = document.getElementById("modeloEquipo").value;
	var serieEquipo = document.getElementById("serieEquipo").value;
	var problemaEquipo = document.getElementById("problemaEquipo").value;
	var tecnico = document.getElementById("tecnico").value;
	
	//Verficamos los campos del formulario
	if( integrante == null || integrante.length == 0 || /^\s+$/.test(integrante) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("integrante").focus();
		return false;
	}else if( fechaIngreso == null || fechaIngreso.length == 0 || /^\s+$/.test(fechaIngreso) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("fechaIngreso").focus();
		return false;
	}else if( horaIngreso == null || horaIngreso.length == 0 || /^\s+$/.test(horaIngreso) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("horaIngreso").focus();
		return false;
	}else if( nombreCliente == null || nombreCliente.length == 0 || /^\s+$/.test(nombreCliente) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("nombreCliente").focus();
		return false;
	}else if( cedulaCliente == null || cedulaCliente.length == 0 || /^\s+$/.test(cedulaCliente) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("cedulaCliente").focus();
		return false;
	}else if( direccionCliente == null || direccionCliente.length == 0 || /^\s+$/.test(direccionCliente) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("direccionCliente").focus();
		return false;
	}else if( tipoEquipo == null || tipoEquipo.length == 0 || /^\s+$/.test(tipoEquipo) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("tipoEquipo").focus();
		return false;
	}else if( marcaEquipo == null || marcaEquipo.length == 0 || /^\s+$/.test(marcaEquipo) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("marcaEquipo").focus();
		return false;
	}else if( modeloEquipo == null || modeloEquipo.length == 0 || /^\s+$/.test(modeloEquipo) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("modeloEquipo").focus();
		return false;
	}else if( serieEquipo == null || serieEquipo.length == 0 || /^\s+$/.test(serieEquipo) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("serieEquipo").focus();
		return false;
	}else if( problemaEquipo == null || problemaEquipo.length == 0 || /^\s+$/.test(problemaEquipo) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("problemaEquipo").focus();
		return false;
	}else if( tecnico == null || tecnico.length == 0 || /^\s+$/.test(tecnico) ) {
		alert("Por favor, ingrese todos los campos");
		document.getElementById("tecnico").focus();
		return false;
	}
	return true;
}