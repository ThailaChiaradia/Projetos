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
<html>
	<head>
		<meta charset="utf-8">
		<title>Edição de Produto</title>

		<link rel="stylesheet" href="estilo_edita_produto.css" content="width=device-width,initial-scale=1.0">
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>

	</head>

	<?php
		require_once '../funcoes/menus_laterais.php';
		menuLateralProdutos();
	?>

	
	<body>
		<div class="cabecalho">		
			<h1>Editar Produto</h1>		
		</div><br>
		

		<?php
		
			if(!isset($_GET["id_produto"])){

				echo "Não foi selecionado produto para edição...";
				exit();
			}

			require_once '../funcoes/funcoes_banco.php';

			$id_produto = $_GET["id_produto"];

			$conexao = conectaBanco();
			$produto = buscaUmProduto($conexao, $id_produto, $id_estabelecimento);

			if($produto == false){

				echo "Produto não encontrado com o código informado...";
				exit();
			}
		?>

		<div class="div-cadastro">
			<form method="POST" action="edita_produto.php" class="form-cadastro" enctype="multipart/form-data">
				<input type="hidden" name="produto[]" value = <?php echo $produto['id_produto']?>>

				<!-------NOME-PRODUTO-------->
				<div class="textfield">
					<label>Nome Produto:</label> 
					<input type="text" name="produto[]" value=  "<?php echo $produto['nome_produto']?>" class="form-input">
				</div>
				<!--------------------------->


				<!-------VALOR-PRODUTO------->
				<div class="textfield">
					<label>Valor:</label>
					<input type="number" name="produto[]" value = "<?php echo $produto['valor_produto']?>" class="form-input" step="0.01">
				</div>
				<!--------------------------->

				<!--------LOCAL---------->
				<div class="textfield">
					<label>Local Armazenamento:</label>
					<input type="text" name="produto[]" value = "<?php echo $produto['local_produto']?>" class="form-input">
				</div>
				<!--------------------------->


				<!--------RECEITA---------->
				<div class="textfield">
					<label>Receita:</label>
					<input type="text" name="produto[]" value = "<?php echo $produto['receita_produto']?>" class="form-input">
				</div>
				<!--------------------------->

				<!-----------IMAGEM---------------->
				<div class="textfield">
					<label>Imagem:</label><br>
					<input type="file" name="arquivo" value="<?php echo $produto['imagem_produto']?>" class="form-btn">
					<br><br>
				</div>		
				

					<input type="submit" value="salvar alterações" name="salvar" class="btn-salva">
				<!--------------------------->
				
			</form>
		</div>
			
	</body>
</html>
