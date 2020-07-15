<?php
$conexion = mysqli_connect('localhost', 'root', '', 'licencias');
?>
<div class="form-group row ">
	<label class="col-lg-3 col-form-label form-control-label" for="system">Sistema:</label>
	<select id="system" name="system" class="form-control col-lg-3" disabled="disabled" >
		<option value="0">Selecciona una opción:</option>
		<?php
		$sql = "SELECT * FROM systems";
		$query = $conexion->query($sql);
		while ($valores = mysqli_fetch_array($query)) {
			$txt = ($vista->SYSTEMS_id == $valores['id'])?" selected":" ";
			echo "<option ".$txt." value='" . $valores['id'] . "'>" . $valores['name'] . "</option>";
		}
		?>
	</select>
</div>
<div class="form-group row ">
	<label class="col-lg-3 col-form-label form-control-label"
		   for="justification">Justificación:</label>
	<textarea id="justification" name="justification" rows="3" cols="10"
			  placeholder="Escribe una justificación de tu solicitud aquí."
			  class="form-control col-lg-8" disabled="disabled"><?=$vista->justification?> </textarea>
</div>
<div class="form-group row ">
	<label class="col-lg-3 col-form-label form-control-label"
		   for="authorizations">Autorizaciones requeridas:</label>
	<textarea id="authorizations" name="authorizations" rows="3" cols="10"
			  placeholder="Escribe las autorizaciones requeridas de tu solicitud aquí (opcional)."
			  class="form-control col-lg-8" disabled="disabled"> <?= $vista->authorization?></textarea>
</div>
<div class="form-group row autocomplete">
	<label class="col-lg-4 col-form-label form-control-label" for="user_copy">Copia del
		usuario:</label>
	<input type="text" class="form-control col-lg-4" name="user_copy" placeholder="Copia del usuario"
		   id="user_copy" value="<?= $vista->user_copy?>" disabled="disabled">
</div>
<div class="form-group row">
	<label class="col-lg-4 col-form-label form-control-label" for="types_of_user">Tipo de
		usuario:</label>
	<select id="types_of_user" name="types_of_user" class="form-control col-lg-4" disabled="disabled">
		<option value="0">Selecciona una opción:</option >
		<?php
		$sql = "SELECT * FROM types_of_users";
		$query = $conexion->query($sql);
		while ($valores = mysqli_fetch_array($query)) {

			$txt = ($vista->TYPES_OF_USERS_id == $valores['id'])?" selected":" ";
			echo "<option ".$txt." value='" . $valores['id'] . "'>" . $valores['name'] . "</option>";
		}
		?>
	</select>
</div>
<div class="form-group row">
	<label class="col-lg-3 col-form-label form-control-label" for="observation">Observaciones
		generales:</label>
	<textarea id="observation" name="observation" rows="3" cols="10"
			  placeholder="Escribe tus observaciones generales aquí (opcional)."
			  class="form-control col-lg-8" disabled="disabled"><?= $vista->observation?></textarea>
</div>
