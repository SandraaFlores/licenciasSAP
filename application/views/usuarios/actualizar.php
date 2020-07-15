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
					<form method="post" action="<?= base_url() . "UsuariosController/edit"; ?>">
						<h4 align="right">
							<?php
							$fechaActual = date('d-m-Y');
							echo $fechaActual;
							?>
						</h4>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="name">Nombre(s) del
								solicitante:</label>
							<input type="hidden"
								   value="<?= set_value('id2', isset($usuario->id[0]) ? $usuario->id : '') ?>" name="id2">
							<input type="text" name="name" class="form-control col-lg-3"
								   placeholder="Nombre(s) del solicitante" id="name"
								   value="<?= set_value('name', isset($usuario->name[0]) ? $usuario->name : '') ?>"
								   required autofocus>


							<label class="col-lg-2 col-form-label form-control-label" for="first_name">Primer
								apellido:</label>
							<input type="text" class="form-control col-lg-3" name="first_name"
								   placeholder="Primer apellido"
								   id="first_name"
								   value="<?= set_value('first_name', isset($usuario->first_name[0]) ? $usuario->first_name : '') ?>"
								   required>

						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="last_name">Segundo
								apellido:</label>
							<input type="text" name="last_name" class="form-control col-lg-3"
								   placeholder="Segundo apellido"
								   id="last_name"
								   value="<?= set_value('last_name', isset($usuario->last_name[0]) ? $usuario->last_name : '') ?>"
								   required>

							<label class="col-lg-2 col-form-label form-control-label" for="user">Usuario:</label>
							<input type="text" name="user" class="form-control col-lg-3"
								   placeholder="Usuario para ingresar" id="user"
								   value="<?= set_value('user', isset($usuario->user[0]) ? $usuario->user : '') ?>"
								   required>

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
									$txt = ($usuario->DEPARTMENTS_id == $valores['id']) ? " selected" : " ";
									echo "<option " . $txt . " value='" . $valores['id'] . "'>" . $valores['name'] . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="role">Función del
								usuario:</label>
							<input type="text" class="form-control col-lg-3" name="role"
								   placeholder="Función del usuario" id="role"
								   value="<?= set_value('role', isset($usuario->role[0]) ? $usuario->role : '') ?>"
								   required>

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
