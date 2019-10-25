<?php
	include ('header.php');
	include ('scripts.php');

?>

<script src="<?php echo base_url(); ?>public/js/Cliente.js"></script>

<div class="posicao_conteudo">
	<h4 class="titulo_opcoes"><span class="fa fa-users"></span> Consultar Clientes</h4>
	<hr class="linha_nova_ordem">
	<div class="centraliza">
		<div class="barra_pesquisa row">
			<!--<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFiltro">
				<span class="fa fa-search"></span> Filtros
			</button>-->
			<a class="btn btn-dark botoesBarra" id="botaoInicio" href="<?php echo base_url();?>Clientes/index">
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
					<th scope="col">ID</th>
					<th scope="col">Nome</th>
					<th scope="col">CPF</th>
					<th scope="col">e-Mail</th>
					<th scope="col">Celular</th>
					<th scope="col">Ações</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($clientes as $cliente):
					echo '<tr><th scope="row">'.$cliente['id_cliente'].'</th>';
					echo '<td>'.$cliente['nome_cliente'].'</td>';
					echo '<td>'.$cliente['cpf'].'</td>';
					echo '<td>'.$cliente['email'].'</td>';
					echo '<td>'.$cliente['celular'].'</td>';
					echo '<td><a class="botaoAcoesTabela botaoEditar" onclick="alterar_cliente('.$cliente['id_cliente'].');"><span class="fa fa-pencil-square-o"></span></a>
					<a class="botaoAcoesTabela botaoExcluir"  data-toggle="modal" data-target="#msgClienteExclusao" onclick="excluir_cliente('.$cliente['id_cliente'].');" ><span class="fa fa-trash-o"></span></a></td></tr>';
				endforeach;?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- MENSAGEM EXCLUIR PEDIDO -->
	<div class="modal" tabindex="-1" role="dialog" id="msgClienteExclusao">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Excluir Cliente</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p>Deseja realmente excluir o cliente Selecionado?</p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgOkExclusao" class="btn btn-danger" >SIM</button>
					<button type="button" id="" class="btn btn-primary" data-dismiss="modal">NÃO</button>
				</div>
			</div>
		</div>
	</div>

</div>
