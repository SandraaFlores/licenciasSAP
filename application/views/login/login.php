<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?= base_url('assets/libs/sweetalert2/dist/sweetalert2.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/forms.css') ?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Iniciar Sesión</title>
</head>

<body class="justify-content-center align-items-center"  style="background-color:#f2f2f2;">

<div class="form-error">
	<?php validation_errors(); ?>
</div>
<?php echo form_open('UsuariosController/verifica'); ?>
<div class="container">
	<div class="abs-center">
		<div class="col-sm-6 mx-auto">
			<div class="card shadow">
				<div class="card">
					<div class="card-header align-center">
						<h5>
							Inicia sesión en <b class="main-text blue-text">AVANTE</b>
						</h5>
					</div>

					<div class="card-body">
						<form class="needs-validation" method="post"
							  action="<?= base_url("UsuariosController/verifica"); ?>" novalidate>
							<!--<div class="col-sm-12 align-center">
								<img src="assets/images/user.png" width="50%" height="50%" >
							</div>-->
							<div class="form-group row mx-0">
								<div class="col-lg-4 center">
									<!--<label class="col-form-label form-control-label" for="user">Usuario:</label>-->
									<h5>Usuario: </h5>
								</div>

								<div class="col-lg-7">
									<input type="text"
										   class="form-control <?php echo empty(form_error('user')) ? "" : "is-invalid"; ?>"
										   value="<?php echo set_value('user'); ?>"
										   placeholder="Usuario" id="user" name='user'
										   autofocus>
									<div class="invalid-feedback"><?php echo form_error('user'); ?></div>
								</div>

							</div>

							<div class="form-group row mx-0">
								<div class="col-lg-4 center">
									<!--<label class="col-lg-3 col-form-label form-control-label"
									   for="password">Contraseña:</label>-->
									<h5>Contraseña: </h5>
								</div>
								<div class="col-lg-7">
									<input type="password"
										   class="form-control <?php echo empty(form_error('password')) ? "" : "is-invalid"; ?>"
										   placeholder="Contraseña"
										   name="password" value="<?php echo set_value('password'); ?>">
									<div class="invalid-feedback"><?php echo form_error('password'); ?></div>
								</div>
							</div>
							<br>
							<div class="button form-group">
								<div class="center">
									<button type="submit" class="btn btn-info btn-small btn-responsive" id="aceptar">
										Ingresar
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>

</html>
