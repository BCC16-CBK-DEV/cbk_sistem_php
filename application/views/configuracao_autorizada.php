<?php
	include 'header.php';
	include 'scripts.php';
?>


<div class="posicao_conteudo">
	<h2 class="titulo_opcoes"><span class="fa fa-info-circle"></span> Informações da Autorizada</h2>
	<hr class="linha_nova_ordem">
	<form method="post" id="formulario_autorizada">
		<input type="hidden" id="id_autorizada" name="id_autorizada"
			   value="<?php echo $info_autorizada['id_autorizada']; ?>">
		<div class="row">
			<div class="col-lg-6">
				<label>Nome da Autorizada</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="nome_autorizada" id="nome_autorizada" class="form-control"
						   aria-label="Nome da Autorizada" aria-describedby="inputGroup-sizing-sm" required
						   value="<?php echo $info_autorizada['nome_autorizada']; ?>">
				</div>
			</div>
		</div>
		<h4>Configurações e-mail da Autorizada</h4>
		<hr class="linha_nova_ordem">
		<div class="row">
			<div class="col-lg-5">
				<label>e-Mail</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="email_autorizada" id="email_autorizada" class="form-control"
						   aria-label="e-Mail da Autorizada" aria-describedby="inputGroup-sizing-sm"
						   value="<?php echo $info_autorizada['email_autorizada']; ?>">
				</div>
			</div>

			<div class="col-lg-3">
				<label>Senha do e-Mail</label>
				<div class="input-group input-group-sm mb-3">
					<input type="password"  name="senha_email_autorizada" id="senha_email_autorizada" class="form-control"
						   aria-label="Senha do e-Mail" aria-describedby="inputGroup-sizing-sm" placeholder="*********">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4">
				<label>SMTP Host e-Mail</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text" name="smtp_host_autorizada" id="smtp_host_autorizada" class="form-control"
						   aria-label="e-Mail da Autorizada" aria-describedby="inputGroup-sizing-sm"
						   value="<?php echo $info_autorizada['smtp_host_autorizada']; ?>">
				</div>
			</div>

			<div class="col-lg-2">
				<label>Porta</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="smtp_porta_autorizada" id="smtp_porta_autorizada" class="form-control"
						   aria-label="Porta do Host" aria-describedby="inputGroup-sizing-sm"
						   value="<?php echo $info_autorizada['smtp_porta_autorizada']; ?>">
				</div>
			</div>

			<div class="col-lg-2">
				<label>Protocolo e-Mail</label>
				<div class="input-group input-group-sm mb-3">
					<input type="text"  name="protocolo_email_autorizada" id="protocolo_email_autorizada" class="form-control"
						   aria-label="Protocolo de e-Mail" aria-describedby="inputGroup-sizing-sm"
						   value="<?php echo $info_autorizada['protocolo_email_autorizada']; ?>">
				</div>
			</div>

		</div>
		<div class="row">
			<button type="submit" class="btn btn-primary botao_acao">GRAVAR</button>
			<a href="<?php echo base_url();?>Configuracoes/index" class="btn btn-danger botao_acao" >CANCELAR</a>
		</div>
	</form>

	<!-- MENSAGEM DE AUTORIZADA ALTERADO -->
	<div class="modal" tabindex="-1" role="dialog" id="msgInfoAutorizada">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Alterar Autorizada</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p id="msgClienteAlterar"></p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgAutorizadaOK" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

</div>
