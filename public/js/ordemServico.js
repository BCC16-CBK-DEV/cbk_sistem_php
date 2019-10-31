

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

		if($('#data_abertura_os').val() > $('#data_compra_os').val()) {
			$.ajax({
				type: "post",
				url: BASE_URL + "OrdemServico/novaOrdem",
				dataType: "json",
				data: $(this).serialize(),
				success: function (json) {
					if (json["status"] == 1) {
						$('#msgOrdem').html('Ocorreu erro ao cadastrar nova ordem de serviço!');
					} else {
						$('#msgOrdemCadastro').modal('show');
						$('#msgOrdem').html('Ordem de Serviço Cadastrada com Sucesso!');

					}
				},
				error: function (response) {
					console.log(response);
				}
			})
		} else {
			alert('A data de abertura da Ordem de Serviço não pode ser menor que data de compra do Produto!')
		}

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

		$('#botaoPeca').click(function () {
			var ordem = $('#id_ordem').val();
			var option = $('#peca').find(":selected").text();
			var idPeca = $('#peca').val();
			var quantidade = $('#quantidade_peca_ordem').val();


			if (idPeca != 0 ) {
				$.ajax({
					type: "post",
					url: BASE_URL + "OrdemServico/inserirPecaOrdem",
					dataType: "json",
					data: {idOrdem: ordem, idPeca: idPeca, quantidade: quantidade},
					success: function (json) {
						if (json["status"] == 1) {
						} else {
							window.location = window.location.href;
						}
					},
					error: function (response) {
						console.log(response);
					}
				})


				$('#peca').val(0);
				$('#quantidade_peca_ordem').val('');
			} else {
				alert('Selecionar Peça ou colocar quantidade!!');
			}


		})

})

function desbloquearCampoQtd() {
	if($('#peca').val() != 0) {
		document.getElementById('quantidade_peca_ordem').readOnly = false;
	} else {
		document.getElementById('quantidade_peca_ordem').readOnly = true;
	}
}

function excluirItem(id_peca_ordem,id_peca,quantidade_peca_ordem) {

	$("#msgOkExclusaoItem").click(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "OrdemServico/excluirItemPecaOrdem",
			data: {idPecaOrdem: id_peca_ordem, quantidadePecaOrdem: quantidade_peca_ordem, idpeca: id_peca},
			done: (window.location.href=window.location.href),
			error: function(response) {
				console.log(response);
			}
		})

		return false;
	});

}



