
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

<body>
<div class="form-error">
	<?php validation_errors(); ?>
</div>
<?php echo form_open('UsuariosController/verifica'); ?>
<div class="container">
	<div class="row pt-4">
		<div class="col-sm-6 mx-auto">
			<div class="card">
				<div class="card-header align-center">
					<h5>
						Inicia sesión en <b class="main-text blue-text">AVANTE</b>
					</h5>
				</div>
				<div class="card-body" style="padding: 10px">
					<form class="needs-validation" method="post"
						  action="<?= base_url("UsuariosController/verifica"); ?>" novalidate>
						<div class="form-group row mx-0">
							<label class="col-lg-3 col-form-label form-control-label" for="user">Usuario:</label>
							<input type="text"
								   class="form-control col-lg-6 <?php echo empty(form_error('user')) ? "" : "is-invalid"; ?>"
								   value="<?php echo set_value('user'); ?>"
								   placeholder="Usuario" id="user" name='user'
								   autofocus>
							<div class="invalid-feedback"><?php echo form_error('user'); ?></div>
						</div>

						<div class="form-group row mx-0">
							<label class="col-lg-3 col-form-label form-control-label" for="password">Contraseña:</label>
							<input type="password"
								   class="form-control col-lg-6 <?php echo empty(form_error('password')) ? "" : "is-invalid"; ?>"
								   placeholder="Contraseña"
								   name="password" value="<?php echo set_value('password'); ?>">
							<div class="invalid-feedback"><?php echo form_error('password'); ?></div>
						</div>
						<div class="button form-group">
							<div class="center">
								<button type="submit" class="btn btn-info btn-small btn-responsive" id="aceptar">Aceptar
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>

</html>
