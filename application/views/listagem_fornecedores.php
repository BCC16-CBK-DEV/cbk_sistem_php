<?php
include ('header.php');
include ('scripts.php');

?>

<div class="posicao_conteudo">
	<h4 class="titulo_opcoes"><span class="fa fa-book"></span> Consultar Fornecedores</h4>
	<hr class="linha_nova_ordem">
	<div class="centraliza">
		<div class="barra_pesquisa row">
			<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFiltro">
				<span class="fa fa-search"></span> Filtros
			</button>
			<a class="btn btn-dark botoesBarra" id="botaoInicio" href="<?php echo base_url();?>Clientes/index">
				<span class="fa fa-chevron-circle-left"></span> Voltar
			</a>
			<a class="btn btn-dark botoesBarra" id="botaoRelatorioFornecedor">
				Relatório
			</a>
		</div>
		<div class="collapse row" id="collapseFiltro">
			<div class="card card-body">
				<form method="post" action="<?php echo base_url(); ?>Fornecedores/filtroFornecedor">
				<div class="linha_filtro row">
					<div class="col-lg-6">
						<label>Nome do Fornecedor</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="text" class="form-control" aria-label="Nome do Fornecedor" aria-describedby="inputGroup-sizing-sm"
							id="filtro_fornecedor_nome" name="filtro_fornecedor_nome" value="<?php echo $this->input->get_post('filtro_fornecedor_nome'); ?>">
						</div>
					</div>
					<div class="col-mb-4">
						<label>CNPJ</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="text" class="form-control" aria-label="CNPJ" aria-describedby="inputGroup-sizing-sm"
							id="filtro_fornecedor_cnpj" name="filtro_fornecedor_cnpj" value="<?php echo $this->input->get_post('filtro_fornecedor_cnpj'); ?>">
						</div>
					</div>
				</div>
				<div class="linha_filtro row">
					<div class="col-lg-6">
						<label>e-Mail</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" aria-label="e-Mail" aria-describedby="inputGroup-sizing-sm"
							id="filtro_fornecedor_email" name="filtro_fornecedor_email" value="<?php echo $this->input->get_post('filtro_fornecedor_email'); ?>">
						</div>
					</div>
					<div class="col-mb-7">
						<label>Telefone</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" aria-label="Telefone" aria-describedby="inputGroup-sizing-sm"
							id="filtro_fornecedor_telefone" name="filtro_fornecedor_telefone" value="<?php echo $this->input->get_post('filtro_fornecedor_telefone'); ?>">
						</div>
					</div>
					<div class="col-mb-3">
						<label></label>
						<button class="btn btn-dark botao_filtro" id="botaoFiltro_buscar" type="submit">
							<span class="fa fa-search"></span> Buscar
						</button>
						<a class="btn btn-dark botao_filtro " href="<?php echo base_url(); ?>OrdemServico/os_abertas" id="botaoFiltro_limpar">
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
					<th scope="col">ID</th>
					<th scope="col">Fornecedores</th>
					<th scope="col">CNPJ</th>
					<th scope="col">e-Mail</th>
					<th scope="col">Telefone</th>
					<th scope="col">Ações</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($fornecedores as $forn):
					echo '<tr><th scope="row">'.$forn['id_fornecedor'].'</th>';
					echo '<td>'.$forn['nome_fornecedor'].'</td>';
					echo '<td>'.$forn['cnpj_fornecedor'].'</td>';
					echo '<td>'.$forn['email_fornecedor'].'</td>';
					echo '<td>'.$forn['telefone_fornecedor'].'</td>';
					echo '<td><a class="botaoAcoesTabela botaoAlterarListagem" onclick="alterar_fornecedor('.$forn['id_fornecedor'].');"><span class="fa fa-pencil-square-o"></span></a>';
					if($this->session->userdata('departamento') == 1) {
						echo '<a class="botaoAcoesTabela botaoExcluirListagem" data-toggle="modal" data-target="#msgFornecedorExclusao" onclick="excluir_fornecedor(' . $forn['id_fornecedor'] . ');"><span class="fa fa-trash-o"></span></a>';
					}
					endforeach;?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- MENSAGEM EXCLUIR ORDEM -->
	<div class="modal" tabindex="-1" role="dialog" id="msgFornecedorExclusao">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Excluir Fornecedor</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p>Deseja realmente excluir o Fornecedor Selecionado?</p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgOkExclusao" class="btn btn-danger" >SIM</button>
					<button type="button" id="" class="btn btn-primary" data-dismiss="modal">NÃO</button>
				</div>
			</div>
		</div>
	</div>

</div>
