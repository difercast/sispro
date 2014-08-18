$(document).bind('pageinit',function(){
	//Validar que el campo ingresado solo contenga letras
	$.validator.addMethod('letters', function(val, element, param){
		return val.match(new RegExp("." + param + "$"));
	});
	//Método para validar que los datos sean alfanuméricos
	$.validator.addMethod('alphaNumeric', function(val, element) {
		return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(val);
	}, 'El campo debe contener valores alfanuméricos');

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

	$('#formUser').validate({
		rules:{
			apellidos: {
				required: true,
				letters: '[a-zA-Z]+'
			},
			nombres:{
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
				required: true,
				email: true
			},
			username:{
				required: true,
				alphaNumeric: true
			},
			password:{
				required: true,
				alphaNumeric: true
			},
			password2:{
				required: true,
				alphaNumeric: true,
				equalTo: "#password"
			}
		},
		messages:{
			apellidos: {
				required: 'Campo requerido',
				letters: 'El campo debe conterner solo letras'
			},
			nombres:{
				required: 'Campo requerido',
				letters: 'El campo debe conterner solo letras'
			},
			cedula:{
				required: 'Campo requerido',
				number: 'Debe ingresar solo números',
				minlength: 'Debe ingresar 10 dígitos',
				maxlength: 'Debe ingresar 10 dígitos',
				validaCI: 'El número de cédula ingresado es incorrecto'
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
			},
			username:{
				required: 'Campo requerido',
				alphaNumeric: 'El campo debe conterner valores alfanuméricos'
			},
			password:{
				required: 'Campo requerido',
				alphaNumeric: 'El campo debe conterner valores alfanuméricos'	
			},
			password2:{
				required: 'Campo requerido',
				alphaNumeric: 'El campo debe conterner valores alfanuméricos',
				equalTo: 'Las contraseñas no coinciden'
			}
		}
	});
});