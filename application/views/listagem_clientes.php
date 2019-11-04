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
			<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFiltro">
				<span class="fa fa-search"></span> Filtros
			</button>
			<a class="btn btn-dark botoesBarra" id="botaoInicio" href="<?php echo base_url();?>Clientes/index">
				<span class="fa fa-chevron-circle-left"></span> Voltar
			</a>
			<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button">
				Relatório
			</button>
		</div>
		<div class="collapse row" id="collapseFiltro">
			<div class="card card-body">
				<form id="form_filtro_cliente" method="post" action="<?php echo base_url();?>Clientes/filtroCliente">
				<div class="linha_filtro row">
					<div class="col-lg-6">
						<label>Nome</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="text" class="form-control" aria-label="Nome do Cliente" aria-describedby="inputGroup-sizing-sm"
							id="filtro_cliente_nome" name="filtro_cliente_nome" value="<?php echo $this->input->get_post('filtro_cliente_nome'); ?>">
						</div>
					</div>
					<div class="col-mb-3">
						<label>CPF</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="text" class="form-control" aria-label="CPF do Cliente" aria-describedby="inputGroup-sizing-sm"
								   id="filtro_cliente_cpf" name="filtro_cliente_cpf" value="<?php echo $this->input->get_post('filtro_cliente_cpf'); ?>">
						</div>
					</div>
				</div>
				<div class="linha_filtro row">
					<div class="col-lg-6">
						<label>e-Mail</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" aria-label="e-Mail do Cliente" aria-describedby="inputGroup-sizing-sm"
								   id="filtro_cliente_email" name="filtro_cliente_email" value="<?php echo $this->input->get_post('filtro_cliente_email'); ?>">
						</div>
					</div>
					<div class="col-mb-7">
						<label>Celular</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" aria-label="Celular do cliente" aria-describedby="inputGroup-sizing-sm"
							   id="filtro_cliente_celular" name="filtro_cliente_celular" value="<?php echo $this->input->get_post('filtro_cliente_celular'); ?>">
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
