$(document).ready(function(event){
//$( document ).on( "pageinit", function( event ) {
    console.log('exito');
     $.validator.addMethod('letters', function(val, element, param){
		return val.match(new RegExp("." + param + "$"));
	});
     $.validator.addMethod('validaAct', function(value, element){
     	return (value.substr(0,2) == '00');
     });   
     $.validator.addMethod('validaRUC', function(val){
		var digitoRegion = val.substring(0,2);
		var tercerDigito = val.substring(2,3);
		var coeficientes = [2,1,2,1,2,1,2,1,2];
		var total = 0;
		var tresDigitos = val.substring(10);
		var ultimoDigito = val.charAt(9);
		if(val.length == 13 && tresDigitos == '001'){
			if( (digitoRegion >= 1 && digitoRegion <= 24) && tercerDigito < 6){
				for( i=0; i<coeficientes.length; i++ ){
					var valor = coeficientes[i]*parseInt(val.charAt(i));
					if(valor >= 10){
						valor = valor-9;
					}
					total = total + valor;
				}
				var primerDigito = String(total).charAt(0);
				var decena = (parseInt(primerDigito) + 1) *10;
				var digitoValidador = decena - total;
				if( digitoValidador == 10){ digitoValidador = 0;}
				if(digitoValidador == ultimoDigito){
					return true;
				}else return false;
			}else return false;
		}else return false;

	});
	$('#formEditar').validate({
		rules: {
			ruc: {
				required: true,
				number: true,					
				maxlength: 13,
				minlength: 13,
				validaRUC: true
			},
			razon_social:{
				required: true,
				letters: '[a-zA-Z]+'
			},
			razon_comercial:{
				required: true,
				letters: '[a-zA-Z]+'
			},
			actividad:{
				required: true,
				number: true,
				maxlength: 3,
				minlength: 3,
				validaAct: true
			}
		},
		messages:{
			ruc: {
				required: "Campo requerido",
				number: 'Ingresa un número',
				maxlength: 'El RUC debe contener 13 dígitos',
				minlength: 'El RUC debe contener 13 dígitos',
				validaRUC: 'El número de RUC ingresado en incorrecto'												
			},
			razon_social: {
				required: "Campo requerido",
				letters: 'El campo debe contener solo letras'
			},
			razon_comercial: {
				required: "Campo requerido",
				letters: 'El campo debe contener solo letras'
			},
			actividad: {
				required: "Campo requerido",
				number: 'Ingresa un número',
				maxlength: 'La actividad debe contener 3 dígitos',
				minlength: 'La actividad debe contener 3 dígitos',
				validaAct: 'Error en los datos'
			}
		}
	});
});

