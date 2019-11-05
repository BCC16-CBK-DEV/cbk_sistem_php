$(function () {

	$("#formulario_autorizada").submit(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "Configuracoes/alterarAutorizada",
			dataType: "json",
			data: $(this).serialize(),
			success: function(json) {
				if (json["status"] == 1) {
					$('#msgAutorizada').html('Ocorreu erro ao alterar as informações da Autorizada!');
				} else {
					$('#msgInfoAutorizada').modal('show');
					$('#msgAutorizadaOK').html('Realizado a Alteração da Autorizada com Sucesso!');

					$('#msgAutorizadaOK').click(function () {
						window.location = window.location.href;
					});

				}
			},
			error: function(response) {
				console.log(response);
			}
		})


		return false;
	});

})
