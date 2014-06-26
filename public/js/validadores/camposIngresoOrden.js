$(document).ready(function(){
	//Validar que la fecha de prometido no sea menor que la fecha de ingreso
	$.validator.addMethod('validDate', function(value, element) {
		var startDate = $('#fechaIngreso').val();
		return Date.parse(startDate) < Date.parse(value);
	}, "* End date must be after start date");
	//Validar que el campo ingresado solo contenga letras
	$.validator.addMethod('letters', function(val, element, param){
		return val.match(new RegExp("." + param + "$"));
	});
	//Método para validar que los datos sean alfanuméricos
	$.validator.addMethod('alphaNumeric', function(val, element) {
		return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(val);
	}, 'El campo debe contener valores alfanuméricos');
	$('#formIngresarOrden').validate({
		rules:{
			nombres: { required: true, letters: '[a-zA-Z]+'},
			cedula:{ required: true, number: true, minlength: 10, maxlength: 10} ,
			direccion:{ required: true},
			telefono: { number: true, minlength: 7, maxlength: 7 },
			celular: { number: true, minlength: 10, maxlength: 10 },
			email: {email: true},
			tipo: {required:true},
			marca: {required:true},
			modelo: {required:true},
			serie: {required:true, alphaNumeric: true},
			problema: {required: true},
			fechaPrometido: {required: true, validDate: true}
		},
		messages:{
			nombres:{
				required: 'Campo requerido',
				letters: 'El campo debe contener solo letras'
			},
			cedula:{
				required: 'Campo requerido',
				number: 'El campo debe contener solo números',
				minlength: 'El campo debe tener 10 dígitos',
				maxlength: 'El campo debe tener 10 dígitos'
			},
			direccion:{
				required: 'Campo requerido'},
			telefono:{
				number: 'El campo debe contener solo números',
				minlength: 'El campo debe tener 7 dígitos',
				maxlength: 'El campo debe tener 7 dígitos'
			},
			celular: {
				number: 'El campo debe contener solo números',
				minlength: 'El campo debe tener 10 dígitos',
				maxlength: 'El campo debe tener 10 dígitos'
			},
			email: {email: 'Ingrese una dirección de email correcta'},
			tipo:{required: 'Campo requerido'},
			marca:{required: 'Campo requerido'},
			modelo:{required: 'Campo requerido'},
			serie:{
				required: 'Campo requerido',
				alphaNumeric: 'El campo debe contener caracteres'
			},
			problema:{required: 'Campo requerido'},
			fechaPrometido: { 
				required: 'Campo requerido',
				validDate: 'La fecha de prometido no debe ser menor que la fecha de ingreso'
			}			
		}
	});
});