$(document).on('pageinit',function(){
	console.log('éxito');	
	$.validator.addMethod('validDate', function(value, element) {
		var startDate = $('#fechaInicio').val();
		return Date.parse(value) > Date.parse(startDate);				
	}, "Fecha de terminado debe ser mayor que la fecha de ingreso");	
	$('#formIngresoUser').validate({		
		rules:{
			fechaInicio: {required: true},
			fechaFinal: {required: true, validDate: true}
		},
		messages:{
			fechaInicio:{required:'Campo requerido'},
			fechaFinal:{required:'Campo requerido'}
		}
	});	
});