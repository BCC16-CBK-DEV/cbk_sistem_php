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
	
	$('#botaoRelatorioCliente').click(function () {
		nome = $('#filtro_cliente_nome').val();
		cpf = $('#filtro_cliente_cpf').val();
		email = $('#filtro_cliente_email').val();
		celular = $('#filtro_cliente_celular').val();

		window.open(BASE_URL + "Clientes/relatorio_cliente?nome="+nome+"&cpf="+cpf+"&email="+email+"&celular="+celular);

	});
})

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
