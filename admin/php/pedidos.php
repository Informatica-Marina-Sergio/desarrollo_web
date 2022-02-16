<?php session_start(); ?>
<?php include_once("../resources/top.php"); ?>
<?php include_once("../resources/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "../resources/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Pedidos</h2>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Pedido</th>
              <th>Usuario</th>
              <th>Id del producto</th>
              <th>Nombre del producto</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody id="lista_compras">
           
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="../js/clientes.js"></script>