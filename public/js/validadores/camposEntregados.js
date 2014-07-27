$(document).on('pageinit',function(){
	console.log('éxito');
	$.validator.addMethod('validDate', function(value, element) {
		var startDate = $('#principio').val();
		return new Date(value) >= new Date(startDate);				
	}, "Verifica las fechas");	
	$('#entregadosVendedor').validate({
		rules:{
			principio: {required: true},
			termino: {required: true, validDate: true}
		},
		messages:{
			principio:{required:'Campo requerido'},
			termino:{required:'Campo requerido'}
		}
	});
	
});