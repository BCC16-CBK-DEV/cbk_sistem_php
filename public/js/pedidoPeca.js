$(function () {
	$('#formulario_nova_peca').submit(function (e) {
		e.preventDefault();

		$.ajax({
			type: "post",
			url: BASE_URL + "PedidoPeca/adicionarPeca",
			dataType: "json",
			data: $(this).serialize(),
			success: function(json) {
				if (json["status"] == 1) {
					$('#msgNovaPeca').html('Ocorreu erro ao cadastrar nova peça!');
				} else {
					$('#msgPecaCadastro').modal('show');
					$('#msgNovaPeca').html('Peça Cadastrada com Sucesso!');
					$('#AdicionarPeca').modal('hide');
				}
			},
			error: function(response) {
				console.log(response);
			}
		})

		return false;
	});
})

$(function () {
	$('#botaoNovaPeca').click(function () {
		$('#AdicionarPeca').modal('show');
	});

	$('#msgOKNovaPeca').click(function () {

		window.location.href=BASE_URL + "PedidoPeca/estoque";
	});


})

function alterar_peca(id_peca){

	$('#AlterarPeca').modal('show');

	$.ajax({
		type: "post",
		url: BASE_URL + "PedidoPeca/carregarPeca",
		dataType: "json",
		data: {id_peca: id_peca},
		success: function(response) {
			$('#formulario_alterar_peca')[0].reset();
			$.each(response['input'], function (id, value) {
				$('#'+id).val(value);
			});
		},
		error: function(response) {
			console.log(response);
		}
	})
}

function excluir_peca(id_peca){

	$("#msgOkExclusao").click(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "PedidoPeca/excluirPeca",
			data: {id_peca: id_peca},
			done: (window.location.href=BASE_URL + "PedidoPeca/estoque"),
			error: function(response) {
				console.log(response);
			}
		})

		return false;
	});
}

$(function () {
	$('#formulario_alterar_peca').submit(function (e) {
		e.preventDefault();
		$('#titulo_nova_peca').html('Alterar Peça');
		$.ajax({
			type: "post",
			url: BASE_URL + "PedidoPeca/atualizarPeca",
			dataType: "json",
			data: $(this).serialize(),
			success: function(json) {
				if (json["status"] == 1) {


					$('#msgNovaPeca').html('Ocorreu erro ao alterar as informações da peça!');
				} else {
					$('#msgPecaCadastro').modal('show');
					$('#msgNovaPeca').html('Peça Alterada com Sucesso!');
					$('#AlterarPeca').modal('hide');
				}
			},
			error: function(response) {
				console.log(response);
			}
		})

		return false;
	});

	$('#msgOKNovaPeca').click(function () {

		window.location.href=BASE_URL + "PedidoPeca/estoque";
	});
})
