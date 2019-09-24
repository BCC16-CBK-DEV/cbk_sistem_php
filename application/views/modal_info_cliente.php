<?php

?>

<!-- MODAL DE INFORMAÇÕES DO CLIENTE -->
<div id="informacoesCliente" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Informações do Cliente</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_info_cliente">
					<div class="coluna_1_info row">
						<div class="col-lg-6">
							<label>Nome:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_nome" id="info_cliente_nome" class="form-control"
								   aria-label="Nome do Cliente" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						<div class="col-lg-3">
							<label>CPF:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_cpf" id="info_cliente_cpf" class="form-control"
								   aria-label="CPF do Cliente" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						<div class="col-lg-3">
							<label>RG:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_rg" id="info_cliente_rg" class="form-control"
								   aria-label="RG do Cliente" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>
					</div>

					<div class="coluna_1_info row">
						<div class="col-lg-5">
							<label>E-mail:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_email" id="info_cliente_email" class="form-control"
									   aria-label="E-mail" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						<div class="col-lg-2">
							<label>CEP:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_cep" id="info_cliente_cep" class="form-control"
									   aria-label="CEP" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						<div class="col-lg-3">
							<label>Cidade:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_cidade" id="info_cliente_cidade" class="form-control"
									   aria-label="Cidade" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						<div class="col-lg-2">
							<label>UF:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_uf" id="info_cliente_uf" class="form-control"
									   aria-label="Estado" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>
					</div>

					<div class="coluna_1_info row">
						<div class="col-lg-5">
							<label>Endereço:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_endereco" id="info_cliente_endereco" class="form-control"
									   aria-label="Endereço" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						<div class="col-lg-2">
							<label>Número:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_numero" id="info_cliente_numero" class="form-control"
									   aria-label="Número" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						<div class="col-lg-5">
							<label>Bairro:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_bairro" id="info_cliente_bairro" class="form-control"
									   aria-label="Bairro" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

					</div>

					<div class="coluna_1_info row">
						<div class="col-lg-3">
							<label>Complemento:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_complemento" id="info_cliente_complemento" class="form-control"
									   aria-label="Complemento" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						<div class="col-lg-3">
							<label>Telefone:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_telefone" id="info_cliente_telefone" class="form-control"
									   aria-label="Telefone" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>

						<div class="col-lg-3">
							<label>Celular:</label>
							<div class="input-group input-group-sm mb-3">
								<input type="text" readonly=“true” name="info_cliente_celular" id="info_cliente_celular" class="form-control"
									   aria-label="Celular" aria-describedby="inputGroup-sizing-sm">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
