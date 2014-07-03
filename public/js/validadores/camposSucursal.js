$( document ).on( "pageinit", function( event ) {
//$(document).ready(function(){
	//Validar que el campo ingresado solo contenga letras
	$.validator.addMethod('letters', function(val, element, param){
		return val.match(new RegExp("." + param + "$"));
	});
	$('#formSucursal').validate({
		rules: {
			provincia: {
				required: true
			},
			ciudad: {
				required: true,
				letters: '[a-zA-Z]+'
			},
			direccion: {
				required: true
			},
			telefono: {
				required: true,
				number: true,
				maxlength: 7,
				minlength: 7,
			},
			celular: {
				required: true,
				number: true,
				maxlength: 10,
				minlength: 10
			},
			email:{
				required: true,
				email: true
			}
		},
		messages: {
			provincia: {
				required: 'Campo requerido'
			},
			ciudad: {
				required: 'Campo requerido',
				letters: 'El campo debe contener solo letras'
			},
			direccion:{
				required: 'Campo requerido'
			},
			telefono: {
				required: 'Campo requerido',
				number: 'El campo debe ser un número',
				maxlength: 'El teléfono debe contener 7 caracteres',
				minlength: 'El teléfono debe contener 7 caracteres'
			},
			celular: {
				required: 'Campo requerido',
				number: 'El campo debe ser un número',
				maxlength: 'El celular debe contener 10 caracteres',
				minlength: 'El celular debe contener 10 caracteres'
			},
			email:{
				required: 'Campo requerido',
				email: 'El campo ingresado debe ser una dirección de email correcta'
			}
		}
	});
});