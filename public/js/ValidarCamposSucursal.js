// JavaScript Document

//Validar elementos vacios e incorrectos
function validar(){
	var tipo = document.getElementById("tipo").value
	var ciudad = document.getElementById("ciudad").value;
	var direccion = document.getElementById("direccion").value;
	var telefono = document.getElementById("telefono").value;
	var celular = document.getElementById("celular").value;
	var email = document.getElementById("email").value;
	
	if(tipo == null || tipo.length == 0 || /^\s+$/.test(tipo)){
		document.getElementById("tipo").focus();
		alert ("por favor ingrese todos los campos");
		return false;
	}else if(ciudad == null || ciudad.length == 0 || /^\s+$/.test(ciudad)){
		document.getElementById("ciudad").focus();
		alert ("por favor ingrese todos los campos");
		return false;
	}else if(direccion == null || direccion.length == 0 || /^\s+$/.test(direccion)){
		document.getElementById("direccion").focus();
		alert ("por favor ingrese todos los campos");
		return false;
	}else if(telefono == null || telefono.length == 0 || /^\s+$/.test(telefono)){
		document.getElementById("telefono").focus();
		alert ("por favor ingrese todos los campos");
		return false;
	}else if(celular == null || celular.length == 0 || /^\s+$/.test(celular)){
		document.getElementById("celular").focus();
		alert ("por favor ingrese todos los campos");
		return false;
	}else if(email == null || email.length == 0 || /^\s+$/.test(email)){
		document.getElementById("email").focus();
		alert ("por favor ingrese todos los campos");
		return false;
	}else if(isNaN(celular) || celular.substring(0,2) !== "09" || celular.length !== 10 ){		
		document.getElementById("celular").value ="";
		document.getElementById("celular").focus();
		alert ("El campo celular está mal escrito");
		return false;
	}else if(isNaN(telefono) || telefono.length < 7){		
		document.getElementById("telefono").value ="";
		document.getElementById("telefono").focus();
		alert ("El campo telefono está mal escrito");
		return false;
	}else if(tipo !== "Principal" || tipo !== "Sucursal"){
		document.getElementById("sucursal").value="";
		document.getElementById("sucursal").focus();
		alert("Ingrese un nombre de entidad correcto");
	}
	return true;
}


//Validar vacios e incorrecto modificar
function validarMod(){		
	var ciudad = document.getElementById("ciudad").value;
	var direccion = document.getElementById("direccion").value;
	var telefono = document.getElementById("telefono").value;
	var celular = document.getElementById("celular").value;
	var email = document.getElementById("email").value;
	
	if(ciudad == null || ciudad.length == 0 || (/^\s+$/.test(ciudad))){
		document.getElementById("ciudad").focus();
		alert ("por favor ingrese todos los campos");
		return false;
	}else if(direccion == null || direccion.length == 0 || (/^\s+$/.test(direccion))){
		document.getElementById("direccion").focus();
		alert ("por favor ingrese todos los campos");
		return false;
	}else if(telefono == null || telefono.length == 0 || (/^\s+$/.test(telefono))){
		document.getElementById("telefono").focus();
		alert ("por favor ingrese todos los campos");
		return false;
	}else if(celular == null || celular.length == 0 || (/^\s+$/.test(celular))){
		document.getElementById("celular").focus();
		alert ("por favor ingrese todos los campos");
		return false;
	}else if(email == null || email.length == 0 || (/^\s+$/.test(email))){
		document.getElementById("email").focus();
		alert ("por favor ingrese todos los campos");
		return false;
	}else if(isNaN(celular) || celular.substring(0,2) !== "09" || celular.length !== 10 ){		
		document.getElementById("celular").value ="";
		document.getElementById("celular").focus();
		alert ("El campo celular está mal escrito");
		return false;
	}else if(isNaN(telefono) || telefono.length < 7){		
		document.getElementById("telefono").value ="";
		document.getElementById("telefono").focus();
		alert ("El campo telefono está mal escrito");
		return false;
	}
	return true;
}
