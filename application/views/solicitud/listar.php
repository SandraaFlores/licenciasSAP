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
	<title>Mostrar licencias</title>
</head>

<body>
<div class="modal fade" id="solicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title ">Detalles de la solicitud</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row pt-4">
		<div class="col-sm-12 mx-auto">
			<h5 class="text-center"><?php echo $title?></h5>
			<table class="table table-bordered wy-table-responsive w-100">
				<thead>
				<tr>
					<th scope="col">Id</th>
					<th scope="col">Usuario</th>
					<th scope="col">Fecha y hora</th>
					<th scope="col">Mostrar</th>
					<th scope="col">Acciones</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($solicitudes as $item): ?>
					<tr>
						<th scope="row"><?= $item->id ?></th>
						<td><?= $item->name . " " . $item->first_name . " " . $item->last_name ?></td>
						<td><?= date("d-m-Y H:i:s", strtotime($item->create_time)) ?></td>
						<td><a class="btn btn-warning btn-show"
							   href="<?= base_url('SolicitudController/show/' . $item->id) ?>" role="button"><i
									class="fa fa-eye"></i></a>
						<td>	<?php if ($item->status == 0){ ?>
						<a class="btn btn-success btn-acept"
							   href="<?= base_url('SolicitudController/accept/' . $item->id) ?>" role="button"><i
									class="fa fa-check"></i></a>
							<a class="btn btn-danger btn-cancel"
							   href="<?= base_url('SolicitudController/cancel/' . $item->id) ?>" role="button"><i
									class="fa fa-times"></i></a>
						<?php } ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>
</body>
</html>
