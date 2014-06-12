$(document).ready(function(){
	//Validar que el campo ingresado solo contenga letras
	$.validator.addMethod('letters', function(val, element, param){
		return val.match(new RegExp("." + param + "$"));
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
			}
		}
	});
});