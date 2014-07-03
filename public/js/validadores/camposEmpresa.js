$(document).bind('pageinit',function(){
//$(document).on('pageinit', function(){
	//Validar que el campo ingresado solo contenga letras
	$.validator.addMethod('letters', function(val, element, param){
		return val.match(new RegExp("." + param + "$"));
	});
	$("#formEditar").validate({
		rules: {
			ruc: {
				required: true,
				number: true,					
				maxlength: 13,
				minlength: 13,
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
			}
		},
		messages:{
			ruc: {
				required: "Campo requerido",
				number: 'Ingresa un número',
				maxlength: 'El RUC debe contener 13 dígitos',
				minlength: 'El RUC debe contener 13 dígitos',												
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
				minlength: 'La actividad debe contener e dígitos',
			}
		}
	});
});