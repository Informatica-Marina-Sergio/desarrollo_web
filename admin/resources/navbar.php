<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Small Panda</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
    	<?php
    		if (isset($_SESSION['admin_id'])) {
    			?>
    				<a class="nav-link" href="/admin/php/logout.php">Cerrar sesión</a>
    			<?php
    		}else{
    			$uriAr = explode("/", $_SERVER['REQUEST_URI']);
    			$page = end($uriAr);
    			if ($page === "login.php") {
    			
    			}else{
    				?>
	    				<a class="nav-link" href="login.php">Entrar</a>
	    			<?php
    			}
  			
    		}

    	?>
      
    </li>
  </ul>
</nav>