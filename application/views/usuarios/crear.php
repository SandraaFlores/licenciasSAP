<?php
$conexion = mysqli_connect('localhost', 'root', '', 'licencias');

?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?= base_url('assets/libs/sweetalert2/dist/sweetalert2.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/forms.css') ?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<title>Registrar usuario</title>
</head>

<body>
<div class="form-error">
	<?php validation_errors(); ?>
</div>
<?php echo form_open('UsuariosController/insertar'); ?>
<div class="container">
	<div class="row pt-4">
		<div class="col-sm-12 mx-auto">
			<div class="card">
				<div class="card-header">
					<div class="mx-auto">
						<img src="<?= base_url('assets/images/optima.png" alt="Optima" width="200" height="70"') ?>"/>
					</div>
					<div class="col-sm-6 mx-auto">
						<h5>Registro de usuarios en platafoma SAP.</h5>
						<h5>Departamento de Sistemas.</h5>
					</div>
				</div>
				<div class="card-body " style="padding: 10px">
					<form class="needs-validation" method="POST"
						  action="<?= base_url() . "UsuariosController/insertar"; ?>" novalidate>
						<h4 align="right">
							<?php
							$fechaActual = date('d-m-Y');
							echo $fechaActual;
							?>
						</h4>
						<div class="form-group row mx-0 ">
							<label class="col-md-2 col-form-label form-control-label" for="name">Nombre(s) del
								solicitante:</label>
							<input type="text" name="name"
								   class="form-control col-md-3 <?php echo empty(form_error('name')) ? "" : "is-invalid"; ?>"
								   placeholder="Nombre(s) del solicitante" id="name"
								   value="<?php echo set_value('name'); ?>"
								   pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$"
								   oninvalid="setCustomValidity('El campo Nombre(s) sólo puede contener carácteres alfabéticos.')">
							<div class="invalid-feedback"><?php echo form_error('name'); ?></div>
						</div>
						<div class="form-group row mx-0 has-error">
							<label class="col-lg-2 col-form-label form-control-label" for="first_name">Primer
								apellido:</label>
							<input type="text"
								   class="form-control col-lg-3 <?php echo empty(form_error('first_name')) ? "" : "is-invalid"; ?>"
								   name="first_name"
								   placeholder="Primer apellido"
								   id="first_name" value="<?php echo set_value('first_name'); ?>"
								   pattern="^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*$"
								   oninvalid="setCustomValidity('El campo Primer apellido sólo puede contener carácteres alfabéticos.')">
							<div class="invalid-feedback"><?php echo form_error('first_name'); ?></div>
						</div>

						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="last_name">Segundo
								apellido:</label>
							<input type="text" name="last_name"
								   class="form-control col-lg-3 <?php echo empty(form_error('last_name')) ? "" : "is-invalid"; ?>"
								   placeholder="Segundo apellido"
								   id="last_name" value="<?php echo set_value('last_name'); ?>"
								   pattern="^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*$"
								   oninvalid="setCustomValidity('El campo Segundo apellido sólo puede contener carácteres alfabéticos.')">
							<div class="invalid-feedback"><?php echo form_error('last_name'); ?></div>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="user">Usuario:</label>
							<input type="text" name="user"
								   class="form-control col-lg-3 <?php echo empty(form_error('user')) ? "" : "is-invalid"; ?>"
								   placeholder="Usuario para ingresar" id="user"
								   value="<?php echo set_value('user'); ?>">
							<div class="invalid-feedback"><?php echo form_error('user'); ?></div>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="password">Contraseña:</label>
							<input type="password" name="password"
								   class="form-control col-lg-3 <?php echo empty(form_error('password')) ? "" : "is-invalid"; ?>"
								   placeholder="Contraseña" id="password"
								   value="<?php echo set_value('password'); ?>">
							<div class="invalid-feedback"><?php echo form_error('password'); ?></div>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label"
								   for="departments">Departamento:</label>
							<select id="departments" name="departments"
									class="form-control col-lg-3 <?php echo empty(form_error('departments')) ? "" : "is-invalid"; ?>" >
								<option value="selectdepartment">Seleccione una opción:</option>
								<?php
								$sql = "SELECT * FROM departments";
								$query = $conexion->query($sql);
								while ($valores = mysqli_fetch_array($query)) { ?>
									<option
										value="<?php echo $valores['id']; ?>" <?php echo set_select('departments', $valores['id'], False); ?> ><?php echo $valores['name']; ?> </option>
								<?php } ?>

							</select>

							<div class="invalid-feedback"><?php echo form_error('departments'); ?></div>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="role">Función del
								usuario:</label>
							<input type="text"
								   class="form-control col-lg-3 <?php echo empty(form_error('role')) ? "" : "is-invalid"; ?>"
								   name="role"
								   placeholder="Función del usuario" id="role"
								   value="<?php echo set_value('role'); ?>"
								   pattern="^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*$"
								   oninvalid="setCustomValidity('El campo Función del usuario sólo puede contener carácteres alfabéticos.')">
							<div class="invalid-feedback"><?php echo form_error('role'); ?></div>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label"
								   for="levels">Nivel de usuario:</label>
							<select id="levels" name="levels"
									class="form-control col-lg-3 <?php echo empty(form_error('levels')) ? "" : "is-invalid"; ?>" >
								<option value="selectlevel">Seleccione una opción:</option>
								<?php
								$sql = "SELECT * FROM levels";
								$query = $conexion->query($sql);
								while ($valores = mysqli_fetch_array($query)) { ?>
									<option
										value="<?php echo $valores['id']; ?>" <?php echo set_select('levels', $valores['id'], False); ?> ><?php echo $valores['name']; ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback"><?php echo form_error('levels'); ?></div>
						</div>
						<div class="button form-group">
							<div class="center">
								<button type="submit" class="btn btn-primary btn-responsive" name="submit"
										id="submit">Guardar
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
