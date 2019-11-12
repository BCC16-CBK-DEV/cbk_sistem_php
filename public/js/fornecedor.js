$(function () {
	$('#botaoFiltro').click(function () {
		if($('#collapseFiltro').hasClass('show')){
			$('#collapseFiltro').collapse('hide');
		} else {
			$('#collapseFiltro').collapse('show');
		}
	});

	$("#cnpj_fornecedor").mask("99.999.999/9999-99");
	$("#cnpj_fornecedor_alterar").mask("99.999.999/9999-99");
	$("#telefone_fornecedor").mask("(99) 9999-9999");
	$("#telefone_fornecedor_alterar").mask("(99) 9999-9999");

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

	$('#botaoRelatorioFornecedor').click(function () {
		nome = $('#filtro_fornecedor_nome').val();
		cnpj = $('#filtro_fornecedor_cnpj').val();
		email = $('#filtro_fornecedor_email').val();
		telefone = $('#filtro_fornecedor_telefone').val();

		window.open(BASE_URL + "Fornecedores/relatorio_fornecedor?nome="+nome+"&cnpj="+cnpj+"&email="+email+"&telefone="+telefone);
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
