$( document ).on( "pageinit", function( event ) {
	console.log('exito');	
	$.validator.addMethod('repTerminada', function(val, element, param){
		var detalle = $('#detalle').val();
		var informe = $('#informe').val();
		if((detalle == null || informe == null) || (detalle == '' || informe == '')){
			return true
		}else return false;
	});
	
	$('#administrarOrden').validate({
		rules:{
			check2: {repTerminada: true} 
		},
		messages:{
			check2: {repTerminada:'Verifica la infomación'}
		}
	});
});
