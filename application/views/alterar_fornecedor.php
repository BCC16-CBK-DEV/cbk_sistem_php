<?php
include ('header.php');
include ('scripts.php');

?>

<div class="posicao_conteudo">

	<h5 class="titulo_cliente"><span class="fa fa-user-plus"></span>Alterar Fornecedor</h5>

	<hr class="linha_nova_ordem">

	<form id="formulario_fornecedor_alterar" method="post">
		<div class="row">
			<input type="hidden" id="id_fornecedor_alterar" name="id_fornecedor_alterar"
				   value="<?php echo $fornecedor['id_fornecedor']; ?>">
			<div class="col-lg-6">
				<label>Nome *</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="nome_fornecedor_alterar" id="nome_fornecedor_alterar" class="form-control"
						   aria-label="Nome do Fornecedor" aria-describedby="inputGroup-sizing-sm" required
						   value="<?php echo $fornecedor['nome_fornecedor']; ?>">
				</div>
			</div>

			<div class="col-lg-3">
				<label>CNPJ *</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="cnpj_fornecedor_alterar" id="cnpj_fornecedor_alterar" class="form-control"
						   aria-label="CNPJ do Fornecedor" aria-describedby="inputGroup-sizing-sm" required
						   value="<?php echo $fornecedor['cnpj_fornecedor']; ?>">
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-lg-5">
				<label>E-mail</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="email_fornecedor_alterar" id="email_fornecedor_alterar" class="form-control"
						   aria-label="E-mail do Fornecedor" aria-describedby="inputGroup-sizing-sm"
						   value="<?php echo $fornecedor['email_fornecedor']; ?>">
				</div>
			</div>

			<div class="col-lg-3">
				<label>Telefone</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="telefone_fornecedor_alterar" id="telefone_fornecedor_alterar" class="form-control"
						   aria-label="Telefone" aria-describedby="inputGroup-sizing-sm"
						   value="<?php echo $fornecedor['telefone_fornecedor']; ?>">
				</div>
			</div>

		</div>

		<div class="row">
			<button type="submit" class="btn btn-primary botao_acao">GRAVAR</button>
			<a href="<?php echo base_url();?>Fornecedores/listagem" class="btn btn-danger botao_acao" >CANCELAR</a>
		</div>
	</form>

	<!-- MENSAGEM DE FORNECEDOR ALTERADO -->
	<div class="modal" tabindex="-1" role="dialog" id="msgFornecedorAlterar">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Alterar Fornecedor</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p id="msgFornecedor"></p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgFornecedorOK" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

</div>
