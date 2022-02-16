<?php include "../resources/top.php"; ?>

<?php include "../resources/navbar.php"; ?>
<header>
	<link rel="shortcut icon" href="#">
</header>

<div class="container">
	<div class="row justify-content-center" style="margin:100px 0;">
		<div class="col-md-4">
			<h4>Registrar</h4>
			<p class="message"></p>
			<form id="register-form">
				<div class="form-group">
					<label for="name">Nombre</label>
					<input type="text" class="form-control" name="name" id="name" placeholder="Introduce el nombre">
				</div>
				<div class="form-group">
					<label for="surname">Apellido</label>
					<input type="text" class="form-control" name="surname" id="surname" placeholder="Introduce el nombre">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" name="email" id="email" placeholder="Email">
				</div>
				<div class="form-group">
					<label for="phone">Numero de telefono</label>
					<input type="text" class="form-control" name="phone" id="phone" placeholder="Introduce el nombre">
				</div>
				<div class="form-group">
					<label for="dir">Dirección</label>
					<input type="text" class="form-control" name="dir" id="dir" placeholder="Introduce el nombre">
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
				</div>
				<div class="form-group">
					<label for="cpassword">Confirmar contraseña</label>
					<input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Contraseña">
				</div>
				<input type="hidden" name="registrar" value="1">
				<button type="button" class="btn btn-primary register-btn col-md-12 text-center">Registrar</button>
			</form>
		</div>
	</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="../js/main.js"></script>