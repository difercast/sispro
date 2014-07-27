/*************************************************
$(document).on('pageinit',function(){
	console.log('éxito');
	jQuery.validator.addMethod("greaterThan", 
	function(value, element, params) {
	    if (!/Invalid|NaN/.test(new Date(value))) {
	        return new Date(value) > new Date($(params).val());
	    }

	    return isNaN(value) && isNaN($(params).val()) 
	        || (Number(value) > Number($(params).val())); 
	},'Must be greater than {0}.');

	$('#formIngresoUser').validate({
		rules:{
			fechaFinal: {required: true, greaterThan: "#fechaInicio"},
			fechaInicio: {required: true}
		},
		messages:{
			fechaInicio:{required:'Campo requerido'},
			fechaFinal:{required:'Campo requerido'}
		}
	});
});
**************************************************************/
$(document).on('pageinit',function(){
	console.log('éxito');
	$.validator.addMethod('validDate', function(value, element) {
		var startDate = $('#fechaIni').val();
		return new Date(value) >= new Date(startDate);				
	}, "Verifica las fechas");	

	$('#formIngresoUser').validate({
		rules:{
			fechaIni: {required: true},
			fechaFin: {required: true, validDate: true}
		},
		messages:{
			fechaIni:{required:'Campo requerido'},
			fechaFin:{required:'Campo requerido'}
		}
	});
	
});