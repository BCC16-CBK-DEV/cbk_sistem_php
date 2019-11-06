<?php
include 'header.php';
include 'scripts.php';
?>

<div class="posicao_conteudo">
	<h4 class="titulo_opcoes"><span class="fa fa-plus-circle"></span> Cadastro de Pedido de Peça</h4>
		<hr class="linha_menu_pedido">
		<div class="row secao_pedido">
			<div class="row">
				<h5 class="">Informações do Pedido</h5>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label>Assunto do Pedido</label>
					<div class="input-group input-group-sm mb-">
						<input type="text" class="form-control" aria-label="Número da Ordem"  aria-describedby="inputGroup-sizing-sm"
							   id="assunto_pedido" name="assunto_pedido">
					</div>
				</div>
				<div class="col-mb-2">
					<label>Data do Pedido</label>
					<div class="input-group input-group-sm mb-3">
						<input type="date" class="form-control" aria-label="Data de Abertura"  aria-describedby="inputGroup-sizing-sm"
							   id="data_pedido" name="data_pedido">
					</div>
				</div>
			</div>
		</div>
		<hr class="linha_menu_pedido">
		<div class="row secao_pedido">
			<div class="row">
				<h5 class="">Fornecedor do Pedido</h5>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<label>Fornecedor</label>
					<select id="fornecedor_pedido" name="fornecedor_pedido" class="form-control form-control-sm ">
						<option value="0">Selecionar Fornecedor</option>
						<?php
						foreach($fornecedores as $forn):
							echo '<option value="'.$forn['id_fornecedor'].'">'.$forn['nome_fornecedor'].'</option>';
						endforeach;
						?>
					</select>
				</div>
				<div class="col-sm-2">
					<a id="botao_info_fornecedor" class="btn btn-primary">Informação do Fornecedor</a>
				</div>
			</div>

		</div>

		<hr class="linha_menu_pedido">
		<div class="row secao_pedido">
			<div class="row">
				<h5 class="">Peças</h5>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<label>Peça</label>
					<select id="peca" name="peca" onchange="desbloquearCampoQtd();"  class="form-control form-control-sm ">
						<option value="0">Selecionar Peça</option>
						<?php
						foreach($pecas as $peca):
							echo '<option value="'.$peca['id_peca'].'">'.$peca['descricao_peca'].'</option>';
						endforeach;
						?>
					</select>
				</div>
				<div class="col-sm-2">
					<label>Quantidade</label>
					<div class="input-group input-group-sm mb-">
						<input type="number" class="form-control" aria-label="Quantidade Peça" readonly="true" aria-describedby="inputGroup-sizing-sm"
							   id="quantidade_peca_pedido" name="quantidade_peca_pedido">
					</div>
				</div>
				<a id="botaoPeca" class="btn btn-primary">Adicionar Peça</a>
			</div>

			<div class="row">
				<table id="tabela_pedido_peca" class="table tabela_os_abertas">
					<thead class="thead-dark">
					<tr>
						<th scope="col">ID Peça</th>
						<th scope="col">Descrição Peça</th>
						<th scope="col">Quantidade</th>
						<th scope="col">Ações</th>
					</tr>
					</thead>
					<tbody>
					<?php
					?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<button type="button" id="botaoGravarPedido" class="btn btn-primary botao_acao">GRAVAR</button>
			<a href="<?php echo base_url();?>PedidoPeca/index" class="btn btn-danger botao_acao" >CANCELAR</a>
		</div>

	<?php include 'modal_info_fornecedor.php'; ?>

	<!-- MENSAGEM DE PEDIDO PEÇA -->
	<div class="modal" tabindex="-1" role="dialog" id="msgPedidoCadastro">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Pedido de Peça</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p id="msgNovoPedido"></p>
				</div>
				<div class="modal-footer">
					<a  class="btn btn-primary botao_acao"
						href="<?php echo base_url() . 'PedidoPeca/pedidos'; ?>">OK</a>
				</div>
			</div>
		</div>
	</div>
</div>
