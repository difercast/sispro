$( document ).on( "pageinit", function( event ) {
	console.log('éxito');
	
	$('#buscarOrden').validate({
		rules: {
			NumOrden: {
				required: true,
				number: true,
			}			
		},
		messages: {
			NumOrden: {
				required: 'Campo requerido',
				number: 'Debe ingresar solo números',
			}
		}
	});
});