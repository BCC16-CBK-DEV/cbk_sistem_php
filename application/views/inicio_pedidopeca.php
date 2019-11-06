<?php
include "header.php";
include "scripts.php";

?>

<div class="posicao_conteudo">

	<h2 class="titulo_opcoes">Pedido de Peça:</h2>

	<div class="botao_ordem">
		<hr class="linha_menu">
		<a class="ordem_link nova_ordem" href="<?php echo base_url(); ?>PedidoPeca/novo_pedido"><span class="fa fa-plus-circle"></span> Cadastro de Pedido de Peça</a>
		<hr class="linha_menu">
		<a class="ordem_link nova_ordem" href="<?php echo base_url(); ?>PedidoPeca/pedidos"><span class="fa fa-cart-plus"></span> Consulta de Pedido de Peça</a>
		<hr class="linha_menu">
		<a class="ordem_link nova_ordem" href="<?php echo base_url(); ?>PedidoPeca/estoque"><span class="fa fa-tasks"></span> Estoque</a>
		<hr class="linha_menu">
		<a class="ordem_link" href="<?php echo base_url(); ?>Inicio"><span class="fa fa-home"></span>
			Inicio</a>
		<hr class="linha_menu">

	</diV>
</div>
