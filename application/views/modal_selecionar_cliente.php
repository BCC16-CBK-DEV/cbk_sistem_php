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
					<div class="tabela">
						<table class="table tabela_os_abertas">
							<thead class="thead-light topo_tabela">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nome Cliente</th>
								<th scope="col">CPF</th>
								<th scope="col">Ação</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$cont = 1;

							foreach ($clientes as $cl):
								echo '<tr><th scope="row">'.$cont.'</th>';
								echo '<td>'.$cl['nome_cliente'].'</td>';
								echo '<td>'.$cl['cpf'].'</td>';
								echo '<td><a class="botaoAcoesTabela botaoAdicionar" id="botaoAdicionar" onclick="enviaID('.$cl['id_cliente'].');">
								<span class="fa fa-plus-circle"></span></a></td></tr>';

								$cont++;
							endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
