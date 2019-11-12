
<h2 style="text-align: center; font-family: Arial, Verdana, Helvetica, sans-serif;">Relatório de Estoque</h2>
<p id="data_relatorio">Data do Relatório: <?php echo date("d/m/Y");?></p>
<table class="tabela_relatorio tabela_os_abertas">
		<thead class="topo_escuro">
		<tr>
			<th scope="col">ID da Peça</th>
			<th scope="col">Descrição Peça</th>
			<th scope="col">Código da Peça</th>
			<th scope="col">Quantidade</th>
			<th scope="col">Valor Unidade</th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($pecas as $peca):
			if($peca['quantidade_peca'] < 10) {
				echo '<tr id="pecaFaltando" style="background-color: red;"><th scope="row">' . $peca['id_peca'] . '</th>';
			} else {
				echo '<tr><th scope="row">' . $peca['id_peca'] . '</th>';
			}
			echo '<td>'.$peca['descricao_peca'].'</td>';
			echo '<td>'.$peca['codigo_peca'].'</td>';
			echo '<td>'.$peca['quantidade_peca'].'</td>';
			echo '<td>R$ '.$peca['valor_peca_unidade'].'</td></tr>';
		endforeach;?>
		</tbody>
	</table>

