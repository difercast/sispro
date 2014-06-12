$(document).ready(function(){
	//Validar que el campo ingresado solo contenga letras
	$.validator.addMethod('letters', function(val, element, param){
		return val.match(new RegExp("." + param + "$"));
	});
	//Método para validar que los datos sean alfanuméricos
	$.validator.addMethod('alphaNumeric', function(val, element) {
		return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(val);
	}, 'El campo debe contener valores alfanuméricos');
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
				maxlength: 10
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
				maxlength: 'Debe ingresar 10 dígitos'
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