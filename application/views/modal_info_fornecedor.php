<?php

?>

<!-- MODAL DE INFORMAÇÕES DO FORNECEDOR -->
<div id="informacoesFornecedor" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Informações do Fornecedor</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_info_fornecedor">
					<div class="coluna_1_info row">
						<div class="col-lg-6">
							<label>Nome:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_fornecedor_nome" id="info_fornecedor_nome" class="form-control"
								   aria-label="Nome do Fornecedor" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						<div class="col-lg-4">
							<label>CNPJ:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_fornecedor_cnpj" id="info_fornecedor_cnpj" class="form-control"
								   aria-label="CNPJ do Fornecedor" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						</div>
					</div>

					<div class="coluna_2_info row">
						<div class="col-lg-5">
							<label>E-mail:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_fornecedor_email" id="info_fornecedor_email" class="form-control"
									   aria-label="E-mail" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						<div class="col-lg-4">
							<label>Telefone:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_fornecedor_telefone" id="info_fornecedor_telefone" class="form-control"
									   aria-label="Telefone" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
