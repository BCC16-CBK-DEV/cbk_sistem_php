
<h2 style="text-align: center; font-family: Arial, Verdana, Helvetica, sans-serif;">Relatório de Clientes</h2>
<p id="data_relatorio">Data do Relatório: <?php echo date("d/m/Y");?></p>
<table class="tabela_relatorio tabela_os_abertas">
	<thead class="topo_escuro">
	<tr>
		<th scope="col">ID</th>
		<th scope="col">Nome</th>
		<th scope="col">CPF</th>
		<th scope="col">e-Mail</th>
		<th scope="col">Celular</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($clientes as $cliente):
		echo '<tr><th scope="row">'.$cliente['id_cliente'].'</th>';
		echo '<td>'.$cliente['nome_cliente'].'</td>';
		echo '<td>'.$cliente['cpf'].'</td>';
		echo '<td>'.$cliente['email'].'</td>';
		echo '<td>'.$cliente['celular'].'</td></tr>';
	endforeach;?>
	</tbody>
</table>

