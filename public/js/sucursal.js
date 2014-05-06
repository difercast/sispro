//JavaScript document

//Validar vacios e incorrectos
function validar(){
	var tipo = document.getElementById("tipo").value;
	var ciudad = document.getElementById("ciudad").value;
	var direccion = document.getElementById("direccion").value;
	var telefono = document.getElementById("telefono").value;
	var celular = document.getElementById("celular").value;
	var email = document.getElementById("email").value;
	
	if(ciudad == null || ciudad.length == 0 || /^\s+$/.test(ciudad)){
		document.getElementById("ciudad").focus();
		alert ("Por favor, ingrese todos los campos");
		return false;
	}else if(tipo == null || tipo.length == 0 || /^\s+$/.test(tipo)){
		document.getElementById("tipo").focus();
		alert ("Por favor, ingrese todos los campos");
		return false;		
	}else if(direccion == null || direccion.length == 0 || /^\s+$/.test(direccion)){
		document.getElementById("direccion").focus();
		alert ("Por favor, ingrese todos los campos");
		return false;
	}else if(telefono == null || telefono.length == 0 || /^\s+$/.test(telefono)){
		document.getElementById("telefono").focus();
		alert ("Por favor, ingrese todos los campos");
		return false;
	}else if(celular == null || celular.length == 0 || /^\s+$/.test(celular)){
		document.getElementById("celular").focus();
		alert ("Por favor, ingrese todos los campos");
		return false;
	}else if(email == null || email.length == 0 || /^\s+$/.test(email)){
		document.getElementById("email").focus();
		alert ("Por favor, ingrese todos los campos");
		return false;
	}else if(celular.substring(0,2) != "09" || isNaN(celular) || celular.length != 10){
		document.getElementById("celular").value="";
		document.getElementById("celular").focus();
		alert ("Por favor, verifique la información ingresada");
		return false;
	}else if(isNaN(telefono) || telefono.length != 7){
		document.getElementById("telefono").value="";
		document.getElementById("telefono").focus();
		alert ("Por favor, verifique la información ingresada");
		return false;
	}
	
	return true;
}

//Validar vacios e incorrectos modificar sucursal
function validarmod(){
	var ciudad = document.getElementById("ciudad").value;
	var direccion = document.getElementById("direccion").value;
	var telefono = document.getElementById("telefono").value;
	var celular = document.getElementById("celular").value;
	var email = document.getElementById("email").value;
	
	if(ciudad == null || ciudad.length == 0 || /^\s+$/.test(ciudad)){
		document.getElementById("ciudad").focus();
		alert ("Por favor, ingrese todos los campos");
		return false;
	}else if(direccion == null || direccion.length == 0 || /^\s+$/.test(direccion)){
		document.getElementById("direccion").focus();
		alert ("Por favor, ingrese todos los campos");
		return false;
	}else if(telefono == null || telefono.length == 0 || /^\s+$/.test(telefono)){
		document.getElementById("telefono").focus();
		alert ("Por favor, ingrese todos los campos");
		return false;
	}else if(celular == null || celular.length == 0 || /^\s+$/.test(celular)){
		document.getElementById("celular").focus();
		alert ("Por favor, ingrese todos los campos");
		return false;
	}else if(email == null || email.length == 0 || /^\s+$/.test(email)){
		document.getElementById("email").focus();
		alert ("Por favor, ingrese todos los campos");
		return false;
	}else if(celular.substring(0,2) != "09" || isNaN(document.getElementById("celular").value) || celular.length != 10){
		document.getElementById("celular").value="";
		document.getElementById("celular").focus();
		alert ("Por favor, verifique la información ingresada");
		return false;
	}else if(isNaN(document.getElementById("telefono").value) || telefono.length != 7){
		document.getElementById("telefono").value="";
		document.getElementById("telefono").focus();
		alert ("Por favor, verifique la información ingresada");
		return false;
	}
	
	return true;

}