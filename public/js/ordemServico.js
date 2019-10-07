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
		$.ajax({
			type: "post",
			url: BASE_URL + "OrdemServico/novaOrdem",
			dataType: "json",
			data: $(this).serialize(),
			success: function(json) {
				if (json["status"] == 1) {
					$('#msgOrdem').html('Ocorreu erro ao cadastrar nova ordem de serviço!');
				} else {
					$('#msgOrdemCadastro').modal('show');
					$('#msgOrdem').html('Ordem de Serviço Cadastrada com Sucesso!');

				}
			},
			error: function(response) {
				console.log(response);
			}
		})


		return false;
	});


	$('#msgOKOrdem').click(function () {
		window.location = BASE_URL + 'OrdemServico/os_abertas';
	})

})

$(function () {

	$('#form_filtro_ordem').submit(function () {
		var option = 0;

		if ($('#filtro_numero_final').val() != '' || $('#filtro_numero_inicial').val() != '') {
			option = 1;
		}  else if ($('#filtro_data_inicial').val() != '' || $('#filtro_data_final').val() != '') {
			option = 2;
		} else {
			option = 3;
		}

		//var data = $('#form_filtro_ordem').serializeArray();
		//data.push({name: "option", value: option});

		$.ajax({
			type: "post",
			url: BASE_URL + "OrdemServico/filtroOrdem",
			dataType: "json",
			data: {numero_inicial: $('#filtro_numero_inicial').val()},
			success: function(json) {
				window.location = BASE_URL + 'OrdemServico/filtroOrdem';
				console.log(dados);
			},
			error: function(response) {
				console.log(response);
			}
		})


		return false;


	})

})
