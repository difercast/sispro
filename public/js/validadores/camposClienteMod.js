$( document ).on( "pageinit", function( event ) {
	console.log('éxito');
	$.validator.addMethod('letters', function(val, element, param){
		return val.match(new RegExp("." + param + "$"));
	});
	$.validator.addMethod('validaCI', function(val){
		var digitoRegion = val.substring(0,2);
		var tercerDigito = val.substring(2,3);
		var coeficientes = [2,1,2,1,2,1,2,1,2];
		var total = 0;
		var ultimoDigito = val.charAt(9);
		if(val.length == 10){
			if( (digitoRegion >= 1 && digitoRegion <= 24) && tercerDigito <= 6){
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
	$('#formCliente').validate({
		rules: {
			nombres: {
				required: true,
				letters: '[a-zA-Z]+'
			},
			cedula:{
				required: true,
				number: true,
				minlength: 10,
				maxlength: 10,
				validaCI: true
			},
			direccion:{
				required: true
			},
			telefono:{
				number: true,
				minlength: 7,
				maxlength: 7
			},
			celular:{
				number: true,
				minlength: 10,
				maxlength: 10
			},
			email:{
				email: true
			}			
		},
		messages: {
			nombres: {
				required: 'Campo requerido',
				letters: 'El campo debe contener solo letras'
			},
			cedula:{
				required: 'Campo requerido',
				number: 'Debe ingresar solo números',
				minlength: 'Debe ingresar 10 dígitos',
				maxlength: 'Debe ingresar 10 dígitos',
				validaCI: 'El número de céula ingresado es incorrecto'
			},
			direccion:{
				required: 'Campo requerido'
			},
			telefono:{
				number: 'Debe ingresar solo números',
				minlength: 'Debe ingresar 7 dígitos',
				maxlength: 'Debe ingresar 7 dígitos'
			},
			celular:{
				number: 'Debe ingresar solo números',
				minlength: 'Debe ingresar 10 dígitos',
				maxlength: 'Debe ingresar 10 dígitos'
			},
			email:{
				required: 'Campo requerido',
				email: 'Debe ingresar un email correcto'
			}
		}
	});
});