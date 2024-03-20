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
	$consulta = "SELECT * FROM ESTABELECIMENTO WHERE email_estabelecimento = '$logado'";
	$sucessoEstabelecimento = mysqli_query($conexao, $consulta);
	$estabelecimento = mysqli_fetch_assoc($sucessoEstabelecimento);

	$nome = $estabelecimento['nome_estabelecimento'];
	$email = $logado;
	$senha = $_SESSION['senha'];
	$id_estabelecimento = $estabelecimento['id_estabelecimento'];
?>
<!DOCTYPE html>
<meta charset="utf-8">
<html>
	<head>
		<title>Clientes</title>

		<link rel="stylesheet" href="estilo_main_clientes.css" content="width=device-width,initial-scale=1.0">

		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	</head>

		<?php
			require_once '../funcoes/menus_laterais.php';
			menuLateralClientes();
		?>

	<body>
			<div class="cabecalho">
				<form method="POST">			
					
					<input type="text" name="busca" class="busca" placeholder="BUSCA POR TÍTULO">
					<input type="submit" value="Buscar" class="btn-busca1">
				
					<a href="view_cadastro_cliente.php" class="btn-busca2">Novo cliente</a>

					<input type="submit" name="fiado" value="Clientes com fiados" class="btn-busca3">

					<a href="../vendas/view_pagar_fiado.php" class="btn-busca4">Pagar Fiado</a>
		
			</div>							
				<?php
					require_once "mostra_cliente.php";
				?>
				</form>
	</body>
</html>