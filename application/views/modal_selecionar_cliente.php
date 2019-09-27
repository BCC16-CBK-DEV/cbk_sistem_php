<?php

?>

<!-- MODAL DE INFORMAÇÕES DO CLIENTE -->
<div id="Selecionar-Cliente" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Selecionar Cliente</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<table class="table tabela_os_abertas">
						<thead class="thead-dark">
						<tr>
							<th scope="col">Id Cliente</th>
							<th scope="col">Nome Cliente</th>
							<th scope="col">CPF</th>
							<th scope="col">Ação</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($clientes as $cl):
							echo '<tr><th scope="row">'.$cl['id_cliente'].'</th>';
							echo '<td>'.$cl['nome_cliente'].'</td>';
							echo '<td>'.$cl['cpf'].'</td>';
							echo '<td><a class="botaoAcoesTabela botaoEditar" href=""><span class="fa fa-pencil-square-o"></span></a>
					<a class="botaoAcoesTabela botaoExcluir" href=""><span class="fa fa-trash-o"></span></a></td></tr>';
						endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
