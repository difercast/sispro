$(document).on('pageinit',function(){
	console.log('éxito');
	$.validator.addMethod('validaFechas', function(value, element) {
		var startDate = $('#fechaFinal').val();
		return Date.parse(value) <= Date.parse(startDate);				
	});			
	$('#FormIngreso').validate({
		rules:{
			fechaInicio: {validaFechas: true, required: true},
			fechaFinal: {required: true}
		},
		messages:{
			fechaInicio:{required:'Campo requerido', validaFechas:  "Por favor, verifica las fechas"},
			fechaFinal:{required:'Campo requerido'}
		}
	});
	
});
