<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">

      <?php


      $uri = $_SERVER['REQUEST_URI'];
      $uriAr = explode("/", $uri);
      $page = end($uriAr);
      ?>

    </ul>


  </div>
</nav>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Hola <?php echo $_SESSION["user_name"]; ?></h1>

  </div>