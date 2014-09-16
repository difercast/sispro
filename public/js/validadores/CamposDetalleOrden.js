$( document ).on( "pageinit", function( event ) {
	console.log('exito');		
	$('#administrarOrden').validate({
		rules:{
			check2: {
				required: function(){
					var detalle = $('#detalle').val();
					var informe = $('#informe').val();
					if((( detalle == null || detalle.length == 0 || /^\s+$/.test(detalle)) || 
						( informe == null || informe.length == 0 || /^\s+$/.test(informe))) ){
						console.log('Hola');
						return false;					
					}else{
						console.log('holi boli');
						return true;
					}
				}
			}			
		},
		messages:{
			check2: {required: 'Error'}
		}
	});
});
