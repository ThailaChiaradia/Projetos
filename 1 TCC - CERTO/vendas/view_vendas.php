<?php
	session_start();

	if(!isset($_SESSION['email']) == true and (!isset($_SESSION['senha']) == true))
	{
		unset($_SESSION['email']);
        unset($_SESSION['senha']);
		header("Location: ../inicial/login.php");
	}
	$logado = $_SESSION['email'];

	require_once "../funcoes/funcoes_banco.php";
	$conexao = conectaBanco();
	$consulta = "SELECT * FROM estabelecimento WHERE email_estabelecimento = '$logado'";
	$sucessoEstabelecimento = mysqli_query($conexao, $consulta);
	$estabelecimento = mysqli_fetch_assoc($sucessoEstabelecimento);
	$id_estabelecimento = $estabelecimento['id_estabelecimento'];

	$nome = $estabelecimento['nome_estabelecimento'];
	$email = $logado;
	$senha = $_SESSION['senha'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="estilo_main_vendas.css" content="width=device-width,initial-scale=1.0">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	
	<title>VENDAS</title>
</head>
	
	<?php
		require_once '../funcoes/menus_laterais.php';
		menuLateralVendas();
	?>

	<div class="cabecalho">
		<form method="POST">							
			<input type="date" name="busca" class="busca" placeholder="BUSCA POR CÓDIGO">
			<input type="submit" value="BUSCAR" class="btn-busca1">
			<input type="submit" value="Vizualizar Todos" class="btn-busca2">			
			<a href="view_cadastro_venda.php" class="btn-busca3">Cadastrar Venda</a>
			<a href="view_pagar_fiado.php" class="btn-busca3">Pagar Fiado</a>

	</div>		

	<?php
		require_once "mostra_vendas.php";
	?>
	</form>

<body>
</body>
</html>