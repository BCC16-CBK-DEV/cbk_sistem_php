<?php
include ('header.php');
include ('scripts.php');

?>

<script src="<?php echo base_url(); ?>public/js/Cliente.js"></script>
<script src="<?php echo base_url(); ?>public/js/util.js"></script>


<div class="posicao_conteudo">

	<h5 class="titulo_cliente"><span class="fa fa-user-plus"></span>Novo Fornecedor</h5>

	<hr class="linha_nova_ordem">

	<form id="formulario_cliente">
		<div class="row">
			<div class="col-lg-6">
				<label>Nome *</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="" id="" class="form-control"
						   aria-label="Nome do Fornecedor" aria-describedby="inputGroup-sizing-sm" required>
				</div>
			</div>

			<div class="col-lg-3">
				<label>CNPJ *</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="" id="" class="form-control"
						   aria-label="CNPJ do Fornecedor" aria-describedby="inputGroup-sizing-sm" required>
				</div>
			</div>

			</div>

		<div class="row">
			<div class="col-lg-5">
				<label>E-mail</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="" id="" class="form-control"
						   aria-label="E-mail do Fornecedor" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>

			<div class="col-lg-3">
				<label>Telefone</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="" id="" class="form-control"
						   aria-label="Telefone" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>

		</div>

		<div class="row">
			<button type="submit" class="btn btn-primary botao_acao">GRAVAR</button>
			<a href="<?php echo base_url();?>Fornecedores/index" class="btn btn-danger botao_acao" >CANCELAR</a>
		</div>
	</form>

	<!-- MENSAGEM DE FORNECEDOR CADASTRADO -->
	<div class="modal" tabindex="-1" role="dialog" id="msgClienteCadastro">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Novo Fornecedor</h5>
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
