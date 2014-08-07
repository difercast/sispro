$(document).on('pageinit',function(){
	console.log('éxito');	
	$.validator.addMethod('validDate', function(value, element) {
		var startDate = $('#fechaInicio').val();
		return Date.parse(value) > Date.parse(startDate);				
	}, "Fecha de terminado debe ser mayor que la fecha de ingreso");	
	$('#FormIngreso').validate({		
		rules:{
			fechaInicio: {required: true},
			fechaFinal: {required: true, validDate: true}
		},
		messages:{
			fechaInicio:{required:'Campo requerido'},
			fechaFinal:{required:'Campo requerido'}
		}
	});	


	$('#FormIngresoUser').validate({		
		rules:{
			fechaInicioIngUser: {required: true},
			fechaFinalIngUser: {required: true}
		},
		messages:{
			fechaInicioIngUser:{required:'Campo requerido'},
			fechaFinalIngUser:{required:'Campo requerido'}
		}
	});	
});