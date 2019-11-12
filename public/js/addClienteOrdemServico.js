$(function() {

	$("#AddCliente").click(function(){
		$("#AdicionarCliente").modal('show');
	});

	$("#cpf_cliente").mask("999.999.999-99");
	$("#telefone_cliente").mask("(99) 9999-9999");
	$("#celular_cliente").mask("(99) 99999-9999");
	$("#cliente_telefone").mask("(99) 9999-9999");
	$("#rg_cliente").mask("99.999.999-9");
	$("#cep_cliente").mask("99999-999");

	$("#formulario_cliente_os").submit(function() {

			$.ajax({
				type: "post",
				url: BASE_URL + "OrdemServico/novoCliente",
				dataType: "json",
				data: $(this).serialize(),
				success: function (json) {
					if (json["status"] == 1) {
						$('#msgCliente').html('Ocorreu erro ao cadastrar novo cliente!');
					} else {
						$('#msgClienteCadastro').modal('show');
						$('#msgCliente').html('Cliente Cadastrado com Sucesso!');

					}
				},
				error: function (response) {
					console.log(response);
				}
			})


			return false;
});

	$('#msgOK').click(function () {
		$('#nome_cliente').val('');
		$('#cpf_cliente').val('');
		$('#celular_cliente').val('');

		$.ajax({
			type: "post",
			url: BASE_URL + "OrdemServico/selecionarUltimoCliente",
			dataType: "json",
			success: function(response) {
				$.each(response['input'], function (id, value) {
					$('#'+id).val(value);
				});

			},
			error: function(response) {
				console.log(response);
			}
		})

	});

	$('#InfoCliente').click(function () {
		var selecao = $('#os_cliente_id').val();
		console.log(selecao);

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
		if($('#os_cliente_id').val() == '') {
			alert('Favor Selecionar um cliente antes');
		}else {
			$('#informacoesCliente').modal('show');
		}
			//window.location = BASE_URL + 'OrdemServico/dadosCliente';
	});

	$('#SelecionarCliente').click(function () {

		$('#Selecionar-Cliente').modal('show');
		//window.location = BASE_URL + 'OrdemServico/carregarClientes';
	});


});

function enviaID(id_cliente) {

	$.ajax({
		type: "post",
		url: BASE_URL + "OrdemServico/selecionarCliente",
		dataType: "json",
		data: {idCliente: id_cliente},
		success: function(response) {
			$.each(response['input'], function (id, value) {
				$('#'+id).val(value);
			});

			$('#Selecionar-Cliente').modal('hide');
		},
		error: function(response) {
			console.log(response);
		}
	})
}

function ValidarCPF(Objcpf){
	var cpf = Objcpf.value;
	exp = /\.|\-/g
	cpf = cpf.toString().replace( exp, "" );
	var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
	var soma1=0, soma2=0;
	var vlr =11;

	for(i=0;i<9;i++){
		soma1+=eval(cpf.charAt(i)*(vlr-1));
		soma2+=eval(cpf.charAt(i)*vlr);
		vlr--;
	}
	soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
	soma2=(((soma2+(2*soma1))*10)%11);

	var digitoGerado=(soma1*10)+soma2;
	if(digitoGerado!=digitoDigitado)
		alert('CPF Invalido!');
}



