$(document).on('pageinit',function(){
	console.log('exito');
	$.validator.addMethod('validaFechas',function(value,element) {
		var start = $('#fechaInicio').val();
		console.log(start);
		console.log(value);
		return Date.parse(value) >= Date.parse(start);
	})

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
	$.validator.addMethod('validarFechas',function(value,element) {
		var start = $('#fechaInicio1').val();
		console.log(start);
		console.log(value);
		return Date.parse(value) >= Date.parse(start);
	});
	$('#FormIngresoUser').validate({
		rules:{			
			fechaInicio1: {required:true},
			fechaFinal: {validarFechas: true, required:true}
		},
		messages:{
			fechaInicio1:{required: 'Campo requerido'},
			fechaFinal:{validarFechas:  "Por favor, verifica las fechas", required: 'Campo requerido'}			
		}
	});

	$.validator.addMethod('validacionFechas',function(value,element) {
		var start = $('#fechaInicio2').val();
		console.log(start);
		console.log(value);
		return Date.parse(value) >= Date.parse(start);
	});
	$('#FormRepTerminadas').validate({
		rules:{			
			fechaInicio2: {required:true},
			fechaFinal: {validacionFechas: true, required:true}
		},
		messages:{
			fechaInicio2:{required: 'Campo requerido'},
			fechaFinal:{validacionFechas:  "Por favor, verifica las fechas", required: 'Campo requerido'}			
		}
	});

	$.validator.addMethod('verificacionFechas',function(value,element) {
		var start = $('#fechaInicio3').val();
		console.log(start);
		console.log(value);
		return Date.parse(value) >= Date.parse(start);
	});
	$('#formOrndenEntgd').validate({
		rules:{			
			fechaInicio3: {required:true},
			fechaFinal: {verificacionFechas: true, required:true}
		},
		messages:{
			fechaInicio3:{required: 'Campo requerido'},
			fechaFinal:{verificacionFechas:  "Por favor, verifica las fechas", required: 'Campo requerido'}			
		}
	});

	$.validator.addMethod('verificaFechas',function(value,element) {
		var start = $('#fechaInicio4').val();
		console.log(start);
		console.log(value);
		return Date.parse(value) >= Date.parse(start);
	});
	$('#formOrdenEntgdSuc').validate({
		rules:{			
			fechaInicio4: {required:true},
			fechaFinal: {verificaFechas: true, required:true}
		},
		messages:{
			fechaInicio4:{required: 'Campo requerido'},
			fechaFinal:{verificaFechas:  "Por favor, verifica las fechas", required: 'Campo requerido'}			
		}
	});

	$.validator.addMethod('verifFechas',function(value,element) {
		var start = $('#fechaInicio5').val();
		console.log(start);
		console.log(value);
		return Date.parse(value) >= Date.parse(start);
	});
	$('#OrdenRepEntregadaTec').validate({
		rules:{			
			fechaInicio5: {required:true},
			fechaFinal: {verifFechas: true, required:true}
		},
		messages:{
			fechaInicio5:{required: 'Campo requerido'},
			fechaFinal:{verifFechas:  "Por favor, verifica las fechas", required: 'Campo requerido'}			
		}
	});
});
