<?php session_start(); ?>
<?php include_once("../resources/top.php"); ?>
<?php include_once("../resources/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
  <?php include "../resources/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Clientes</h2>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Nº Telefono</th>
              <th>Dirección</th>
            </tr>
          </thead>
          <tbody id="lista_clientes">
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/clientes.js"></script>