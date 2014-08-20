$(document).on('pageinit',function(){
	console.log('éxito');
	$.validator.addMethod('validaFechas', function(value, element) {
		var startDate = $('#fechaInicio').val();
		return Date.parse(value) >= Date.parse(startDate);				
	});

	$('#FormIngresoUser').validate({		
		rules:{
			fechaInicio: {required: true},
			fechaFinal: {validaFechas: true, required: true}
		},
		messages:{
			fechaInicio:{required:'Campo requerido'},
			fechaFinal:{validaFechas: 'Por favor, verifica las fechas ingresadas', required:'Campo requerido'}
		}
	});
	
});