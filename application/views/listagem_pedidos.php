<?php
include 'header.php';
include 'scripts.php';
?>

<div class="posicao_conteudo">
	<h4 class="titulo_opcoes"><span class="fa fa-cart-plus"></span> Consultar Pedidos de Peça</h4>
	<hr class="linha_nova_ordem">
	<div class="centraliza">
		<div class="barra_pesquisa row">
			<button class="btn btn-dark botoesBarra" id="botaoFiltroPedido" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFiltro">
				<span class="fa fa-search"></span> Filtros
			</button>
			<a class="btn btn-dark botoesBarra" id="botaoInicio" href="<?php echo base_url();?>PedidoPeca/index">
				<span class="fa fa-chevron-circle-left"></span> Voltar
			</a>
			<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button">
				Relatório
			</button>
		</div>
		<div class="collapse row" id="collapseFiltro">
			<div class="card card-body">
				<form method="post" id="formulario_pedido_filtro" action="<?php echo base_url(); ?>PedidoPeca/filtro_pedido">
				<div class="linha_filtro row">
					<div class="col-lg-3">
						<label>Nº Pedido Inicial</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="number" class="form-control" aria-label="Nº Pedido Inicial" aria-describedby="inputGroup-sizing-sm"
								   id="filtro_numero_pedido_inicial" name="filtro_numero_pedido_inicial">
						</div>
					</div>
					<div class="col-lg-3">
						<label>Nº Pedido Final</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="number" class="form-control" aria-label="Nº Pedido Final" aria-describedby="inputGroup-sizing-sm"
							id="filtro_numero_pedido_final" name="filtro_numero_pedido_final">
						</div>
					</div>
					<div class="col-lg-3">
						<label>Data Inicial</label>
						<div class="input-group input-group-sm mb-3">
							<input type="date" class="form-control" aria-label="Data Inicio" aria-describedby="inputGroup-sizing-sm">
						</div>
					</div>
					<div class="col-lg-3">
						<label>Data Final</label>
						<div class="input-group input-group-sm mb-3">
							<input type="date" class="form-control" aria-label="Data Fim" aria-describedby="inputGroup-sizing-sm">
						</div>
					</div>
				</div>
				<div class="linha_filtro row">
					<div class="col-lg-5">
						<label>Assunto</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" aria-label="Assunto" aria-describedby="inputGroup-sizing-sm">
						</div>
					</div>
					<div class="col-lg-4">
						<label>Fornecedor</label>
						<div class="input-group input-group-sm">
							<select id="fornecedor_pedido" name="fornecedor_pedido" class="form-control form-control-sm ">
								<option value="0">Selecionar Fornecedor</option>
								<?php
								foreach($fornecedores as $forn):
									echo '<option value="'.$forn['id_fornecedor'].'">'.$forn['nome_fornecedor'].'</option>';
								endforeach;
								?>
							</select>
						</div>
					</div>
					<div class="col-mb-3">
						<label></label>
						<button class="btn btn-dark botao_filtro" id="botaoFiltro_buscar" type="submit">
							<span class="fa fa-search"></span> Buscar
						</button>
						<a class="btn btn-dark botao_filtro " href="<?php echo base_url(); ?>Clientes/listagem" id="botaoFiltro_limpar">
							Limpar
						</a>
					</div>
				</div>
				</form>
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
					echo '<td><a class="botaoAcoesTabela botaoEditar" onclick="alterar_pedido('.$ped['id_pedido_peca'].');"><span class="fa fa-pencil-square-o"></span></a>';
					if($this->session->userdata('departamento') == 1) {
						echo '<a class="botaoAcoesTabela botaoExcluir"  data-toggle="modal" data-target="#msgPedidoExclusao" onclick="excluir_pedido(' . $ped['id_pedido_peca'] . ');"><span class="fa fa-trash-o"></span></a>';
					}
					echo '</td></tr>';
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
