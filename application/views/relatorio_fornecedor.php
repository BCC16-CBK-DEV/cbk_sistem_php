
<h2 style="text-align: center; font-family: Arial, Verdana, Helvetica, sans-serif;">Relatório de Fornecedores</h2>
<p id="data_relatorio">Data do Relatório: <?php echo date("d/m/Y");?></p>
<table class="tabela_relatorio tabela_os_abertas">
	<thead class="topo_escuro">
	<tr>
		<th scope="col">ID</th>
		<th scope="col">Fornecedores</th>
		<th scope="col">CNPJ</th>
		<th scope="col">e-Mail</th>
		<th scope="col">Telefone</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($fornecedores as $forn):
		echo '<tr><th scope="row">'.$forn['id_fornecedor'].'</th>';
		echo '<td>'.$forn['nome_fornecedor'].'</td>';
		echo '<td>'.$forn['cnpj_fornecedor'].'</td>';
		echo '<td>'.$forn['email_fornecedor'].'</td>';
		echo '<td>'.$forn['telefone_fornecedor'].'</td></tr>';
	endforeach;?>
	</tbody>
</table>

