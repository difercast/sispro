$(document).on('pageinit',function(){
	console.log('éxito');
	$.validator.addMethod('validDate', function(value, element) {
		var startDate = $('#inicial').val();
		return new Date(value) >= new Date(startDate);				
	}, "Verifica las fechas");	

	$('#sinRevisar').validate({
		rules:{
			inicial: {required: true},
			terminado: {required: true, validDate: true}
		},
		messages:{
			inicial:{required:'Campo requerido'},
			terminado:{required:'Campo requerido'}
		}
	});
	
});