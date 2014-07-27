$(document).on('pageinit',function(){
	console.log('éxito');
	$.validator.addMethod('validDate', function(value, element) {
		var startDate = $('#ini').val();
		return new Date(value) >= new Date(startDate);				
	}, "Verifica las fechas");	

	$('#repTecnicoEntr').validate({
		rules:{
			ini: {required: true},
			fin: {required: true, validDate: true}
		},
		messages:{
			ini:{required:'Campo requerido'},
			fin:{required:'Campo requerido'}
		}
	});
	
});