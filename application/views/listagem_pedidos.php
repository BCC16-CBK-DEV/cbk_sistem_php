<?php
include 'header.php';
include 'scripts.php';
?>

<div class="posicao_conteudo">
	<h4 class="titulo_opcoes"><span class="fa fa-cart-plus"></span> Consultar Pedidos de Peça</h4>
	<hr class="linha_nova_ordem">
	<div class="centraliza">
		<div class="barra_pesquisa row">
			<!--<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFiltro">
				<span class="fa fa-search"></span> Filtros
			</button>-->
			<a class="btn btn-dark botoesBarra" id="botaoInicio" href="<?php echo base_url();?>PedidoPeca/index">
				<span class="fa fa-chevron-circle-left"></span> Voltar
			</a>
			<!--<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button">
				Relatório
			</button>-->
		</div>
		<div class="collapse row" id="collapseFiltro">
			<div class="card card-body">
				<div class="linha_filtro row">
					<div class="col-mb-2">
						<label>Nº Ordem Inicial</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="number" class="form-control" aria-label="Nº Ordem Inicial" aria-describedby="inputGroup-sizing-sm">
						</div>
					</div>
					<div class="col-mb-3">
						<label>Nº Ordem Final</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="number" class="form-control" aria-label="Nº Ordem Final" aria-describedby="inputGroup-sizing-sm">
						</div>
					</div>
					<div class="col-mb-2">
						<label>Data Inicial</label>
						<div class="input-group input-group-sm mb-3">
							<input type="date" class="form-control" aria-label="Data Inicio" aria-describedby="inputGroup-sizing-sm">
						</div>
					</div>
					<div class="col-mb-2">
						<label>Data Final</label>
						<div class="input-group input-group-sm mb-3">
							<input type="date" class="form-control" aria-label="Data Fim" aria-describedby="inputGroup-sizing-sm">
						</div>
					</div>
				</div>
				<div class="linha_filtro row">
					<div class="col-mb-5">
						<label>Descrição do Produto</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" aria-label="Descrição Produto" aria-describedby="inputGroup-sizing-sm">
						</div>
					</div>
					<div class="col-mb-7">
						<label>Nota Fiscal</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" aria-label="Nota Fiscal" aria-describedby="inputGroup-sizing-sm">
						</div>
					</div>
					<div class="col-mb-7">
						<label>Código do Produto</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" aria-label="Código do Produto" aria-describedby="inputGroup-sizing-sm">
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<table class="table tabela_os_abertas">
				<thead class="thead-dark">
				<tr>
					<th scope="col">Nº Pedido</th>
					<th scope="col">Assunto</th>
					<th scope="col">Data do Pedido</th>
					<th scope="col">Fornecedor</th>
					<th scope="col">Ações</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($pedidos as $ped):
					echo '<tr><th scope="row">'.$ped['num_pedido'].'</th>';
					echo '<td>'.$ped['assunto_pedido'].'</td>';
					echo '<td>'.date("d/m/Y", strtotime($ped['data_pedido'])).'</td>';
					echo '<td>'.$ped['nome_fornecedor'].'</td>';
					echo '<td><a class="botaoAcoesTabela botaoEditar" onclick="alterar_pedido('.$ped['id_pedido_peca'].');"><span class="fa fa-pencil-square-o"></span></a>
					<a class="botaoAcoesTabela botaoExcluir"  data-toggle="modal" data-target="#msgPedidoExclusao" onclick="excluir_pedido('.$ped['id_pedido_peca'].');"><span class="fa fa-trash-o"></span></a></td></tr>';
				endforeach;?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- MENSAGEM EXCLUIR PEDIDO -->
	<div class="modal" tabindex="-1" role="dialog" id="msgPedidoExclusao">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Excluir Pedido de Peça</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p>Deseja realmente excluir o Pedido de Peça Selecionado?</p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgOkExclusao" class="btn btn-danger" >SIM</button>
					<button type="button" id="" class="btn btn-primary" data-dismiss="modal">NÃO</button>
				</div>
			</div>
		</div>
	</div>

</div>
