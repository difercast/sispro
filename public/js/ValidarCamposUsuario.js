// JavaScript Document

//Validar que los campos estén llenados modificar usuarios
function validarVaciosMod(){
	var apellidos = document.getElementById("apellidos").value;
	var nombres = document.getElementById("nombres").value;
	var cedula = document.getElementById("cedula").value;
	var direccion = document.getElementById("direccion").value;
	var usuario = document.getElementById("usuario").value;	
	var telefono = document.getElementById("telefono").value;
	var celular = document.getElementById("celular").value;
	var email = document.getElementById("email").value;
	
	if(apellidos == null || apellidos.length == 0 || /^\s+$/.test(apellidos)){
		document.getElementById("apellidos").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(nombres == null || nombres.length == 0 || /^\s+$/.test(nombres)){
		document.getElementById("nombres").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(cedula == null || cedula.length == 0 || /^\s+$/.test(cedula)){
		document.getElementById("cedula").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(direccion == null || direccion.length == 0 || /^\s+$/.test(direccion)){
		document.getElementById("direccion").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(usuario == null || usuario.length == 0 || /^\s+$/.test(usuario)){
		document.getElementById("usuario").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(telefono != null){
		if(isNaN(telefono) || telefono.length != 7){
			document.getElementById("telefono").value="";
			document.getElementById("telefono").focus();
			alert ("Por favor, verifique la información ingresada");
			return false;
		}
	}else if(celular != null){
		if(celular.substring(0,2) != "09" || isNaN(celular) || celular.length != 10){
			document.getElementById("celular").value="";
			document.getElementById("celular").focus();
			alert ("Por favor, verifique la información ingresada");
			return false;
		}
	}else if(email != null){
		if( !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(email))){
			document.getElementById("email").value ="";
			document.getElementById("email").focus();
			alert ("El campo email está mal escrito")
			return false;
		}
	}	
	return true;
}


//Validar elementos vacios e incorrectos ingresar usuario
function validar(){
	var apellidos = document.getElementById("apellidos").value;
	var nombres = document.getElementById("nombres").value;
	var cedula = document.getElementById("cedula").value;
	var direccion = document.getElementById("direccion").value;
	var usuario = document.getElementById("usuario").value;
	var pass = document.getElementById("pass").value;
	var pass2 = document.getElementById("pass2").value;
	var telefono = document.getElementById("telefono").value;
	var celular = document.getElementById("celular").value;
	var email = document.getElementById("email").value;
	
	if(apellidos == null || apellidos.length == 0 || /^\s+$/.test(apellidos)){
		document.getElementById("apellidos").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(nombres == null || nombres.length == 0 || /^\s+$/.test(nombres)){
		document.getElementById("nombres").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(cedula == null || cedula.length == 0 || /^\s+$/.test(cedula)){
		document.getElementById("cedula").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(direccion == null || direccion.length == 0 || /^\s+$/.test(direccion)){
		document.getElementById("direccion").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(usuario == null || usuario.length == 0 || /^\s+$/.test(usuario)){
		document.getElementById("usuario").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(pass == null || pass.length == 0 || /^\s+$/.test(pass)){
		document.getElementById("pass").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(pass2 == null || pass2.length == 0 || /^\s+$/.test(pass2)){
		document.getElementById("pass2").focus();
		alert ("Por favor ingrese los campos requeridos");
		return false;
	}else if(telefono != null){
		if(isNaN(telefono) || telefono.length != 7){
			document.getElementById("telefono").value="";
			document.getElementById("telefono").focus();
			alert ("Por favor, verifique la información ingresada");
			return false;
		}
	}else if(celular != null){
		if(celular.substring(0,2) != "09" || isNaN(celular) || celular.length != 10){
			document.getElementById("celular").value="";
			document.getElementById("celular").focus();
			alert ("Por favor, verifique la información ingresada");
			return false;
		}
	}else if(email != null){
		if( !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(email))){
			document.getElementById("email").value ="";
			document.getElementById("email").focus();
			alert ("El campo email está mal escrito")
			return false;
		}
	}	
	return true;
}
