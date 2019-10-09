<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="<?php echo base_url(); ?>public/images/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>public/images/favicon.ico" />
	<title>CBK SISTEM</title>
	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="favicon.ico">
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Custom styles for this template -->
		<link href="<?php echo base_url(); ?>public/css/owl.carousel.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>public/css/owl.theme.default.min.css"  rel="stylesheet">
		<!-- <link href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet"> -->
		<link href="<?php echo base_url(); ?>public/css/estilos.css" rel="stylesheet">
		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="<?php echo base_url(); ?>public/js/ie-emulation-modes-warning.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<script src="https://kit.fontawesome.com/f2266e159a.js" crossorigin="anonymous"></script>

		<![endif]-->
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<?php


	if (isset($styles)){
			foreach ($styles as $styles_name):
				$href = base_url()."public/css/".$styles_name; ?>
				<link rel="stylesheet" type="text/css" href="<?php echo $href; ?>">
	<?php endforeach; }?>
</head>
<body>

	<div class="barra_inicial">
		

		<div class="usuario_info">
			<i class="fa fa-user"></i>
			<!--<p id="txt_usuario"><?php
				// foreach ($usuario_session as $usuarios):
				 //	echo $usuarios['nome_completo'];
				 //endforeach;?></p>-->
		</div>
	</div>

	<div class="menu_sistema">
		<a href="<?php echo base_url(); ?>Inicio" ><img id="image_logo" src="<?php echo base_url(); ?>public/images/CBK.png"></a>

		<ul class="menu_sistema_opcoes">
			<li><a href="<?php echo base_url();?>OrdemServico/index"><i class="fa fa-tasks" aria-hidden="true"></i> Ordem de Serviço</a></li>
			<li><a href=""><i class="fa fa-file-text-o" aria-hidden="true"></i> Pedido de Peça</a></li>
			<li><a href="<?php echo base_url();?>Clientes/index"><i class="fa fa-users" aria-hidden="true"></i> Clientes</a></li>
			<li><a href="<?php echo base_url();?>Fornecedores/index"><i class="fa fa-book" aria-hidden="true"></i> Fornecedores</a></li>
			<li><a href="<?php echo base_url(); ?>Estatisticas/index"><i class="fa fa-line-chart"></i> Estatísticas</a></li>
			<li><a href=""><i class="fa fa-cog" aria-hidden="true"></i> Configurações</a></li>
		</ul>

		<div class="versao">
			<!--<img id="img_versao" src="<?php echo base_url(); ?>public/images/ic_memory_white_48dp.png">
			<p id="txt_versao"><?php // foreach ($versao_sistema as $versao1):
				//echo $versao1['versao_num'];
			 //endforeach;?></p>-->
		</div>
	</div>

</body>
</html>
