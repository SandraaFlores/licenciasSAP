$(document).ready(function () {
	$(document).on('click','.btn-show', function (env) {
		env.preventDefault();
		var modal = $('#solicitudModal')
			modal.modal('show');
		var url = $(this).attr('href')
		$.ajax({
			type: 'GET',
			url: url,
			success: function(respuesta) {
				console.log(respuesta);
				modal.find('.modal-body').html(respuesta)
			},
			error: function() {
				console.log("No se ha podido obtener la información");
			}
		});
	})
})
