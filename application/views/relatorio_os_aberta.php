
<h2 style="text-align: center; font-family: Arial, Verdana, Helvetica, sans-serif;">Relatório de O.S. Abertas</h2>
<p id="data_relatorio">Data do Relatório: <?php echo date("d/m/Y");?></p>
<table class="tabela_relatorio tabela_os_abertas">
	<thead class="topo_escuro">
	<tr>
		<th scope="col">Nº Ordem</th>
		<th scope="col">Data de Abertura</th>
		<th scope="col">Descrição</th>
		<th scope="col">Nota Fiscal</th>
		<th scope="col">Código Produto</th>
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
		echo '<td>'.$os['codigo_produto'].'</td></tr>';
	endforeach;?>
	</tbody>
</table>

