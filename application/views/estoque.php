<?php
include "header.php";
include "scripts.php";
?>

<div class="posicao_conteudo">
	<h4 class="titulo_opcoes"><span class="fa fa-tasks"></span> Estoque de Peças</h4>
	<hr class="linha_nova_ordem">
	<div class="centraliza">
		<div class="barra_pesquisa row">
			<button class="btn btn-dark botoesBarra" id="botaoFiltroEstoque" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFiltro">
				<span class="fa fa-search"></span> Filtros
			</button>
			<a class="btn btn-dark botoesBarra2" id="botaoNovaPeca" >
				<span class="fa fa-plus-circle"></span> Nova Peça
			</a>
			<a class="btn btn-dark botoesBarra" id="botaoInicio" href="<?php echo base_url();?>PedidoPeca/index">
				<span class="fa fa-chevron-circle-left"></span> Voltar
			</a>
			<a class="btn btn-dark botoesBarra" id="botaoRelatorioEstoque">
				Relatório
			</a>
		</div>
		<div class="collapse row" id="collapseFiltro">
			<div class="card card-body">
				<form method="post" action="<?php echo base_url(); ?>PedidoPeca/filtroEstoque">
				<div class="linha_filtro row">
					<div class="col-lg-4">
						<label>Descrição da Peça</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="text" class="form-control" aria-label="Descrição da Peça" aria-describedby="inputGroup-sizing-sm"
							id="filtro_descricao_peca" name="filtro_descricao_peca" value="<?php echo $this->input->get_post('filtro_descricao_peca'); ?>">
						</div>
					</div>
					<div class="col-lg-3">
						<label>Código da Peça</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="text" class="form-control" aria-label="Código da Peça" aria-describedby="inputGroup-sizing-sm"
								   id="filtro_codigo_peca" name="filtro_codigo_peca" value="<?php echo $this->input->get_post('filtro_codigo_peca'); ?>">
						</div>
					</div>
					<div class="col-lg-2">
						<label>Quantidade</label>
						<div class="input-group input-group-sm">
							<input type="number" class="form-control" aria-label="Quantidade" aria-describedby="inputGroup-sizing-sm"
								   id="filtro_quantidade_peca" name="filtro_quantidade_peca" value="<?php echo $this->input->get_post('filtro_quantidade_peca'); ?>">
						</div>
					</div>
					<div class="col-lg-2">
						<label>Valor Peça/Un.</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" aria-label="Valor da Peça" aria-describedby="inputGroup-sizing-sm"
								   id="filtro_valor_peca" name="filtro_valor_peca" value="<?php echo $this->input->get_post('filtro_valor_peca'); ?>">
						</div>
					</div>
				</div>
				<div class="linha_filtro row">
					<div class="col-lg-3">
						<label></label>
						<button class="btn btn-dark botao_filtro" id="botaoFiltro_buscar" type="submit">
							<span class="fa fa-search"></span> Buscar
						</button>
						<a class="btn btn-dark botao_filtro " href="<?php echo base_url(); ?>PedidoPeca/pedidos" id="botaoFiltro_limpar">
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
					<th scope="col">ID da Peça</th>
					<th scope="col">Descrição Peça</th>
					<th scope="col">Código <da></da> Peça</th>
					<th scope="col">Quantidade</th>
					<th scope="col">Valor Unidade</th>
					<th scope="col">Ações</th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($pecas as $peca):
						if($peca['quantidade_peca'] < 10) {
							echo '<tr style="background-color: red; color: white;"><th scope="row">' . $peca['id_peca'] . '</th>';
						} else {
							echo '<tr><th scope="row">' . $peca['id_peca'] . '</th>';
						}
						echo '<td>'.$peca['descricao_peca'].'</td>';
						echo '<td>'.$peca['codigo_peca'].'</td>';
						echo '<td>'.$peca['quantidade_peca'].'</td>';
						echo '<td>R$ '.$peca['valor_peca_unidade'].'</td>';

						echo '<td><a class="botaoAcoesTabela botaoEditar" id="botaoAlterarOrdem" onclick="alterar_peca('.$peca['id_peca'].');"><span class="fa fa-pencil-square-o"></span></a>';
						if ($this->session->userdata('departamento') == 1) {
							echo '<a class="botaoAcoesTabela botaoEditar" id="botaoExcluirOrdem" data-toggle="modal" data-target="#msgPecaExclusao" onclick="excluir_peca(' . $peca['id_peca'] . ');" ><span class="fa fa-trash-o"></span></a>';
						}
						echo '</td></tr>';
				endforeach;?>
				</tbody>
			</table>
		</div>
	</div>


	<!-- MODAL PARA ADICIONAR Peça -->
	<div class="modal fade" id="AdicionarPeca"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nova Peça - Estoque</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<form id="formulario_nova_peca" method="post" action="">
						<input type="hidden" class="form-control input-group-sm" id="id_peca" name="id_peca" >
						<label for="descricao_peca" class="col-form-label">Descrição da Peça</label>
						<input type="text" class="form-control input-group-sm" id="descricao_peca" name="descricao_peca" required>

						<label for="codigo_peca" class="col-form-label">Código da Peça</label>
						<input type="text" class="form-control input-group-sm" id="codigo_peca" name="codigo_peca" required>

						<label for="valor_peca" class="col-form-label">Valor da Peça/Unidade</label>
						<input type="text" class="form-control input-group-sm" id="valor_peca" name="valor_peca">

						<label for="quantidade_peca" class="col-form-label">Quantidade em Estoque</label>
						<input type="number" class="form-control input-group-sm" id="quantidade_peca" name="quantidade_peca">
						<hr>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="botaoCancelar">Cancelar</button>
						<button type="submit" class="btn btn-success" id="botaoCadastrarPeca">Cadastrar</button>
					</form>
				</div>
				<div class="modal-footer">
					<p class="help-block"></p>

				</div>

			</div>
		</div>
	</div>

	<!-- MENSAGEM DE ORDEM SERVICO -->
	<div class="modal" tabindex="-1" role="dialog" id="msgPecaCadastro">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="titulo_nova_peca">Nova Peça - Estoque</h5>
				</div>
				<div class="modal-body">
					<p id="msgNovaPeca"></p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgOKNovaPeca" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL PARA ALTERAR Peça -->
	<div class="modal fade" id="AlterarPeca"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Alterar Peça - Estoque</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<form id="formulario_alterar_peca" method="post" action="">
						<input type="hidden" class="form-control input-group-sm" id="id_peca_alterar" name="id_peca_alterar" >
						<label for="descricao_peca_alterar" class="col-form-label">Descrição da Peça</label>
						<input type="text" class="form-control input-group-sm" id="descricao_peca_alterar" name="descricao_peca_alterar" required>

						<label for="codigo_peca" class="col-form-label">Código da Peça</label>
						<input type="text" class="form-control input-group-sm" id="codigo_peca_alterar" name="codigo_peca_alterar" required>

						<label for="valor_peca" class="col-form-label">Valor da Peça/Unidade</label>
						<input type="text" class="form-control input-group-sm" id="valor_peca_alterar" name="valor_peca_alterar">

						<label for="quantidade_peca" class="col-form-label">Quantidade em Estoque</label>
						<input type="number" class="form-control input-group-sm" id="quantidade_peca_alterar" name="quantidade_peca_alterar">
						<hr>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="botaoCancelar">Cancelar</button>
						<button type="submit" class="btn btn-success" id="botaoAlterarPeca">Alterar</button>
					</form>
				</div>
				<div class="modal-footer">
					<p class="help-block"></p>

				</div>

			</div>
			</div>
		</div>

		<!-- MENSAGEM EXCLUIR PEÇA -->
		<div class="modal" tabindex="-1" role="dialog" id="msgPecaExclusao">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Excluir Peça</h5>
						<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>-->
					</div>
					<div class="modal-body">
						<p>Deseja realmente excluir a Peça Selecionada?</p>
					</div>
					<div class="modal-footer">
						<button type="button" id="msgOkExclusao" class="btn btn-danger" >SIM</button>
						<button type="button" id="" class="btn btn-primary" data-dismiss="modal">NÃO</button>
					</div>
				</div>
			</div>
		</div>


</div>
