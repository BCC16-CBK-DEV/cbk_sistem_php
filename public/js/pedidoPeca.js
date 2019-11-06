$(function () {
	$('#botaoPeca').click(function () {
		var option = $('#peca').find(":selected").text();
		var idPeca = $('#peca').val();
		var quantidade = $('#quantidade_peca_ordem').val();

		var row = $("<tr>");

		row.append($("<td>"+idPeca+"</td>"))
			.append($("<td>"+option+"</td>"))
			.append($("<td>"+quantidade+"</td>"))
			.append($("<td><a class='botaoAcoesTabela botaoEditar' id='botaoExcluiritemPeca' onclick='removeLinha(this);'><span class='fa fa-trash-o'></span></a></td></tr></td>"));

		$("#tabela_pedido_peca tbody").append(row);

		$('#peca').val('0');
		document.getElementById('quantidade_peca_ordem').readOnly = true;
		$('#quantidade_peca_ordem').val('');

	});

	$('#botaoFiltroPedido').click(function () {
		if($('#collapseFiltro').hasClass('show')){
			$('#collapseFiltro').collapse('hide');
		} else {
			$('#collapseFiltro').collapse('show');
		}
	});

	$('#botaoGravarPedido').click(function () {
		fornecedor = $('#fornecedor_pedido').val();
		assunto = $('#assunto_pedido').val();
		data = $('#data_pedido').val();

		var array = [];
		var trsa = document.getElementById( 'tabela_pedido_peca' ).rows ;
		for ( var b = 1 ; b < trsa.length ; b++ ) {
			array[b - 1] = [trsa[b].cells[0].innerHTML,trsa[b].cells[2].innerHTML];
		}

		console.log(array);

		$.ajax({
			type: "post",
			url: BASE_URL + "PedidoPeca/adicionarPedido",
			dataType: "json",
			data: {array: array, fornecedor: fornecedor, assunto: assunto, data: data},
			success: function(json) {
				if (json["status"] == 1) {

				} else {
					$('#msgPedidoCadastro').modal('show');
					$('#msgNovoPedido').html('Pedido Cadastrado com Sucesso!');
				}
			},
			error: function(response) {
				console.log(response);
			}
		})

	});

	$('#botaoAlterarPedido').click(function () {
		id_pedido = $('#id_pedido').val();
		fornecedor = $('#fornecedor_pedido').val();
		assunto = $('#assunto_pedido').val();
		data = $('#data_pedido').val();

		console.log(id_pedido);

		$.ajax({
			type: "post",
			url: BASE_URL + "PedidoPeca/editarPedido",
			dataType: "json",
			data: {id_pedido: id_pedido, fornecedor: fornecedor, assunto: assunto, data: data},
			success: function(json) {
				if (json["status"] == 1) {

				} else {
					$('#msgPedidoCadastro').modal('show');
					$('#msgNovoPedido').html('Pedido Alterado com Sucesso!');
				}
			},
			error: function(response) {
				console.log(response);
			}
		})

	});

	$('#botaoPedidoPecaAlterar').click(function () {
		id_pedido = $('#id_pedido').val();
		peca = $('#peca').val();
		quantidade = $('#quantidade_peca_pedido').val();

		$.ajax({
			type: "post",
			url: BASE_URL + "PedidoPeca/editarPedido_peca",
			dataType: "json",
			data: {id_pedido: id_pedido, peca: peca, quantidade: quantidade},
			success: function(json) {
				if (json["status"] == 1) {

				} else {
					window.location = window.location.href;
				}
			},
			error: function(response) {
				console.log(response);
			}
		})

	});

})

function removeLinha(linha) {
	var i=linha.parentNode.parentNode.rowIndex;
	document.getElementById('tabela_pedido_peca').deleteRow(i);
}

function excluir_peca_pedido(id_peca_item){

	$("#msgOkExclusaoPecaPedido").click(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "PedidoPeca/excluirPecaItemPedido",
			data: {id_peca_item: id_peca_item},
			done: (window.location = window.location.href),
		error: function(response) {
			console.log(response);
		}
	})

		return false;
	});
}

$(function () {
	$('#botaoNovaPeca').click(function () {
		$('#AdicionarPeca').modal('show');
	});

	$('#msgOKNovaPeca').click(function () {

		window.location.href=BASE_URL + "PedidoPeca/estoque";
	});

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
	})

	$('#botao_info_fornecedor').click(function () {
		if($('#fornecedor_pedido').val() == '0'){
			alert("Selecionar o fornecedor para exibir as informações!");
		} else {
			$('#informacoesFornecedor').modal('show');
		}
	})

	$('#botao_info_fornecedor').click(function () {
		var selecao = $('#fornecedor_pedido').val();
		//console.log(selecao);

		$.ajax({
			type: "post",
			url: BASE_URL + "PedidoPeca/dadosFornecedor",
			dataType: "json",
			data: {fornecedor_select: selecao},
			success: function(response) {
				$('#form_info_fornecedor')[0].reset();
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

	$('#botaoEmail').click(function () {
		id_pedido = $('#id_pedido').val();
		fornecedor = $('#fornecedor_pedido').val();
		assunto = $('#assunto_pedido').val();
		data = $('#data_pedido').val();

		console.log(id_pedido);

		$.ajax({
			type: "post",
			url: BASE_URL + "PedidoPeca/enviarPedido",
			dataType: "html",
			data: {id_pedido: id_pedido, fornecedor: fornecedor, assunto: assunto, data: data},
			beforeSend: function() {
				$('.load').show();
			},
			success: function(response) {
				alert('Enviado');
				$('.load').hide();
			},
			error: function(response) {
				console.log(response);
			}
		})



	});

})

function desbloquearCampoQtd() {

	if($('#peca').val() != 0) {
		document.getElementById('quantidade_peca_pedido').readOnly = false;
	} else {
		document.getElementById('quantidade_peca_pedido').readOnly = true;
	}
}

function alterar_pedido(id_pedido){
	location.href = BASE_URL + "PedidoPeca/alterarPedido?id="+id_pedido;
}

function excluir_pedido(id_pedido){
	$('#msgOkExclusao').click(function () {
		$.ajax({
			type: "post",
			url: BASE_URL + "PedidoPeca/excluirPedido",
			dataType: "json",
			data: {id_pedido: id_pedido},
			done: (window.location = window.location.href),
			error: function(response) {
				console.log(response);
			}
		})
	})

}
