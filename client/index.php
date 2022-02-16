<?php 
session_start();  
if (!isset($_SESSION['user_id'])) {
  header("location:php/login.php");
}
include "./resources/top.php"; 
?>
 
<?php include "./resources/navbar.php"; ?>

<div class="container-fluid">
  <div class="row">
    
    <?php include "./resources/sidebar.php"; ?>

      <h2>Pagina en construcción</h2>
  </div>
</div>
