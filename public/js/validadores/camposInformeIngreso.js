$(document).on('pageinit',function(){
	console.log('éxito');
	$.validator.addMethod('validaFechas', function(value, element) {
		var startDate = $('#fechaInicio').val();
		return Date.parse(value) >= Date.parse(startDate);				
	});
		
	$('#FormIngreso').validate({
		rules:{			
			fechaInicio: {required:true},
			fechaFinal: {validaFechas: true, required:true}
		},
		messages:{
			fechaInicio:{required: 'Campo requerido'},
			fechaFinal:{validaFechas:  "Por favor, verifica las fechas", required: 'Campo requerido'}			
		}
	});

	$('#FormIngresoUser').validate({		
		rules:{
			fechaInicio: {required: true},
			fechaFinal: {required: true,validaFechas:true}
		},
		messages:{
			fechaInicio:{required:'Campo requerido'},
			fechaFinal:{required:'Campo requerido',validaFechas:  "Por favor, verifica las fechas"}
		}
	});
	
});
