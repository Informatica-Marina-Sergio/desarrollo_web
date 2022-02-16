<?php session_start(); ?>
<?php include_once("../resources/top.php"); ?>
<?php include_once("../resources/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
  <?php include "../resources/sidebar.php"; ?>


      <div class="row">
      	<div class="col-10">
      		<h2>Tipos de prenda</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_tipo_prenda_modal" class="btn btn-primary btn-sm">Añadir tipo de prenda</a>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="prenda_list">
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>



<div class="modal fade" id="add_tipo_prenda_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir tipo de prenda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-tipo-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Tipo de prenda</label>
		        		<input type="text" name="tipo_nombre" class="form-control" placeholder="Introduce el nuevo tipo de prenda">
		        	</div>
        		</div>
        		<input type="hidden" name="add_tipoprenda" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-tipo">Añadir</button>
        		</div>
        	</div>
        	
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit_tipo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir tipo de prenda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-tipoprenda-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="tipo_id">
              <div class="form-group">
                <label>Tipo de prenda</label>
                <input type="text" name="tipo_nombre" class="form-control" placeholder="Enter Brand Name">
              </div>
            </div>
            <input type="hidden" name="EDIT_TIPO" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary edit-tipoprenda-btn">Actualizar tipo de prenda</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>


<script type="text/javascript" src="../js/tipo_prenda.js"></script>