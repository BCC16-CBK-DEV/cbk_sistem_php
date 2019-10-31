$(function () {

	$("#AddCliente").click(function(){
		$("#AdicionarCliente").modal('show');
	});

	$('#cliente_cpf').mask("999.999.999-99");
	$('#filtro_cliente_cpf').mask("999.999.999-99");
	$('#cliente_rg').mask("99.999.999-9");
	$('#cliente_celular').mask("(99) 99999-9999");
	$('#filtro_cliente_celular').mask("(99) 99999-9999");
	$('#cliente_telefone').mask("(99) 9999-9999");
	$('#cliente_cep').mask("99999-999");


	$("#formulario_cliente").submit(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "Clientes/adicionarCliente",
			dataType: "json",
			data: $(this).serialize(),
			success: function(json) {
				if (json["status"] == 1) {
					$('#msgCliente').html('Ocorreu erro ao cadastrar novo cliente!');
				} else {
					$('#msgClienteCadastro').modal('show');
					$('#msgCliente').html('Cliente Cadastrado com Sucesso!');

					$('#msgClienteOK').click(function () {
						window.location = BASE_URL + 'Clientes/listagem';
					});

				}
			},
			error: function(response) {
				console.log(response);
			}
		})


		return false;
	});

	$('#botaoFiltro').click(function () {
		if($('#collapseFiltro').hasClass('show')){
			$('#collapseFiltro').collapse('hide');
		} else {
			$('#collapseFiltro').collapse('show');
		}
	});
});

function alterar_cliente(id_cliente) {
	location.href = BASE_URL + "Clientes/alterarCliente?id="+id_cliente;
}

function excluir_cliente(id_cliente){
	$('#msgOkExclusao').click(function () {
		$.ajax({
			type: "post",
			url: BASE_URL + "Clientes/excluirCliente",
			dataType: "json",
			data: {id_cliente: id_cliente},
			done: (window.location = window.location.href),
			error: function(response) {
				console.log(response);
			}
		})
	})

}

$(function () {
	$("#formulario_alterar_cliente").submit(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "Clientes/editarCliente",
			dataType: "json",
			data: $(this).serialize(),
			success: function(json) {
				if (json["status"] == 1) {
					$('#msgCliente').html('Ocorreu erro ao alterar cliente!');
				} else {
					$('#msgClienteAlterado').modal('show');
					$('#msgClienteAlterar').html('Cliente Alterado com Sucesso!');

					$('#msgClienteOK').click(function () {
						window.location = BASE_URL + 'Clientes/listagem';
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
