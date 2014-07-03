//Validación de campos para ingresar o modificar un presupuesto
$(document).bind('pageinit',function(){
//$(document).ready(function(){
	$('#formPresupuesto').validate({
		rules: {
			detalle:{required: true},
			valor:{required: true, number: true}
		},
		messages: {
			detalle:{required: "Campos requeridos"},
			valor: {
				number: "El campo debe contener valores numéricos",
				required: "Campos requeridos"
			}
		}
	});
});