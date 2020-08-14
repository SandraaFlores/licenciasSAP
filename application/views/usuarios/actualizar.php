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
	<title>Actualizar usuario</title>
</head>

<body>
<div class="form-error">
	<?php validation_errors(); ?>
</div>
<?php echo form_open('UsuariosController/edit'); ?>
<div class="container">
	<div class="row pt-4">
		<div class="col-sm-12 mx-auto">
			<div class="card">
				<div class="card-header">
					<div class="mx-auto">
						<img src="<?= base_url('assets/images/optima.png" alt="Optima" width="200" height="70"') ?>"/>
					</div>
					<div class="col-sm-6 mx-auto">
						<h5>Actualizar usuarios en platafoma SAP.</h5>
						<h5>Departamento de Sistemas.</h5>
					</div>
				</div>
				<div class="cadr-body" style="padding: 10px">
					<form class="needs-validation" method="post" action="<?= base_url() . "UsuariosController/edit"; ?>"
						  novalidate>
						<h4 align="right">
							<?php
							$fechaActual = date('d-m-Y');
							echo $fechaActual;
							?>
						</h4>
						<div class="form-group row mx-0">
							<input type="hidden"
								   value="<?= set_value('id2', isset($usuario->id[0]) ? $usuario->id : '') ?>"
								   name="id2">
							<label class="col-lg-2 col-form-label form-control-label" for="name">Nombre(s) del
								solicitante:</label>
							<div class="col-lg-3 p-0">
								<input type="text"
									   name="name"
									   class="form-control <?php echo empty(form_error('name')) ? "" : "is-invalid"; ?>"
									   placeholder="Nombre(s) del solicitante"
									   id="name"
									   value="<?= set_value('name', isset($usuario->name[0]) ? $usuario->name : '') ?>"
									   autofocus>
								<div class="invalid-feedback"><?php echo form_error('name'); ?></div>
							</div>

							<label class="col-lg-2 col-form-label form-control-label" for="first_name">Primer
								apellido:</label>
							<div class="col-lg-3 p-0">
								<input type="text" name="first_name"
									   class="form-control <?php echo empty(form_error('first_name')) ? "" : "is-invalid"; ?>"
									   placeholder="Primer apellido"
									   id="first_name"
									   value="<?= set_value('first_name', isset($usuario->first_name[0]) ? $usuario->first_name : '') ?>">
								<div class="invalid-feedback"><?php echo form_error('first_name'); ?></div>
							</div>
						</div>

						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="last_name">Segundo
								apellido:</label>
							<div class="col-lg-3 p-0">
								<input type="text" name="last_name"
									   class="form-control <?php echo empty(form_error('last_name')) ? "" : "is-invalid"; ?>"
									   placeholder="Segundo apellido"
									   id="last_name"
									   value="<?= set_value('last_name', isset($usuario->last_name[0]) ? $usuario->last_name : '') ?>">
								<div class="invalid-feedback"><?php echo form_error('last_name'); ?></div>
							</div>

							<label class="col-lg-2 col-form-label form-control-label" for="user">Usuario:</label>
							<div class="col-lg-3 p-0">
								<input type="text" name="user"
									   class="form-control <?php echo empty(form_error('user')) ? "" : "is-invalid"; ?>"
									   placeholder="Usuario para ingresar" id="user"
									   value="<?= set_value('user', isset($usuario->user[0]) ? $usuario->user : '') ?>">
								<div class="invalid-feedback"><?php echo form_error('user'); ?></div>
							</div>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="password">Contraseña:</label>
							<div class="col-lg-3 p-0">
								<input type="password" name="password"
									   class="form-control <?php echo empty(form_error('password')) ? "" : "is-invalid"; ?>"
									   placeholder="Contraseña" id="password">
								<div class="invalid-feedback"><?php echo form_error('password'); ?></div>
							</div>

							<label class="col-lg-2 col-form-label form-control-label"
								   for="departments">Departamento:</label>
							<div class="col-lg-3 p-0">
								<select id="departments" name="departments"
										class="form-control <?php echo empty(form_error('departments')) ? "" : "is-invalid"; ?>">
									<option value="selectdepartment2">Seleccione una opción:</option>
									<?php
									$sql = "SELECT * FROM departments";
									$query = $conexion->query($sql);
									while ($valores = mysqli_fetch_array($query)) {
										$txt = ($usuario->DEPARTMENTS_id == $valores['id']) ? " selected" : " "; ?>
										<option <?php echo $txt; ?>
											value="<?php echo $valores['id']; ?>" <?php echo set_select('departments', $valores['id'], False); ?> ><?php echo $valores['name']; ?> </option>
									<?php } ?>
								</select>
								<div class="invalid-feedback"><?php echo form_error('departments'); ?></div>
							</div>
						</div>

						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="role">Función del
								usuario:</label>
							<div class="col-lg-3 p-0">
								<input type="text"
									   class="form-control <?php echo empty(form_error('role')) ? "" : "is-invalid"; ?>"
									   name="role"
									   placeholder="Función del usuario" id="role"
									   value="<?= set_value('role', isset($usuario->role[0]) ? $usuario->role : '') ?>">
								<div class="invalid-feedback"><?php echo form_error('role'); ?></div>
							</div>

							<label class="col-lg-2 col-form-label form-control-label"
								   for="levels">Nivel de usuario:</label>
							<div class="col-lg-3 p-0">
								<select id="levels" name="levels"
										class="form-control <?php echo empty(form_error('levels')) ? "" : "is-invalid"; ?>">
									<option value="selectlevel2">Seleccione una opción:</option>
									<?php
									$sql = "SELECT * FROM levels";
									$query = $conexion->query($sql);
									while ($valores = mysqli_fetch_array($query)) {
										$txt = ($usuario->LEVELS_id == $valores['id']) ? " selected" : " "; ?>
										<option <?php echo $txt; ?>
											value="<?php echo $valores['id']; ?>" <?php echo set_select('departments', $valores['id'], False); ?> ><?php echo $valores['name']; ?> </option>
									<?php } ?>
								</select>
								<div class="invalid-feedback"><?php echo form_error('levels'); ?></div>
							</div>
						</div>
						<div class="button form-group">
							<div class="center">
								<button type="submit" class="btn btn-primary btn-responsive" name=""
										id="submit">Actualizar
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
