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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cadastro cliente</title>


		<link rel="stylesheet" href="estilo_cadastro_cliente.css" content="width=device-width,initial-scale=1.0">
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>

		<!----------------------MENU--LATERAL-------------------------->
		<?php
			require_once '../funcoes/menus_laterais.php';
			menuLateralClientes();
		?>
		<!------------------------------------------------------------->
</head>
<body>

	
	<div class="cabecalho">
		<h1>Cadastro Clientes</h1>
	</div>


	<div class="div-cadastro">
			<form method="POST" action="cadastro_cliente.php" class="form-cadastro">
				<!-------NOME-CLIENTE-------->
				<div class="textfield">
					<label>Nome Cliente:</label> 
					<input type="text" name="cliente[]" class="form-input">
					<br>
				</div>
				<!--------------------------->


				<!-------APELIDO-CLIENTE------->
				<div class="textfield">
					<label>Apelido:</label>
					<input type="text" name="cliente[]" class="form-input">
					<br>
				</div>
				<!--------------------------->


				<!--------TELEFONE-CLIENTE---------->
				<div class="textfield">
					<label>telefone:</label>
					<input type="text" name="cliente[]" class="form-input">
					<br>
				</div>
				<!--------------------------->

				<input type="submit" value="salvar" name="salvar" class="btn-salva">
			</form>
		</div>


</body>
</html>