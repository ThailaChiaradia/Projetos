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

	require_once '../funcoes/funcoes_banco.php';
	$conexao = conectaBanco();

	$produtos = buscaTodosProdutos($conexao, $id_estabelecimento);
	$clientes = buscaTodosClientes($conexao, $id_estabelecimento);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="estilo_cadastro_vendas.css" content="width=device-width,initial-scale=1.0">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	<title>Cadastro Venda</title>
</head>

	<?php
		require_once '../funcoes/menus_laterais.php';
		menuLateralVendas();
	?>

	<header>
		<div class="cabecalho">
			<h1>Saldar Fiado</h1>
		</div>		
	</header>

<body>

	<div class="div-cadastro">
			<form method="POST" action="pagar_fiado.php" class="form-cadastro">
				<!--------NOME-CLIENTE---------->
				<div class="textfield">
					<label>Nome Cliente:</label>
					<select class="selects" name="pagar[]">
						<option>Selecione</option>
						<?php foreach($clientes as $cliente){ ?>
						<option><?php echo"$cliente[nome_cliente]<br>";} ?></option>
					</select>
					<br>
				</div>
				<!--------------------------->
                
                <!--------------------------->
                <div class="textfield">
					<label>Valor Pagamento:</label>
					<input type="number" name="pagar[]" step="0.01">
					<br>
				</div>
                <!--------------------------->


				<input type="submit" value="salvar" class="btn-salva">
			</form>			
		</div>

</body>
</html>




