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
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Exclusão de Cliente</title>

		<link rel="stylesheet" href="estilo_edita_produto.css" content="width=device-width,initial-scale=1.0">
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>

	</head>
	<body>
		<header>
			<div class="cabecalho">		
				<h1>Exclui Cliente</h1>		
			</div>
		</header>



		<?php	
		
			if(!isset($_GET["id_cliente"]))
			{
				echo "Não foi selecionado cliente para exclusão...";
				exit();
			}

			header("Location: view_clientes.php");
			
			require_once '../funcoes/funcoes_banco.php';

			$id_cliente = $_GET["id_cliente"];

			$conexao = conectaBanco();
			$cliente = deletaCliente($conexao, $id_cliente);

			if($cliente == false)
			{
				echo "Cliente não encontrado com o código informado...";
				exit();
			}

			session_start();
			if(isset($_SESSION['status_atualizacao']))
			{
		
				echo $_SESSION['status_atualizacao'];
			}

		?>
	</body>
</html>