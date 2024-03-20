<?php	
		if(!isset($_GET["id_produto"]))
		{
			echo "Não foi selecionado produto para edição...";
			exit();
		}

		header("Location: view_produtos.php");
			
		require_once '../funcoes/funcoes_banco.php';

		$id_produto = $_GET["id_produto"];

		$conexao = conectaBanco();
		$produto = deletaProduto($conexao, $id_produto);

	
?>
