
<h2 style="text-align: center; font-family: Arial, Verdana, Helvetica, sans-serif;">Relatório de Pedido de Peça</h2>
<p id="data_relatorio">Data do Relatório: <?php echo date("d/m/Y");?></p>
<table class="tabela_relatorio tabela_os_abertas">
	<thead class="topo_escuro">
		<tr>
			<th scope="col">Nº Pedido</th>
			<th scope="col">Assunto</th>
			<th scope="col">Data do Pedido</th>
			<th scope="col">Fornecedor</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($pedidos as $ped):
		echo '<tr><th scope="row">'.$ped['num_pedido'].'</th>';
		echo '<td>'.$ped['assunto_pedido'].'</td>';
		echo '<td>'.date("d/m/Y", strtotime($ped['data_pedido'])).'</td>';
		echo '<td>'.$ped['nome_fornecedor'].'</td></tr>';
	endforeach;?>
	</tbody>
</table>

