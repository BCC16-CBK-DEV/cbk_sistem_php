<?php
	
	 include ('header.php');

?>

<div class="posicao_conteudo">

	<h2 class="titulo_opcoes">Ordem de Serviço:</h2>

	<div class="botao_ordem">
		<hr class="linha_menu">
		<a class="ordem_link nova_ordem" href="<?php echo base_url(); ?>OrdemServico/nova_ordem"><span class="fa fa-plus-square"></span> Nova OS</a>
		<hr class="linha_menu">
		<a class="ordem_link" href="<?php echo base_url(); ?>OrdemServico/os_abertas"><span class="fa fa-inbox"></span>
		Consultar OS</a>
		<hr class="linha_menu">
		<a class="ordem_link" href="<?php echo base_url(); ?>OrdemServico/os_fechadas"><span class="fa fa-archive"></span>
			OS Finalizadas</a>
		<hr class="linha_menu">
		<a class="ordem_link" href="<?php echo base_url(); ?>Inicio"><span class="fa fa-home"></span>
			Inicio</a>
		<hr class="linha_menu">
	</diV>

</div>
