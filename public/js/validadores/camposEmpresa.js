$( document ).on( "pageinit", function( event ) {
    console.log('exito');
     $.validator.addMethod('letters', function(val, element, param){
		return val.match(new RegExp("." + param + "$"));
	});
     $.validator.addMethod('validaAct', function(value, element){
     	return (value.substr(0,2) == '00');
     });
	$('#formEditar').validate({
		rules: {
			ruc: {
				required: true,
				number: true,					
				maxlength: 13,
				minlength: 13
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
				minlength: 'El RUC debe contener 13 dígitos'												
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

