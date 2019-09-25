<?php

	include ('header.php');
	include ('scripts.php');

?>
<script src="<?php echo base_url(); ?>public/js/Cliente.js"></script>
<script src="<?php echo base_url(); ?>public/js/util.js"></script>


<div class="posicao_conteudo">

	<h5 class="titulo_cliente"><span class="fa fa-user-plus"></span>Novo Cliente</h5>

	<hr class="linha_nova_ordem">

	<form id="formulario_cliente">
		<div class="row">
			<div class="col-lg-6">
				<label>Nome *</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_nome" id="cliente_nome" class="form-control"
						   aria-label="Nome do Cliente" aria-describedby="inputGroup-sizing-sm" required>
				</div>
			</div>

			<div class="col-lg-3">
				<label>CPF *</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_cpf" id="cliente_cpf" class="form-control"
						   aria-label="CPF do Cliente" aria-describedby="inputGroup-sizing-sm" required>
				</div>
			</div>

			<div class="col-lg-3">
				<label>RG:</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_rg" id="cliente_rg" class="form-control"
						   aria-label="RG do Cliente" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-5">
				<label>E-mail</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_email" id="cliente_email" class="form-control"
						   aria-label="E-mail" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>

			<div class="col-lg-2">
				<label>CEP</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_cep" id="cliente_cep" class="form-control"
						   aria-label="CEP" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>

			<div class="col-lg-3">
				<label>Cidade</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_cidade" id="cliente_cidade" class="form-control"
						   aria-label="Cidade" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>

			<div class="col-lg-2">
				<label>UF</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_uf" id="cliente_uf" class="form-control"
						   aria-label="Estado" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-5">
				<label>Endereço</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_endereco" id="cliente_endereco" class="form-control"
						   aria-label="Endereço" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>

			<div class="col-lg-2">
				<label>Número</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_numero" id="cliente_numero" class="form-control"
						   aria-label="Número" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>

			<div class="col-lg-5">
				<label>Bairro</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_bairro" id="cliente_bairro" class="form-control"
						   aria-label="Bairro" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-lg-3">
				<label>Complemento</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_complemento" id="cliente_complemento" class="form-control"
						   aria-label="Complemento" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>

			<div class="col-lg-3">
				<label>Telefone</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_telefone" id="cliente_telefone" class="form-control"
						   aria-label="Telefone" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>

			<div class="col-lg-3">
				<label>Celular *</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_celular" id="cliente_celular" class="form-control"
						   aria-label="Celular" aria-describedby="inputGroup-sizing-sm" required>
				</div>
			</div>
		</div>
		
		<div class="row">
			<button type="submit" class="btn btn-primary botao_acao">GRAVAR</button>
			<a href="<?php echo base_url();?>Clientes/index" class="btn btn-danger botao_acao" >CANCELAR</a>
		</div>
	</form>

	<!-- MENSAGEM DE CLIENTE CADASTRADO -->
	<div class="modal" tabindex="-1" role="dialog" id="msgClienteCadastro">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Novo Cliente</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p id="msgCliente"></p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgClienteOK" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

</div>
