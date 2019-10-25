<?php

	include ('header.php');
	include ('scripts.php');

?>
<script src="<?php echo base_url(); ?>public/js/Cliente.js"></script>
<script src="<?php echo base_url(); ?>public/js/util.js"></script>


<div class="posicao_conteudo">

	<h5 class="titulo_cliente"><span class="fa fa-user"></span>Alterar Cliente</h5>

	<hr class="linha_nova_ordem">

	<form id="formulario_alterar_cliente">
		<div class="row">
			<input type="hidden" name="id_cliente" id="id_cliente" class="form-control"
				   aria-label="Id do Cliente" aria-describedby="inputGroup-sizing-sm" value="<?php echo $cliente['id_cliente']; ?>">
			<div class="col-lg-6">
				<label>Nome *</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_nome" id="cliente_nome" class="form-control"
						   aria-label="Nome do Cliente" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['nome_cliente']; ?>" required >
				</div>
			</div>

			<div class="col-lg-3">
				<label>CPF *</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_cpf" id="cliente_cpf" class="form-control"
						   aria-label="CPF do Cliente" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['cpf']; ?>" required>
				</div>
			</div>

			<div class="col-lg-3">
				<label>RG:</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_rg" id="cliente_rg" class="form-control"
						   aria-label="RG do Cliente" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['rg']; ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-5">
				<label>E-mail</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_email" id="cliente_email" class="form-control"
						   aria-label="E-mail" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['email']; ?>">
				</div>
			</div>

			<div class="col-lg-2">
				<label>CEP</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_cep" id="cliente_cep" class="form-control"
						   aria-label="CEP" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['cep']; ?>">
				</div>
			</div>

			<div class="col-lg-3">
				<label>Cidade</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_cidade" id="cliente_cidade" class="form-control"
						   aria-label="Cidade" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['cidade']; ?>">
				</div>
			</div>

			<div class="col-lg-2">
				<label>UF</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_uf" id="cliente_uf" class="form-control"
						   aria-label="Estado" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['uf']; ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-5">
				<label>Endereço</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_endereco" id="cliente_endereco" class="form-control"
						   aria-label="Endereço" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['endereco']; ?>">
				</div>
			</div>

			<div class="col-lg-2">
				<label>Número</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_numero" id="cliente_numero" class="form-control"
						   aria-label="Número" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['numero']; ?>">
				</div>
			</div>

			<div class="col-lg-5">
				<label>Bairro</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_bairro" id="cliente_bairro" class="form-control"
						   aria-label="Bairro" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['bairro']; ?>">
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-lg-3">
				<label>Complemento</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="cliente_complemento" id="cliente_complemento" class="form-control"
						   aria-label="Complemento" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['complemento']; ?>">
				</div>
			</div>

			<div class="col-lg-3">
				<label>Telefone</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_telefone" id="cliente_telefone" class="form-control"
						   aria-label="Telefone" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['telefone']; ?>">
				</div>
			</div>

			<div class="col-lg-3">
				<label>Celular *</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cliente_celular" id="cliente_celular" class="form-control"
						   aria-label="Celular" aria-describedby="inputGroup-sizing-sm"  value="<?php echo $cliente['celular']; ?>" required>
				</div>
			</div>
		</div>
		
		<div class="row">
			<button type="submit" class="btn btn-primary botao_acao">GRAVAR</button>
			<a href="<?php echo base_url();?>Clientes/listagem" class="btn btn-danger botao_acao" >CANCELAR</a>
		</div>
	</form>

	<!-- MENSAGEM DE CLIENTE aLTERADO -->
	<div class="modal" tabindex="-1" role="dialog" id="msgClienteAlterado">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Alterar Cliente</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p id="msgClienteAlterar"></p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgClienteOK" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

</div>
