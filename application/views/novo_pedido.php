<?php
include 'header.php';
include 'scripts.php';
?>

<div class="posicao_conteudo">
	<h4 class="titulo_opcoes"><span class="fa fa-plus-circle"></span> Novo Pedido de Peça</h4>
	<hr class="linha_menu">

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

	<div class="row">
		<button type="submit" class="btn btn-primary botao_acao">GRAVAR</button>
		<a href="<?php echo base_url();?>PedidoPeca/index" class="btn btn-danger botao_acao" >CANCELAR</a>
	</div>
</div>
