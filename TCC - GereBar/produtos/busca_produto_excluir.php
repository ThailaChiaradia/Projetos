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
	<link rel="stylesheet" href="estilo_busca_exclui_produto.css" content="width=device-width,initial-scale=1.0">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

</body>
</html>
<?php
 	require_once '../funcoes/funcoes_banco.php';
 	
	$conexao = conectaBanco();

		if(isset($_POST['busca']))
		{

			$busca = $_POST['busca'];

			$produtos = buscaProdutos($conexao, $busca);
		}
		else
		{
			$produtos = buscaTodosProdutos($conexao);
		}
		
		foreach($produtos as $produto)
		{

			echo"
			<div class=	'div-itens'>
				<p class='itens'>

						
						<img style='width: 150px; height: 150px;' class='img-item'><br>
						
						ID Produto: $produto[id_produto]<br> 
						Nome: $produto[nome_produto]<br> 
						Valor: R$$produto[valor_produto]<br> 
						Descrição: $produto[receita_produto]<br>
					
						
						<input type='submit' value ='Excluir' formaction = 'view_exclui_produto.php?id_produto=$produto[id_produto]' class='btn-item'>
				</p>
				<hr>
			</div>";
		}

		

?>