$(function () {
	$('#botaoFiltro').click(function () {
		if($('#collapseFiltro').hasClass('show')){
			$('#collapseFiltro').collapse('hide');
		} else {
			$('#collapseFiltro').collapse('show');
		}
	});
})

$(function () {

	$("#form_nova_ordem").submit(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "OrdemServico/novaOrdem",
			dataType: "json",
			data: $(this).serialize(),
			success: function(json) {
				if (json["status"] == 1) {
					$('#msgOrdem').html('Ocorreu erro ao cadastrar nova ordem de serviço!');
				} else {
					$('#msgOrdemCadastro').modal('show');
					$('#msgOrdem').html('Ordem de Serviço Cadastrada com Sucesso!');

				}
			},
			error: function(response) {
				console.log(response);
			}
		})


		return false;
	});


	$('#msgOKOrdem').click(function () {
		window.location = BASE_URL + 'OrdemServico/os_abertas';
	})

})

$(function () {

	function altera_ordem(id_ordem) {

		$.ajax({
			type: "post",
			url: BASE_URL + "OrdemServico/alteraOrdem",
			dataType: "json",
			data: {idOrdem: id_ordem},
			success: function(response) {
				$.each(response['input'], function (id, value) {
					$('#'+id).val(value);
				});

			},
			error: function(response) {
				console.log(response);
			}
		})
	}

})
