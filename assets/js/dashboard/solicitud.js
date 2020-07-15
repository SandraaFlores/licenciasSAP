(function () {
	$(".btn-acept, .btn-cancel").click(function (ev) {
		ev.preventDefault();
		var url = $(this).attr('href');
		var self = this;
		var message = 'Se aceptará la solicitud';
		if($(this).hasClass('.btn-cancel')){
			message = 'Se rechazará la solicitud';

		}
		Swal.fire({
			title: message,
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
					url: url,
					success: function () {
						$(self).parents('tr').remove();
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

})();
