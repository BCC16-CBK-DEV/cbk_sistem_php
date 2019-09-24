<!DOCTYPE html>
<html>
<head>
	<title>CBK SISTEM - LOGIN</title>
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
		<![endif]-->

		<?php if (isset($styles)){
			foreach ($styles as $styles_name) {
				$href = base_url()."public/css/".$styles_name; ?>
				<link rel="stylesheet" type="text/css" href="<?php echo $href; ?>">
		<?php }
		} ?>

		<?php include ('scripts.php'); ?>
</head>
<body class="background_login">

	<div class="container">
		<div class="login_esquerdo">
			<img id="logo_login" src="<?php echo base_url(); ?>public/images/CBK.png">

		</div>

		<div class="linha_vertical"></div>

		<div class="login_direito">
			
		<form id="formulario_login" method="post">
			<h2 id="titulo_login">LOGIN</h2>
			<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
				 </div>
				 <input type="text" name="username" id="username" class="form-control" placeholder="Usuário">
			</div>

			<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
				 </div>
				 <input type="password" name="password" id="password" class="form-control" placeholder="Senha">
			</div>

			<button id="botao_login" class="btn btn-dark" type="submit">Entrar</button>

			<span class="help-block"></span>
		</form>

	<!-- <footer class="rodape_login">
		<h3 id="nome_rodape">CBK SISTEM</h3>
		<p>(14) 3453-9999</p>
	</footer> -->

</body>
</html>
