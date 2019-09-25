$(function () {

	$("#AddCliente").click(function(){
		$("#AdicionarCliente").modal('show');
	});

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
