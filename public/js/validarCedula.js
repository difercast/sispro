// JavaScript Document

//Sacar digito validador
function valida(){
	var ruc = document.getElementById("cedula").value;	
	var pares = parseInt(ruc.substring(1,2)) + parseInt(ruc.substring(3,4)) + parseInt(ruc.substring(5,6)) + parseInt(ruc.substring(7,8));
	//Agrupamos los impares
	var numero1 = (parseInt(ruc.substring(0,1))*2);
	if(numero1 > 9) {var numero1 = (numero1 - 9);}
	
	var numero3 = (parseInt(ruc.substring(2,3))*2);
	if(numero3 > 9) {var numero3 = (numero3 - 9);} 
	
	var numero5 = (parseInt(ruc.substring(4,5))*2);
	if(numero5 > 9) {var numero5 = (numero5 - 9);}
	
	var numero7 = (parseInt(ruc.substring(6,7))*2);
	if(numero7 > 9) {var numero7 = (numero7 - 9);}
	
	var numero9 = (parseInt(ruc.substring(8,9))*2);
	if(numero9 > 9) {var numero9 = (numero9 - 9);}
	
	var impares = numero1 + numero3 + numero5 + numero7 + numero9;
	
	//Suma total
	var sumaTotal= (pares + impares);
	 
	//Primer digito de la suma
	var primerDigito = String(sumaTotal).substring(0,1);
	
	//Decena inmediata
	var decena = (parseInt(primerDigito) + 1) *10;
	
	//Obtenemos el digito validador
	var digitoValidador = decena - sumaTotal;
	
	//S el dígito validador es mayor que 10
	if(digitoValidador == 10){
		var digitoValidador = 0;
	}
	return digitoValidador;
}

//Validar CI
function validarCI(){
	var ruc = document.getElementById("cedula").value;
	var digitoRegion = parseInt(ruc.substring(0,2));
	var ultimoDigito = parseInt(ruc.substring(9,10));
	var digitoValidador = valida();
	if(ruc.length != 10){
		document.getElementById("cedula").value="";
		alert ("La cédula ingresada es incorrecta");
		return false;			
	}else if(digitoRegion < 1 || digitoRegion > 24){
		document.getElementById("cedula").value="";
		alert ("La cédula ingresada es incorrecta");
		return false;		
	}else if(ultimoDigito != digitoValidador){
		document.getElementById("cedula").value="";
		alert ("La cédula ingresada es incorrecta");
		return false;	
	}
	return true;
}