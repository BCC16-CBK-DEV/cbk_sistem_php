$(function () {
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
})
