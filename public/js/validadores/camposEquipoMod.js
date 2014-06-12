$(document).ready(function(){
	//Método para validar que los datos sean alfanuméricos
	$.validator.addMethod('alphaNumeric', function(val, elemento) {
		return this.optional(elemento) || /^[a-z0-9\-\s]+$/i.test(val);
	}, 'El campo debe contener valores alfanuméricos');
	$('#formEquipoMod').validate({
		rules: {
			tipo: {required:true},
			marca: {required: true},
			modelo: {required:true},
			serie: {required:true, alphaNumeric: true}		
		},
		messages: {
			tipo: {required: 'Campo requerido'},
			marca: {required: 'Campo requerido'},
			modelo: {required: 'Campo requerido'},
			serie: {required: 'Campo requerido'}
		}
	});
});
