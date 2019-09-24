<?php
	include ('header.php');
	include ('scripts.php');

?>

<div class="posicao_conteudo">



	<div class="row">
		<table class="table tabela_os_abertas">
			<thead class="thead-dark">
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Nome</th>
				<th scope="col">CPF</th>
				<th scope="col">e-Mail</th>
				<th scope="col">Ações</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($clientes as $cliente):
				echo '<tr><th scope="row">'.$cliente['id_cliente'].'</th>';
				echo '<td>'.$cliente['nome_cliente'].'</td>';
				echo '<td>'.$cliente['cpf'].'</td>';
				echo '<td>'.$cliente['email'].'</td>';
				echo '<td><a href=""><span class="fa fa-pencil-square-o"></span></a>
				<a href=""><span class="fa fa-trash-o"></span></a></td></tr>';
			endforeach;?>
			</tbody>
		</table>
	</div>

</div>
