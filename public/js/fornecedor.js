$(function () {
	$('#botaoFiltro').click(function () {
		if($('#collapseFiltro').hasClass('show')){
			$('#collapseFiltro').collapse('hide');
		} else {
			$('#collapseFiltro').collapse('show');
		}
	});

	$("#formulario_fornecedor").submit(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "Fornecedores/adicionarFornecedor",
			dataType: "json",
			data: $(this).serialize(),
			success: function(json) {
				if (json["status"] == 1) {
					$('#msgFornecedor').html('Ocorreu erro ao cadastrar novo fornecedor!');
				} else {
					$('#msgFornecedorCadastro').modal('show');
					$('#msgFornecedorOK').html('Fornecedor Cadastrado com Sucesso!');

					$('#msgFornecedorOK').click(function () {
						window.location = BASE_URL + 'Fornecedores/listagem';
					});

				}
			},
			error: function(response) {
				console.log(response);
			}
		})


		return false;
	});

	$("#formulario_fornecedor_alterar").submit(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "Fornecedores/alterarFornecedor",
			dataType: "json",
			data: $(this).serialize(),
			success: function(json) {
				if (json["status"] == 1) {
					$('#msgFornecedor').html('Ocorreu erro ao alterar fornecedor!');
				} else {
					$('#msgFornecedorAlterar').modal('show');
					$('#msgFornecedor').html('Fornecedor Alterado com Sucesso!');

					$('#msgFornecedorOK').click(function () {
						window.location = BASE_URL + 'Fornecedores/listagem';
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

function alterar_fornecedor(id_fornecedor) {
	location.href = BASE_URL + "Fornecedores/editarFornecedor?id="+id_fornecedor;

}

function excluir_fornecedor(id_fornecedor) {
	$("#msgOkExclusao").click(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "Fornecedores/excluirFornecedor",
			data: {idFornecedor: id_fornecedor},
			done: (window.location.href=window.location.href),
			error: function(response) {
				console.log(response);
			}
		})

		return false;
	});

}
