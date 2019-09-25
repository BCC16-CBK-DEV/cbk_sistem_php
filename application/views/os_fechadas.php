<?php

include ('header.php');
include ("scripts.php");

?>

<script src="<?php echo base_url(); ?>public/js/ordemServico.js"></script>
<script src="<?php echo base_url(); ?>public/js/util.js"></script>

<div class="posicao_conteudo">

	<h4 class="titulo_opcoes"><span class="fa fa-archive"></span> Consultar OS Fechadas</h4>
	<hr class="linha_nova_ordem">
	<div class="centraliza">
		<div class="barra_pesquisa row">
			<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFiltro">
				Filtros
			</button>
			<a class="btn btn-dark botoesBarra" id="botaoInicio" href="<?php echo base_url();?>OrdemServico/index">
				Voltar
			</a>
			<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button">
				Relatório
			</button>
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
					<th scope="col">Nº Ordem</th>
					<th scope="col">Data de Abertura</th>
					<th scope="col">Descrição</th>
					<th scope="col">Nota Fiscal</th>
					<th scope="col">Código Produto</th>
					<th scope="col">Ações</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($os_fechadas as $os):
					echo '<tr><th scope="row">'.$os['numero_ordem'].'</th>';
					echo '<td>'.date("d/m/Y", strtotime($os['data_abertura'])).'</td>';
					echo '<td>'.$os['descricao_produto'].'</td>';
					echo '<td>'.$os['nota_fiscal'].'</td>';
					echo '<td>'.$os['codigo_produto'].'</td>';
					echo '<td><a class="botaoAcoesTabela botaoEditar" href=""><span class="fa fa-pencil-square-o"></span></a>
					<a class="botaoAcoesTabela botaoExcluir" href=""><span class="fa fa-trash-o"></span></a></td></tr>';
				endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
</div>

