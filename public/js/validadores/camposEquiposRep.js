$(document).on('pageinit',function(){
	console.log('éxito');
	$.validator.addMethod('validDate', function(value, element) {
		var startDate = $('#inicio').val();
		return new Date(value) >= new Date(startDate);				
	}, "Verifica las fechas");	

	$('#reparacionTerminadaTecnico').validate({
		rules:{
			inicio: {required: true},
			fFinal: {required: true, validDate: true}
		},
		messages:{
			inicio:{required:'Campo requerido'},
			fFinal:{required:'Campo requerido'}
		}
	});
	
});