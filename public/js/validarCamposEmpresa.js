// JavaScript Document

//Validar campos vacios
function validar(){
	var comercial = document.getElementById("razonComercial").value;
	var social = document.getElementById("razonSocial").value;
	var ruc = document.getElementById("ruc").value;
	var act = document.getElementById("actividad").value;
	
	if( comercial == null || comercial.length == 0 || /^\s+$/.test(comercial) ){
		alert("Por favor, ingrese todos los campos");
		document.getElementById("razonComercial").focus();
		return false;
	}else if( social == null || social.length == 0 || /^\s+$/.test(social) ){
		alert("Por favor, ingrese todos los campos");
		document.getElementById("razonSocial").focus();
		return false;
	}else if( ruc == null || ruc.length == 0 || /^\s+$/.test(ruc) ){
		alert("Por favor, ingrese todos los campos");
		document.getElementById("ruc").focus();
		return false;
	}else if( act == null || act.length == 0 || /^\s+$/.test(act) ){
		alert("Por favor, ingrese todos los campos");
		document.getElementById("actividad").focus();
		return false;
	}
	return true;
}