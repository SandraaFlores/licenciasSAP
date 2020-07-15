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
<div class="container">
	<div class="row pt-4">
		<div class="col-sm-12 mx-auto">
			<div class="card">
				<div class="card-header">
					<div class="mx-auto">
						<img src="<?= base_url('assets/images/optima.png" alt="Optima" width="200" height="70"')?>"/>
					</div>
					<div class="col-sm-6 mx-auto">
						<h5>Registro de usuarios en platafoma SAP.</h5>
						<h5>Departamento de Sistemas.</h5>
					</div>
				</div>
				<div class="cadr-body" style="padding: 10px">
					<form method="post" action="<?= base_url() . "UsuariosController/insertar"; ?>">
						<h4 align="right">
							<?php
							$fechaActual = date('d-m-Y');
							echo $fechaActual;
							?>
						</h4>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="name">Nombre(s) del
								solicitante:</label>
							<input type="text" name="name" class="form-control col-lg-3"
								   placeholder="Nombre(s) del solicitante" id="name" required>

							<label class="col-lg-2 col-form-label form-control-label" for="first_name">Primer
								apellido:</label>
							<input type="text" class="form-control col-lg-3" name="first_name"
								   placeholder="Primer apellido"
								   id="first_name" required>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="last_name">Segundo
								apellido:</label>
							<input type="text" name="last_name" class="form-control col-lg-3"
								   placeholder="Segundo apellido"
								   id="last_name" required>
							<label class="col-lg-2 col-form-label form-control-label" for="user">Usuario:</label>
							<input type="text" name="user" class="form-control col-lg-3"
								   placeholder="Usuario para ingresar" id="user" required>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="password">Contraseña:</label>
							<input type="password" name="password" class="form-control col-lg-3" pattern=".{6,}"
								   placeholder="Contraseña" id="password" required>

							<label class="col-lg-2 col-form-label form-control-label"
								   for="departments">Departamento:</label>
							<select id="departments" name="departments" class="form-control col-lg-3" required>
								<option value="0">Seleccione una opción:</option>
								<?php
								$sql = "SELECT * FROM departments";
								$query = $conexion->query($sql);
								while ($valores = mysqli_fetch_array($query)) {
									echo "<option value='" . $valores['id'] . "'>" . $valores['name'] . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="role">Función del
								usuario:</label>
							<input type="text" class="form-control col-lg-3" name="role"
								   placeholder="Función del usuario" id="role"
								   required>

							<label class="col-lg-2 col-form-label form-control-label"
								   for="levels">Nivel de usuario:</label>
							<select id="levels" name="levels" class="form-control col-lg-3" required>
								<option value="0">Seleccione una opción:</option>
								<?php
								$sql = "SELECT * FROM levels";
								$query = $conexion->query($sql);
								while ($valores = mysqli_fetch_array($query)) {
									echo "<option value='" . $valores['id'] . "'>" . $valores['name'] . "</option>";
								}
								?>
							</select>
						</div>
						<div class="button form-group">
							<div class="center">
								<button type="submit" class="btn btn-primary btn-responsive" name=""
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
