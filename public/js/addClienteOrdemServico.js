$(function() {

	$("#AddCliente").click(function(){
		$("#AdicionarCliente").modal('show');
	});

	$("#formulario_cliente_os").submit(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "OrdemServico/novoCliente",
			dataType: "json",
			data: $(this).serialize(),
			success: function(json) {
				if (json["status"] == 1) {
					$('#msgCliente').html('Ocorreu erro ao cadastrar novo cliente!');
				} else {
					$('#msgClienteCadastro').modal('show');
					$('#msgCliente').html('Cliente Cadastrado com Sucesso!');

				}
			},
			error: function(response) {
				console.log(response);
			}
		})


		return false;
	});

	$('#msgOK').click(function () {
		$('#nome_cliente').val('');
		$('#cpf_cliente').val('');
		$('#celular_cliente').val('');
	});

	$('#InfoCliente').click(function () {
		var selecao = $('#clientes_select').val();

		$.ajax({
			type: "post",
			url: BASE_URL + "OrdemServico/dadosCliente",
			dataType: "json",
			data: {clientes_select: selecao},
			success: function(response) {
				$('#form_info_cliente')[0].reset();
				$.each(response['input'], function (id, value) {
					$('#'+id).val(value);
				});
			},
			error: function(response) {
				console.log(response);
			}
		})
		return false;
	});

	$('#InfoCliente').click(function () {
		if($('#nome_cliente_os').empty()) {
			alert('Favor Selecionar um cliente antes');
		}else {
			$('#informacoesCliente').modal('show');
		}
			//window.location = BASE_URL + 'OrdemServico/dadosCliente';
	});

	$('#SelecionarCliente').click(function () {

		$.ajax({
			url: BASE_URL+"OrdemServico/carregarClientes",
			type: 'post',
			dataType: 'html',
			success: function (data) {

			}
		});

		$('#Selecionar-Cliente').modal('show');

		//window.location = BASE_URL + 'OrdemServico/carregarClientes';
	});

});

