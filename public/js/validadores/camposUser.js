$(document).ready(function(){
	$('#formUser').validate({
		rules:{
			apellidos: {
				required: true
			},
			nombres:{
				required: true
			},
			cedula:{
				required: true,
				number: true,
				minlength: 10,
				maxlength: 10
			},
			direccion:{
				required: true
			},
			telefono:{
				number: true,
				minlength: 7,
				maxlength: 7
			},
			celular:{
				number: true,
				minlength: 10,
				maxlength: 10
			},
			email:{
				required: true,
				email: true
			},
			username:{
				required: true
			},
			pass:{
				required: true
			},
			pass2:{
				required: true,
				equalTo: "#pass"
			}
		},
		messages:{
			apellidos: {
				required: 'Campo requerido'
			},
			nombres:{
				required: 'Campo requerido'
			},
			cedula:{
				required: 'Campo requerido',
				number: 'Debe ingresar solo números',
				minlength: 'Debe ingresar 10 dígitos',
				maxlength: 'Debe ingresar 10 dígitos'
			},
			direccion:{
				required: 'Campo requerido'
			},
			telefono:{
				number: 'Debe ingresar solo números',
				minlength: 'Debe ingresar 7 dígitos',
				maxlength: 'Debe ingresar 7 dígitos'
			},
			celular:{
				number: 'Debe ingresar solo números',
				minlength: 'Debe ingresar 10 dígitos',
				maxlength: 'Debe ingresar 10 dígitos'
			},
			email:{
				required: 'Campo requerido',
				email: 'Debe ingresar un email correcto'
			},
			username:{
				required: 'Campo requerido'
			},
			pass:{
				required: 'Campo requerido',
			},
			pass2:{
				required: 'Campo requerido',
				equalTo: 'Las contraseñas no coinciden'
			}
		}
	});
});