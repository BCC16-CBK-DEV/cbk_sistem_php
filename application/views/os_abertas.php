<?php
include ('header.php');
include ('scripts.php');
?>
<script src="<?php echo base_url(); ?>public/js/ordemServico.js"></script>
<<!--script src="<?php// echo base_url(); ?>public/js/util.js"></script>-->

<div class="posicao_conteudo">

	<h4 class="titulo_opcoes"><span class="fa fa-inbox"></span> Consultar OS</h4>
	<hr class="linha_nova_ordem">
	<div class="centraliza">
		<div class="barra_pesquisa row">
			<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFiltro">
				<span class="fa fa-search"></span> Filtros
			</button>
			<a class="btn btn-dark botoesBarra" id="botaoInicio" href="<?php echo base_url();?>OrdemServico/index">
				<span class="fa fa-chevron-circle-left"></span> Voltar
			</a>
			<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button">
				<span class="fa fa-file-excel-o"></span>
			</button>
		</div>
		<!-- COLLAPSE DO FILTRO -->
		<div class="collapse row" id="collapseFiltro">
			<div class="card card-body">
				<form id="form_filtro_ordem" method="post" action="<?php echo base_url();?>OrdemServico/filtroOrdem">
					<div class="linha_filtro row">
						<div class="col-mb-2">
							<label>Nº Ordem Inicial</label>
							<div class="input-group input-group-sm mb-3 ">
								<input type="number" class="form-control" aria-label="Nº Ordem Inicial" aria-describedby="inputGroup-sizing-sm"
									   name="filtro_numero_inicial" id="filtro_numero_inicial" value="<?php echo $this->input->get_post('filtro_numero_inicial'); ?>">
							</div>
						</div>
						<div class="col-mb-3">
							<label>Nº Ordem Final</label>
							<div class="input-group input-group-sm mb-3 ">
								<input type="number" class="form-control" aria-label="Nº Ordem Final" aria-describedby="inputGroup-sizing-sm"
									   name="filtro_numero_final" id="filtro_numero_final" value="<?php echo $this->input->get_post('filtro_numero_final'); ?>">
							</div>
						</div>
						<div class="col-mb-2">
							<label>Data Inicial</label>
							<div class="input-group input-group-sm mb-3">
								<input type="date" class="form-control" aria-label="Data Inicio" aria-describedby="inputGroup-sizing-sm"
									   name="filtro_data_inicial" id="filtro_data_inicial" value="<?php echo $this->input->get_post('filtro_data_inicial'); ?>">
							</div>
						</div>
						<div class="col-mb-2">
							<label>Data Final</label>
							<div class="input-group input-group-sm mb-3">
								<input type="date" class="form-control" aria-label="Data Fim" aria-describedby="inputGroup-sizing-sm"
									   name="filtro_data_final" id="filtro_data_final" value="<?php echo $this->input->get_post('filtro_data_final'); ?>">
							</div>
						</div>
					</div>
					<div class="linha_filtro row">
						<div class="col-mb-5">
							<label>Descrição do Produto</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" aria-label="Descrição Produto" aria-describedby="inputGroup-sizing-sm"
									   name="filtro_descricao" id="filtro_descricao" value="<?php echo $this->input->get_post('filtro_descricao'); ?>">
							</div>
						</div>
						<div class="col-mb-7">
							<label>Nota Fiscal</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" aria-label="Nota Fiscal" aria-describedby="inputGroup-sizing-sm"
									   name="filtro_nota_fiscal" id="filtro_nota_fiscal" value="<?php echo $this->input->get_post('filtro_nota_fiscal'); ?>">
							</div>
						</div>
						<div class="col-mb-7">
							<label>Código do Produto</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" aria-label="Código do Produto" aria-describedby="inputGroup-sizing-sm"
									   name="filtro_codigo_produto" id="filtro_codigo_produto" value="<?php echo $this->input->get_post('filtro_codigo_produto'); ?>">
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
					<th scope="col">Nº Ordem</th>
					<th scope="col">Data de Abertura</th>
					<th scope="col">Descrição</th>
					<th scope="col">Nota Fiscal</th>
					<th scope="col">Código Produto</th>
					<th scope="col">Ações</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$status = 'aberta';
				foreach ($os_abertas as $os):
					echo '<tr><th scope="row">'.$os['numero_ordem'].'</th>';
					echo '<td>'.date("d/m/Y", strtotime($os['data_abertura'])).'</td>';
					echo '<td>'.$os['descricao_produto'].'</td>';
					echo '<td>'.$os['nota_fiscal'].'</td>';
					echo '<td>'.$os['codigo_produto'].'</td>';
					echo '<td><a class="botaoAcoesTabela botaoEditar" id="botaoAlterarOrdem" onclick="alterar_ordem('.$os['id_ordem'].',\''.$status.'\');"><span class="fa fa-pencil-square-o"></span></a>
					<a class="botaoAcoesTabela botaoEditar" id="botaoExcluirOrdem" data-toggle="modal" data-target="#msgOrdemExclusao" onclick="excluir_ordem('.$os['id_ordem'].',\''.$status.'\');"><span class="fa fa-trash-o"></span></a></td></tr>';
				endforeach;?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- MENSAGEM EXCLUIR ORDEM -->
	<div class="modal" tabindex="-1" role="dialog" id="msgOrdemExclusao">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Excluir Ordem de Serviço</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p>Deseja realmente excluir a Ordem de Serviço Selecionada?</p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgOkExclusao" class="btn btn-danger" >SIM</button>
					<button type="button" id="" class="btn btn-primary" data-dismiss="modal">NÃO</button>
				</div>
			</div>
		</div>
	</div>

</div>
