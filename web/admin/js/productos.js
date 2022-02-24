$(document).ready(function(){

	var productList;

	function getProducts(){
		$.ajax({
			url : '/admin/classes/Productos.php',
			method : 'POST',
			data : {GET_PRODUCTO:1},
			success : function(resp){
				
				if (resp.status == 202) {

					var productHTML = '';

					productList = resp.message.products;

					if (productList) {
						$.each(resp.message.products, function(index, value){
                            
							productHTML += '<tr>'+
								              '<td>'+ value.name +'</td>'+
								              '<td><img width="60" height="60" src="/product_images/'+value.img+'"></td>'+
								              '<td>'+ value.price +'</td>'+
								              '<td>'+ value.qty +'</td>'+
								              '<td>'+ value.categoria +'</td>'+
								              '<td><a class="btn btn-sm btn-info edit-product" style="color:#fff;"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a pid="'+value.id+'" class="btn btn-sm btn-danger delete-product" style="color:#fff;"><i class="fas fa-trash-alt"></i></a></td>'+
								            '</tr>';

						});

						$("#product_list").html(productHTML);
					}

					


					var catSelectHTML = '<option value="">Selecciona el tipo de prenda</option>';
					$.each(resp.message.categories, function(index, value){

						catSelectHTML += '<option value="'+ value.id +'">'+ value.name +'</option>';

					});

					$(".prenda_list").html(catSelectHTML);

					

				}
			}

		});
	}

	getProducts();

	$(".add-product").on("click", function(){
        
		$.ajax({

			url : '../classes/Productos.php',
			method : 'POST',
            
			data : new FormData($("#add-product-form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			success : function(response){
				console.log(response);
				if (response.status == 202) {
					$("#add-product-form").trigger("reset");
					$("#add_product_modal").modal('hide');
					getProducts();
				}else if(response.status == 303){
					alert(response.message);
				}
			}

		});

	});


	$(document.body).on('click', '.edit-product', function(){

		console.log($(this).find('span').text());

		var product = $.parseJSON($.trim($(this).find('span').text()));

		console.log(product);

		$("input[name='e_product_name']").val(product.name);
		$("select[name='e_category_id']").val(product.categoria);
		$("textarea[name='e_product_desc']").val(product.description);
		$("input[name='e_product_qty']").val(product.qty);
		$("input[name='e_product_price']").val(product.price);
		$("input[name='e_product_image']").siblings("img").attr("src", "../product_images/"+product.img);
		$("input[name='pid']").val(product.id);
		$("#edit_product_modal").modal('show');

	});

	$(".submit-edit-product").on('click', function(){

		$.ajax({

			url : '../classes/Productos.php',
			method : 'POST',
			data : new FormData($("#edit-product-form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#edit-product-form").trigger("reset");
					$("#edit_product_modal").modal('hide');
					getProducts();
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
			}

		});


	});

	$(document.body).on('click', '.delete-product', function(){
		var pid = $(this).attr('pid');
		if (confirm("¿Estas seguro de que quieres borrar este producto?")) {
			$.ajax({

				url : '../classes/Productos.php',
				method : 'POST',
				data : {DELETE_PRODUCT: 1, pid:pid},
				success : function(response){
					console.log(response);
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						getProducts();
					}else if (resp.status == 303) {
						alert(resp.message);
					}
				}

			});
		}else{
			alert('Cancelled');
		}
		

	});

});