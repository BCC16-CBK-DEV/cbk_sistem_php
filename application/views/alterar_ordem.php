<?php

include ('header.php');
include ('scripts.php');

?>
<script src="<?php echo base_url(); ?>public/js/addClienteOrdemServico.js"></script>
<script src="<?php echo base_url(); ?>public/js/ordemServico.js"></script>

<div class="posicao_conteudo">

	<h4 class="titulo_opcoes"><span class="fa fa-cog"></span> Alterar Ordem</h4>
	<hr class="linha_nova_ordem">
	<form id="form_alterar_ordem" method="post">
		<h5>Informações sobre a O.S.</h5>
		<div class="row">
			<div class="col-sm-2">
				<input type="hidden" class="form-control" readonly=“true”
					   id="id_ordem" name="id_ordem" value="<?php echo $this->input->get('id'); ?>">
				<label>Nº Ordem</label>
				<div class="input-group input-group-sm mb-">
					<input type="text" class="form-control" readonly=“true” aria-label="Número da Ordem"  aria-describedby="inputGroup-sizing-sm"
						   id="numero_ordem_os" name="numero_ordem_os" value="<?php echo $os['numero_ordem']; ?>">
				</div>
			</div>
			<div class="col-mb-2">
				<label>Data de Abertura</label>
				<div class="input-group input-group-sm mb-3">
					<input type="date" class="form-control" aria-label="Data de Abertura"  aria-describedby="inputGroup-sizing-sm"
						   id="data_abertura_os" name="data_abertura_os" value="<?php echo $os['data_abertura']; ?>">
				</div>
			</div>
			<div class="col-mb-2">
				<label>Data do Prazo</label>
				<div class="input-group input-group-sm mb-3">
					<input type="date" class="form-control" aria-label="Prazo da OS"  aria-describedby="inputGroup-sizing-sm"
						   id="data_prazo_os" name="data_prazo_os" value="<?php echo $os['prazo_ordem']; ?>">
				</div>
			</div>
			<div class="col-sm-2">
				<label>Valor da M.O.</label>
				<div class="input-group input-group-sm mb-">
					<input type="text" class="form-control" aria-label="Número da Ordem"  aria-describedby="inputGroup-sizing-sm"
						   id="valor_os" name="valor_os" value="<?php echo $os['valor_ordem']; ?>">
				</div>
			</div>
			<div class="col-sm-3">
				<label>Status da OS</label>
				<select id="status_os" name="status_os" class="form-control form-control-sm ">
					<option value="0">Selecionar Status</option>
					<?php
					foreach($status as $st):
						echo '<option value="'.$st['id_status'].'" '.($st['id_status'] == $os['id_status'] ? 'selected':'' ).'>'.$st['nome_status'].'</option>';
					endforeach;
					?>
				</select>
			</div>

		</div>

		<div class="row">
			<div class="col-sm-3">
				<label>Técnico da OS</label>
				<select id="tecnico_os" name="tecnico_os" class="form-control form-control-sm ">
					<option value="0">Selecionar Técnico</option>
					<?php
					foreach($tecnicos as $tec):
						echo '<option value="'.$tec['id_usuario'].'" '.($tec['id_usuario'] == $os['id_tecnico'] ? 'selected':'' ).'>'.$tec['nome_completo'].'</option>';
					 endforeach;
					?>
				</select>
			</div>
		</div>

		<div class="row" id="textAreaObservacao">
			<div class="col-sm-11">
				<label>Observação do Técnico</label>
				<div class="input-group input-group-sm mb-3">
					<textarea class="form-control" id="observacaoTecnico" name="observacaoTecnico" rows="3"
							  ><?php echo $os['observacao_tecnico']; ?></textarea>
				</div>
			</div>
		</div>
		<hr class="linha_nova_ordem">

		<div class="row">
			<h5>Peças para O.S.</h5>
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
						   id="quantidade_peca_ordem" name="quantidade_peca_ordem">
				</div>
			</div>
			<a id="botaoPeca" class="btn btn-primary">Adicionar Peça</a>
		</div>
		<div class="row">
			<table id="tabela_peca" class="table tabela_os_abertas">
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
				foreach ($peca_item as $item) {
					echo '<tr><th scope="row">'.$item['id_peca'].'</th>';
					echo '<td>'.$item['descricao_peca'].'</td>';
					echo '<td>'.$item['quantidade_peca_ordem'].'</td>';
					echo '<td><a class="botaoAcoesTabela botaoEditar" id="botaoExcluirOrdem" 
					data-toggle="modal" data-target="#msgOrdemItemPecaExclusao" onclick="excluirItem('.$item['id_peca_ordem'].','.$item['id_peca'].','.$item['quantidade_peca_ordem'].');"
					><span class="fa fa-trash-o"></span></a></td></tr>';

				}
				
				?>
				</tbody>
			</table>
		</div>

		<hr class="linha_nova_ordem">
		<h5>Informações sobre o Produto</h5>
		<div class="row">
			<div class="col-sm-4">
				<label>Nota Fiscal</label>
				<div class="input-group input-group-sm mb-3 campo_tamanho1">
					<input type="text" class="form-control" aria-label="Nota Fiscal" aria-describedby="inputGroup-sizing-sm"
						   id="nota_fiscal_os" name="nota_fiscal_os" value="<?php echo $os['nota_fiscal']; ?>">
				</div>
			</div>

			<div class="col-mb-1">
				<label>Data de Compra</label>
				<div class="input-group input-group-sm mb-3 campo_data2">
					<input type="date" class="form-control" aria-label="Data de Compra do Produto" aria-describedby="inputGroup-sizing-sm"
						   id="data_compra_os" name="data_compra_os" value="<?php echo $os['data_compra']; ?>">
				</div>
			</div>

			<div class="col-sm-4 espaco">
				<label>Código do Produto</label>
				<div class="input-group input-group-sm mb-3 campo_tamanho1">
					<input type="text" class="form-control" aria-label="Código do Produto" aria-describedby="inputGroup-sizing-sm"
						   id="codigo_produto_os" name="codigo_produto_os" value="<?php echo $os['codigo_produto']; ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-5">
				<label>Descrição do Produto</label>
				<div class="input-group input-group-sm mb-3 campo_tamanho2">
					<input type="text" class="form-control" aria-label="Descrição do Produto" aria-describedby="inputGroup-sizing-sm"
						   id="descricao_produto_os" name="descricao_produto_os" value="<?php echo $os['descricao_produto']; ?>">
				</div>
			</div>

			<div class="col-4">
				<label>Número de Série</label>
				<div class="input-group input-group-sm mb-3 campo_tamanho1">
					<input type="text" class="form-control" aria-label="Número de Série" aria-describedby="inputGroup-sizing-sm"
						   id="numero_serie_os" name="numero_serie_os" value="<?php echo $os['numero_serie_produto']; ?>">
				</div>
			</div>

			<div class="col-3">
				<label>Voltagem</label>
				<div class="input-group input-group-sm mb-3 campo_tamanho3">
					<input type="number" class="form-control" aria-label="Voltagem" aria-describedby="inputGroup-sizing-sm"
						   id="voltagem_os" name="voltagem_os" value="<?php echo $os['voltagem']; ?>">
				</div>
			</div>
		</div>
		<label>Defeito Reclamado</label>
		<div class="input-group input-group-sm mb-3 campo_tamanho4">
			<input type="text" class="form-control" aria-label="Defeito Apresentado" aria-describedby="inputGroup-sizing-sm"
				   id="defeito_reclamado_os" name="defeito_reclamado_os" value="<?php echo $os['defeito_reclamado']; ?>">
		</div>
		<hr class="linha_nova_ordem">

		<h5>Informações do Cliente</h5>
		<div class="row">
			<input type="hidden" id="os_cliente_id" name="os_cliente_id" value="<?php echo $os['id_cliente']; ?>">
			<div class="input-group-sm mb-3 campo_tamanho3 cliente_selecao">
				<input type="text" readonly=“true” name="os_cliente_nome" id="os_cliente_nome" class="form-control"
					   aria-label="Nome do Cliente" aria-describedby="inputGroup-sizing-sm" value="<?php echo $os['nome_cliente']; ?>">
			</div>
			<a id="InfoCliente" class="btn btn-primary">Informações do Cliente</a>
			<a id="SelecionarCliente" class="btn btn-primary botao_cliente">Selecionar Cliente</a>
			<a id="AddCliente" class="btn btn-primary botao_cliente">Adicionar Novo Cliente</a>
		</div>

		<div class="row botoesAcaoAlterar">
			<button type="submit" class="btn btn-primary botao_acao">GRAVAR</button>
			<a href="<?php
			if ($this->input->get("status") === "aberta") {
				echo base_url() . 'OrdemServico/os_abertas';
			} else if ($this->input->get("status") === "fechada") {
				echo base_url().'OrdemServico/os_fechadas';
			}
			?>" class="btn btn-danger botao_acao" >CANCELAR</a>
		</div>

	</form>

	<?php include('modal_info_cliente.php');
	include('modal_selecionar_cliente.php');
	include('modal_adicionar_cliente.php');
	?>

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
					<button type="button" id="msgOK" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

	<!-- MENSAGEM DE ORDEM SERVICO -->
	<div class="modal" tabindex="-1" role="dialog" id="msgOrdemCadastro">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ordem de Servico</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p id="msgOrdem"></p>
				</div>
				<div class="modal-footer">
					<a  id="msgOKOrdemAlterada" class="btn btn-primary botao_acao"
					href="<?php if ($this->input->get("status") === "aberta") {
				echo base_url() . 'OrdemServico/os_abertas';
			} else if ($this->input->get("status") === "fechada") {
				echo base_url().'OrdemServico/os_fechadas';
			}?>">OK</a>
				</div>
			</div>
		</div>
	</div>

	<!-- MENSAGEM EXCLUIR PEÇA -->
	<div class="modal" tabindex="-1" role="dialog" id="msgOrdemItemPecaExclusao">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Excluir Peça da Ordem de Serviço</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p>Deseja realmente excluir a Peça Selecionada?</p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgOkExclusaoItem" class="btn btn-danger" >SIM</button>
					<button type="button" id="" class="btn btn-primary" data-dismiss="modal">NÃO</button>
				</div>
			</div>
		</div>
	</div>


</div>
