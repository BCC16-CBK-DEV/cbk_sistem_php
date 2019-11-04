<html>
<head>

</head>
<body>
	<h1><?php echo $autorizada['nome_autorizada']; ?></h1>
	<h2>Pedido nº <?php echo $pedido_info['num_pedido']; ?></h2>
	<p>Data do pedido: <?php echo date("d/m/Y", strtotime($data_pedido)) ?></p>
	<p>Abaixo a lista de peças solicitadas pela autorizada: </p>
	<table id="tabela_pedido_peca" class="table tabela_os_abertas" >
		<thead class="thead-dark" style="background-color: black; color: white; padding: 10px;">
		<tr>
			<th scope="col">Descrição Peça</th>
			<th scope="col">Código Peça</th>
			<th scope="col">Quantidade</th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($pecas_pedido as $pecas):
			echo '<tr><td>'.$pecas['descricao_peca'].'</td>';
			echo '<td>'.$pecas['codigo_peca'].'</td>';
			echo '<td>'.$pecas['qtd_peca_pedido'].'</td>';
		endforeach;
		?>
		</tbody>
	</table>
</body>
</html>
