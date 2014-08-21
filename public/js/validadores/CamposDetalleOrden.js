$( document ).on( "pageinit", function( event ) {
	console.log('exito');
	//Validar que la fecha de prometido no sea menor que la fecha de ingreso
	$.validator.addMethod('validDate', function(value, element) {
		var startDate = $('#fechaIngreso').val();
		//return Date.parse(startDate) < Date.parse(value);
		return Date.parse(value) >= Date.parse(startDate);
	}, "* Fecha de prometido debe ser mayor a la fecha de ingreso");
	//Validar que el campo ingresado solo contenga letras
	$.validator.addMethod('letters', function(val, element, param){
		return val.match(new RegExp("." + param + "$"));
	});
	//Método para validar que los datos sean alfanuméricos
	$.validator.addMethod('alphaNumeric', function(val, element) {
		return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(val);
	}, 'El campo debe contener valores alfanuméricos');
	//Validar CI
	$.validator.addMethod('validaCI', function(val){
		var digitoRegion = val.substring(0,2);
		var tercerDigito = val.substring(2,3);
		var coeficientes = [2,1,2,1,2,1,2,1,2];
		var total = 0;
		var ultimoDigito = val.charAt(9);
		if(val.length == 10){
			if( (digitoRegion >= 1 && digitoRegion <= 24) && tercerDigito <= 6){
				for( i=0; i<coeficientes.length; i++ ){
					var valor = coeficientes[i]*parseInt(val.charAt(i));
					if(valor >= 10){
						valor = valor-9;
					}
					total = total + valor;
				}
				var primerDigito = String(total).charAt(0);
				var decena = (parseInt(primerDigito) + 1) *10;
				var digitoValidador = decena - total;
				if( digitoValidador == 10){ digitoValidador = 0;}
				if(digitoValidador == ultimoDigito){
					return true;
				}else return false;
			}else return false;
		}else return false;
	});
	$.validator.addMethod('validarCel', function(val){
		var primerDigito = val.substring(0,2);
		console.log(primerDigito);
		return primerDigito == '09';
	})
	$('#formIngresarOrden').validate({
		rules:{
			nombres: { required: true, letters: '[a-zA-Z]+'},
			cedula:{ required: true, number: true, minlength: 10, maxlength: 10, validaCI: true},
			direccion:{ required: true},
			telefono: { number: true, minlength: 7, maxlength: 7 },
			celular: { number: true, minlength: 10, maxlength: 10, validarCel: true },
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
				maxlength: 'El campo debe tener 10 dígitos',
				validaCI: 'El número de cédula ingresado es incorrecto'
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
				maxlength: 'El campo debe tener 10 dígitos',
				validarCel: 'El número ingresado es incorrecto'
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