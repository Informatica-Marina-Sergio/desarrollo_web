$(document).ready(function(){

	getClientes();
	getCompras();

	function getClientes(){
		$.ajax({
			url : '../classes/Cliente.php',
			method : 'POST',
			data : {GET_CLIENTE:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					var customersHTML = "";
					$.each(resp.message, function(index, value){
						customersHTML += '<tr>'+
									          '<td>'+value.name+' '+value.surname+'</td>'+
									          '<td>'+value.email+'</td>'+
									          '<td>'+value.phone_number+'</td>'+
									          '<td>'+value.address+'</td>'+
									       '</tr>'

					});

					$("#lista_clientes").html(customersHTML);

				}else if(resp.status == 303){

				}
			}
		})
		
	}

	function getCompras(){
		$.ajax({
			url : '../classes/Cliente.php',
			method : 'POST',
			data : {GET_PEDIDOS_CLIENTE:1},
			success : function(response){
				
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {

					var customerOrderHTML = "";

					$.each(resp.message, function(index, value){

						customerOrderHTML +='<tr>'+
                                              '<td>'+ value.id +'</td>'+
                                              '<td>'+ value.user_id +'</td>'+
								              '<td>'+ value.product_id +'</td>'+
								              '<td>'+ value.name +'</td>'+
								              '<td>'+ value.qty +'</td>'
								            '</tr>';

					});

					$("#lista_compras").html(customerOrderHTML);

				}else if(resp.status == 303){
					$("#lista_compras").html(resp.message);
				}

			}
		})
		
	}


});