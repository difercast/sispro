$(document).ready(function(){
	$('#enviar').click(function(){
	       	console.log('hola k ase');
	        $.ajax({	        	
	    	   	url:"procesaCliente",
	           	type:"POST",
	           	data: $('#formBuscar').serializeArray(),
	           	//data:"id="+$('#id').val(),
	           	success: function(clientes){            		
	           		$('#nombres').val(clientes[0]);
	           		$('#cedula').val(clientes[1]);
	           		$('#direccion').val(clientes[2]);
	           		$('#telefono').val(clientes[3]); 
	           		$('#celular').val(clientes[4]);
	           		$('#email').val(clientes[5]);
	           		$('#observaciones').val(clientes[6]);
	           		$('#id_cliente').val(clientes[7]);           		
	           		//$('#datosCliente').html(clientes);
	           	}
	        });
	    });

});