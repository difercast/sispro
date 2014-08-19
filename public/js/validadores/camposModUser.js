$(document).bind('pageinit',function(){
	$.validator.addMethod("alphaNumeric", function(value, element) {
        return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
    });	
	$('#formCambiarPass').validate({
		rules:{
			password:{
				required: true,
				alphaNumeric: true
			},
			password2:{
				required: true,
				equalTo: "#password",
				alphaNumeric: true
			}
		},
		messages:{
			password:{
				required: 'Campos requeridos',
				alphaNumeric: 'Por favor, ingrese solo campos alfa-numéricos'
			},
			password2:{
				required: 'Campos requeridos',
				equalTo: 'Las contraseñas no coinciden',
				alphaNumeric: 'Por favor, ingrese solo campos alfa-numéricos'
			}
		}
	});
	
});