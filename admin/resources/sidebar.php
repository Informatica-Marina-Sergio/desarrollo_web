<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">

      <?php


      $uri = $_SERVER['REQUEST_URI'];
      $uriAr = explode("/", $uri);
      $page = end($uriAr);
      ?>


      <li class="nav-item">
        <a class="nav-link <?php echo ($page == 'pedidos.php') ? 'active' : ''; ?>" href="/admin/php/pedidos.php">
          Pedidos
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo ($page == 'productos.php') ? 'active' : ''; ?>" href="/admin/php/productos.php">
          Productos
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo ($page == 'tipo_prenda.php') ? 'active' : ''; ?>" href="/admin/php/tipo_prenda.php">
          Tipos de prenda
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo ($page == 'cliente.php') ? 'active' : ''; ?>" href="/admin/php/cliente.php">
          Clientes
        </a>
      </li>
    </ul>


  </div>
</nav>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Hola <?php echo $_SESSION["admin_name"]; ?></h1>

  </div>