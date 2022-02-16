<?php include "../resources/top.php"; ?>
<?php include "../resources/navbar.php"; ?>

<div class="container">
	<div class="row justify-content-center" style="margin:200px 0;">
		<div class="col-md-4">
			<h4>Inicio de sesión</h4>
			<p class="message"></p>
			<form id="login-form">
			  <div class="form-group">
			    <label for="email">Correo Electrónico</label>
			    <input type="email" class="form-control" name="email" id="email"  placeholder="Introduce el correo">
			  </div>
			  <div class="form-group">
			    <label for="password">Contraseña</label>
			    <input type="password" class="form-control" name="password" id="password" placeholder="Introduce la contraseña">
			  </div>
			  <input type="hidden" name="login" value="1">
			  <button type="button" class="btn btn-primary login-btn col-md-12 text-center">Entrar</button>
			</form>
		</div>
	</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="../js/main.js"></script>