$(document).ready(function(){

	getTipoPrenda();
	
	function getTipoPrenda(){
		$.ajax({
			url : '/admin/classes/Productos.php',
			method : 'POST',
			data : {GET_TIPOPRENDA:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				var brandHTML = '';

				$.each(resp.message, function(index, value){
					brandHTML += '<tr>'+
									'<td>'+ value.name +'</td>'+
									'<td><a class="btn btn-sm btn-info edit-tipoprenda"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a tip="'+value.id+'" class="btn btn-sm btn-danger delete-category"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});

				$("#prenda_list").html(brandHTML);

			}
		})
		
	}

	$(".add-tipo").on("click", function(){

		$.ajax({
			url : '/admin/classes/Productos.php',
			method : 'POST',
			data : $("#add-tipo-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getTipoPrenda();
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
				$("#add_tipo_prenda_modal").modal('hide');
			}
		})

	});

	$(document.body).on("click", ".edit-tipoprenda", function(){

		var cat = $.parseJSON($.trim($(this).children("span").html()));
		$("input[name='tipo_nombre']").val(cat.tipo_nombre);
		$("input[name='tipo_id']").val(cat.tipo_id);

		$("#edit_tipo_modal").modal('show');

		

	});

	$(".edit-tipoprenda-btn").on('click', function(){

		$.ajax({
			url : '/admin/classes/Productos.php',
			method : 'POST',
			data : $("#edit-tipoprenda-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getTipoPrenda();
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
				$("#edit_tipo_modal").modal('hide');
			}
		})

	});

	$(document.body).on('click', '.delete-category', function(){

		var tip = $(this).attr('tip');

		if (confirm("¿Seguro que quieres borrar este tipo de prenda?")) {
			$.ajax({
				url : '/admin/classes/Productos.php',
				method : 'POST',
				data : {DELETE_TIPO:1, tip:tip},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						alert(resp.message);
						getTipoPrenda();
					}else if(resp.status == 303){
						alert(resp.message);
					}
				}
			})
		}else{
			alert('Proceso cancelado');
		}

		

	});

});