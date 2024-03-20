<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="estilo_main-produto.css" content="width=device-width,initial-scale=1.0">
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

	//////////////////////salvamento-de-arquivo///////////////////
	if(isset($_FILES['arquivo']))
	{
		$arquivo = $_FILES['arquivo'];

		$pasta = "arquivos/";

		$nomeDoArquivo = $arquivo['name'];

		$novoNomeDoArquivo = uniqid();

		$extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));

		$path = $pasta . $novoNomeDoArquivo . "." . $extensao;

		$deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

	}

	$sql_query = $conexao->query("SELECT * FROM PRODUTO");
	/////////////////////////////////////////////////////////


		if(isset($_POST['busca']))
		{

			$busca = $_POST['busca'];

			$produtos = buscaProdutos($conexao, $busca, $id_estabelecimento);
		}
		else
		{
			$produtos = buscaTodosProdutos($conexao, $id_estabelecimento);
		}
		
		foreach($produtos as $produto)
		{
				echo"
				<div class=	'div-itens'>";
									

					if($arquivo = $sql_query->fetch_assoc())
					{	
					echo"<div class='div-img'>
							<img src='$produto[imagem_produto]'; class='img-item'><br>
						</div>";
					}
					
					$formatNumber = number_format($produto['valor_produto'], 2);
		
						
					echo"<div class='div-dados'>
						NOME: $produto[nome_produto]<br> 
						VALOR: R$$formatNumber<br><br> 
						LOCAL ARMAZENAMENTO: $produto[local_produto]<br>
						RECEITA: $produto[receita_produto]<br>								
					</div>
					
					<div class='itens-btn'>	
							<input type='submit' value ='Editar' formaction = 'view_edita_produto.php?id_produto=$produto[id_produto]' class='btn-item'>

							<input type='submit' value ='Excluir' formaction = 'view_exclui_produto.php?id_produto=$produto[id_produto]' class='btn-item'>					
					</div>
				</div>
				<hr class='risco'>";
		
		}

?>