(function () {
	$("tr td .btn-delete").click(function (ev) {
		ev.preventDefault();
		var fila = $(this).parents('tr').find('td:first').text();
		var id = $(this).attr('data_id');
		var self = this;
		Swal.fire({
			title: '¿Estás seguro que deseas eliminar el registro de ' + fila + '?',
			text: "¡No podrás revertir esto!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sí',
			cancelButtonText: 'No'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: 'POST',
					url: '/CodeIgniter/UsuariosController/delete',
					data: {'id': id},
					success: function () {
						$(self).parents('tr').remove();
						Swal(
							'Eliminado',
							'El registro se ha eliminado correctamente.',
							'success'
						)
					}, statusCode: {
						400: function (data) {
							var json = JSON.parse(data.responseText);
							Swal(
								'Error!',
								json.msg,
								'error'
							)
						}
					}
				});
			}
		})
	})

	$("tr td .btn-delete2").click(function (ev) {
		ev.preventDefault();
		var fila = $(this).parents('tr').find('td:first').text();
		var id = $(this).attr('data_id');
		var self = this;
		Swal.fire({
			title: '¿Estás seguro que deseas eliminar esta solicitud?',
			text: "¡No podrás revertir esto!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sí',
			cancelButtonText: 'No'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					data: {'id': id},
					success: function () {
						$(self).parents('tr').remove();
						Swal(
							'Eliminado',
							'El registro se ha eliminado correctamente.',
							'success'
						)
					}, statusCode: {
						400: function (data) {
							var json = JSON.parse(data.responseText);
							Swal(
								'Error!',
								json.msg,
								'error'
							)
						}
					}
				});
			}
		})
	})

	$("tr td #show").click(function (ev) {
		Swal.fire({
			title: '<strong>HTML <u>example</u></strong>',
			html:
				'You can use <b>bold text</b>, ' +
				'<a href="//sweetalert2.github.io">links</a> ' +
				'and other HTML tags',
			showCloseButton: true,
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonText:
				'<i class="fa fa-thumbs-up"></i> Great!',
			confirmButtonAriaLabel: 'Thumbs up, great!',
			cancelButtonText:
				'<i class="fa fa-thumbs-down"></i>',
			cancelButtonAriaLabel: 'Thumbs down'
		})
	})
})();
