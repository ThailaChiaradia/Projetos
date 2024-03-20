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
<meta charset="utf-8">
<html>
	<head>
		<title>GereBar</title>

		<link rel="stylesheet" href="estilo_cadastro_produto.css" content="width=device-width,initial-scale=1.0">
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>

	</head>

	<!----------------------MENU--LATERAL-------------------------->
	<?php
		require_once '../funcoes/menus_laterais.php';
		menuLateralProdutos();
	?>
	<!------------------------------------------------------------->
	<body>


		<div class="cabecalho">
			<h1>Cadastro Produtos</h1>
		</div>

		<div class="div-cadastro">
			<form method="POST" action="cadastro_produto.php" class="form-cadastro" enctype="multipart/form-data">
				<br>
				<!-------NOME-PRODUTO-------->
				<div class="textfield">
					<label>Nome Produto:</label> 
					<input type="text" name="produto[]" class="form-input">
				</div><br>
				<!--------------------------->


				<!-------VALOR-PRODUTO------->
				<div class="textfield">
					<label>Valor:</label>
					<input type="number" name="produto[]" class="form-input" step="0.01">
				</div><br>
				<!--------------------------->


				<!--------LOCAL ARMAZENAMENTO---------->
				<div class="textfield">
					<label>Local Armazenamento:</label>
					<input type="text" name="produto[]" class="form-input">
				</div><br>
				<!--------------------------->

				<!--------RECEITA---------->
				<div class="textfield">
					<label>Receita:</label>
					<input type="text" name="produto[]" class="form-input">
				</div><br>
				<!--------------------------->

				<!-----------IMAGEM---------------->
				<div class="textfield">
					<label>Imagem:</label><br>
					<input type="file" name="arquivo" class="form-btn">
					<br><br>
				</div>

					<input type="submit" value="salvar" name="salvar" class="btn-salva">
				<!--------------------------->
				
			</form>
		</div>
			

	</body>
</html>




