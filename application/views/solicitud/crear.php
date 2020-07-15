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
	<title>Solicitar Licencia</title>
</head>

<body>
<div class="container">
	<div class="row pt-4">
		<div class="col-sm-12 mx-auto">
			<div class="card">
				<div class="card-header col-sm-12">
					<div>
						<img src="<?= base_url('assets/images/optima.png" alt="Optima" width="200" height="70"') ?>"/>
					</div>
					<div class="col-sm-6 mx-auto">
						<h5>Registro de usuarios en platafoma SAP.</h5>
						<h5>Departamento de Sistemas.</h5>
					</div>
				</div>
				<div class="card-body" style="padding: 10px">
					<form method="post" action="<?= base_url("SolicitudController/insertar"); ?>">
						<h4 align="right">
							<?php
							date_default_timezone_set("America/Mexico_City");
							$fechaActual = date('d-m-Y');
							echo $fechaActual;
							?>
						</h4>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="system">Sistema:</label>
							<select id="system" name="system" class="form-control col-lg-3" required autofocus>
								<option value="0">Selecciona una opción:</option>
								<?php
								$sql = "SELECT * FROM systems";
								$query = $conexion->query($sql);
								while ($valores = mysqli_fetch_array($query)) {
									echo "<option value='" . $valores['id'] . "'>" . $valores['name'] . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label"
								   for="justification">Justificación:</label>
							<textarea id="justification" name="justification" rows="4" cols="10"
									  placeholder="Escribe una justificación de tu solicitud aquí."
									  class="form-control col-lg-8" required></textarea>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label"
								   for="authorizations">Autorizaciones requeridas:</label>
							<textarea id="authorizations" name="authorizations" rows="4" cols="10"
									  placeholder="Escribe las autorizaciones requeridas de tu solicitud aquí (opcional)."
									  class="form-control col-lg-8"></textarea>
						</div>
						<div class="form-group row mx-0 autocomplete">
							<label class="col-lg-2 col-form-label form-control-label" for="user_copy">Copia del
								usuario:</label>
							<input type="text" class="form-control col-lg-3" name="user_copy" placeholder="Copia del usuario"
								   id="user_copy">

							<label class="col-lg-2 col-form-label form-control-label" for="types_of_user">Tipo de
								usuario:</label>
							<select id="types_of_user" name="types_of_user" class="form-control col-lg-3" required>
								<option value="0">Selecciona una opción:</option>
								<?php
								$sql = "SELECT * FROM types_of_users";
								$query = $conexion->query($sql);
								while ($valores = mysqli_fetch_array($query)) {
									echo "<option value='" . $valores['id'] . "'>" . $valores['name'] . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group row mx-0">
							<label class="col-lg-2 col-form-label form-control-label" for="observation">Observaciones
								generales:</label>
							<textarea id="observation" name="observation" rows="4" cols="10"
									  placeholder="Escribe tus observaciones generales aquí (opcional)."
									  class="form-control col-lg-8"></textarea>
						</div>
						<div class="button form-group">
							<div class="center">
								<button type="submit" class="btn btn-info btn-small"  id="submit" name="submit">Guardar
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
