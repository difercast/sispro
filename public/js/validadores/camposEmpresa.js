$(document).ready(function(){
	$("#formEditar").validate({
		rules: {
			ruc: {
				required: true,
				number: true,					
				maxlength: 13,
				minlength: 13,
			},
			razon_social:{
				required: true
			},
			razon_comercial:{
				required: true
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
				required: "Campo requerido"
			},
			razon_comercial: {
				required: "Campo requerido"
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