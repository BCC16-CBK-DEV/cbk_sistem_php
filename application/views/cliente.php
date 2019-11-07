<?php

	include ('header.php');
	include ('scripts.php');

?>

<div class="posicao_conteudo">

	<h2 class="titulo_opcoes">Clientes:</h2>

	<div class="botao_ordem">
		<hr class="linha_menu">
		<a class="ordem_link nova_ordem" href="<?php echo base_url(); ?>Clientes/novo_cliente"><span class="fa fa-user-plus"></span> Cadastro de Cliente</a>
		<hr class="linha_menu">
		<a class="ordem_link" href="<?php echo base_url(); ?>Clientes/listagem"><span class="fa fa-users"></span>
			Consultar Clientes</a>
		<hr class="linha_menu">
		<a class="ordem_link" href="<?php echo base_url(); ?>Inicio"><span class="fa fa-home"></span>
			Inicio</a>
		<hr class="linha_menu">
	</diV>

</div>
