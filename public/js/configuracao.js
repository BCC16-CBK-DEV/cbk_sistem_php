$(function () {

	$("#formulario_autorizada").submit(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "Configuracoes/alterarAutorizada",
			dataType: "json",
			data: $(this).serialize(),
			success: function(json) {
				if (json["status"] == 1) {
					$('#msgAutorizada').html('Ocorreu erro ao alterar as informações da Autorizada!');
				} else {
					$('#msgInfoAutorizada').modal('show');
					$('#msgAutorizadaOK').html('Realizado a Alteração da Autorizada com Sucesso!');

					$('#msgAutorizadaOK').click(function () {
						window.location = window.location.href;
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

	$('#botaoNovoUsuario').click( function () {
		$('#AdicionarNovoUsuario').modal('show');
	});

	$('#formulario_novo_usuario').submit(function () {

		$.ajax({
			type: "post",
			url: BASE_URL + "Configuracoes/novoUsuario",
			dataType: "json",
			data: $(this).serialize(),
			success: function (json) {
				if (json["status"] == 1) {
					$('#msgUsuarioCadastro').modal('show');
					$('#msgAutorizada').html('Ocorreu erro ao adicionar um Novo Usuário!');
				} else {
					$('#msgUsuarioCadastro').modal('show');
					$('#msgNovoUsuario').html('Realizado o Cadastro do novo usuário com Sucesso!');
					$('#AdicionarNovoUsuario').modal('hide');

				}
			},
			error: function (response) {
				console.log(response);
			}
		})
	});

	$('#msgOKNovoUsuario').click(function () {
		window.location = window.location.href;
	})

})

function alterar_usuario(id_usuario){

	$('#AlterarUsuario').modal('show');

	$.ajax({
		type: "post",
		url: BASE_URL + "Configuracoes/carregarUsuario",
		dataType: "json",
		data: {id_usuario: id_usuario},
		success: function(response) {
			$('#formulario_alterar_usuario')[0].reset();
			$.each(response['input'], function (id, value) {
				$('#'+id).val(value);
			});
		},
		error: function(response) {
			console.log(response);
		}
	})
}

function excluir_usuario(id_usuario){

	$("#msgOkExclusao").click(function() {
		$.ajax({
			type: "post",
			url: BASE_URL + "Configuracoes/excluirUsuario",
			data: {id_usuario: id_usuario},
			done: (window.location.href=BASE_URL + "Configuracoes/usuarios"),
			error: function(response) {
				console.log(response);
			}
		})

		return false;
	});
}

$(function () {

	$('#formulario_alterar_usuario').submit(function (e) {
		e.preventDefault();
		$('#titulo_nova_peca').html('Alterar Usuário');
		$.ajax({
			type: "post",
			url: BASE_URL + "Configuracoes/atualizaUsuario",
			dataType: "json",
			data: $(this).serialize(),
			success: function (json) {
				if (json["status"] == 1) {
					$('#msgUsuarioCadastro').modal('show');
					$('#msgAutorizada').html('Ocorreu erro ao adicionar um Novo Usuário!');
				} else {
					$('#msgUsuarioCadastro').modal('show');
					$('#msgNovoUsuario').html('Realizado o Cadastro do novo usuário com Sucesso!');
					$('#AlterarUsuario').modal('hide');

				}
			},
			error: function (response) {
				console.log(response);
			}
		})
	});

	$('#msgOKUsuario').click(function () {
		window.location = window.location.href;
	})
});
