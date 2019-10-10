function alterar_ordem(id_ordem,status) {
	location.href = BASE_URL + "OrdemServico/editarOrdem?id="+id_ordem+'&status='+status;

}


function excluir_ordem(id_ordem,status) {

	$("#msgOkExclusao").click(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "OrdemServico/excluirOrdem",
			data: {idOrdem: id_ordem},
			done: (window.location.href=window.location.href),
			error: function(response) {
				console.log(response);
			}
		})

		return false;
	});

}

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

		$("#form_alterar_ordem").submit(function() {
			$.ajax({
				type: "post",
				url: BASE_URL + "OrdemServico/atualizarOrdem",
				dataType: "json",
				data: $(this).serialize(),
				success: function(json) {
					if (json["status"] == 1) {
						$('#msgOrdem').html('Ocorreu erro ao alterar ordem de serviço!');
					} else {
						$('#msgOrdemCadastro').modal('show');
						$('#msgOrdem').html('Ordem de Serviço Alterada com Sucesso!');

					}
				},
				error: function(response) {
					console.log(response);
				}
			})


			return false;
		});

})



