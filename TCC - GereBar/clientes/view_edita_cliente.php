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
	$id_estabelecimento = $estabelecimento['id_estabelecimento'];

	$nome = $estabelecimento['nome_estabelecimento'];
	$email = $logado;
	$senha = $_SESSION['senha'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Edição de Cliente</title>

		<link rel="stylesheet" href="../produtos/estilo_edita_produto.css" content="width=device-width,initial-scale=1.0">
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>

	</head>

	<?php
			require_once '../funcoes/menus_laterais.php';
			menuLateralClientes();
	?>
		
	<body>
		<div class="cabecalho">		
			<h1>Editar Cliente</h1>		
		</div><br>
		
		<?php
		
			if(!isset($_GET["id_cliente"]))
			{
				echo "Não foi selecionado cliente para edição...";
				exit();
			}

			require_once '../funcoes/funcoes_banco.php';

			$id_cliente = $_GET["id_cliente"];

			$conexao = conectaBanco();
			$cliente = buscaUmCliente($conexao, $id_cliente, $id_estabelecimento);

			if($cliente == false)
			{

				echo "Produto não encontrado com o código informado...";
				exit();
			}
		?>

		<div class="div-cadastro">
			<form method="POST" action="edita_cliente.php" class="form-cadastro">
				<input type="hidden" name="cliente[]" value = <?php echo $cliente['id_cliente']?>>

				<!-------NOME-CLIENTE-------->
				<div class="textfield">
					<label>Nome Cliente:</label> 
					<input type="text" name="cliente[]" value=  "<?php echo $cliente['nome_cliente']?>" class="form-input">
					<br>
				</div>
				<!--------------------------->


				<!-------APELIDO-CLIENTE------->
				<div class="textfield">
					<label>Apelido:</label>
					<input type="text" name="cliente[]" value = "<?php echo $cliente['apelido_cliente']?>" class="form-input">
					<br>
				</div>
				<!--------------------------->


				<!--------TELEFONE-CLIENTE---------->
				<div class="textfield">
					<label>Telefone:</label>
					<input type="text" name="cliente[]" value = "<?php echo $cliente['telefone_cliente']?>" class="form-input">
					<br>
				</div>
				<!--------------------------->	
				

				<input type="submit" value="salvar" name="salvar" class="btn-salva">
				<!--------------------------->				
			</form>
		</div>
			
	</body>
</html>
