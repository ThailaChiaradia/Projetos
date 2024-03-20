<?php

	function conectaBanco()
	{
		$conexao = mysqli_connect("localhost", "root", "", "gerebar");//(endereço, usuario, senha, base dados)

		if(!$conexao)
		{
			echo "Erro ao conectar com a base de dados";
			echo "<br>";
			echo mysqli_connect_error();
		}

		return $conexao;
	}

//--------------------------------------------------------------------------------//

	function salvaCliente($conexao, $cliente, $id_estabelecimento)
	{
		$sql = "INSERT INTO cliente (nome_cliente, apelido_cliente, telefone_cliente, id_estabelecimento) VALUES ('$cliente[0]', '$cliente[1]', '$cliente[2]', '$id_estabelecimento')";

		$sucesso = mysqli_query($conexao, $sql);

	}

	function clientesFiado($conexao, $fiado_cliente, $id_estabelecimento)
	{
		$sql = "SELECT * FROM cliente WHERE fiado_cliente > 0 and id_estabelecimento=$id_estabelecimento";

		$resultados = mysqli_query($conexao, $sql);

		$listaClientes = [];

		while($registro = mysqli_fetch_array($resultados))
		{
			$listaClientes[] = $registro;
		}

		return $listaClientes;
	}

	function buscaClientes($conexao, $nome_cliente, $id_estabelecimento)
	{
		$sql = "SELECT * FROM cliente WHERE nome_cliente LIKE '%$nome_cliente%' and id_estabelecimento=$id_estabelecimento";

		$resultados = mysqli_query($conexao, $sql);

		$listaClientes = [];

		while($registro = mysqli_fetch_array($resultados))
		{
			$listaClientes[] = $registro;
		}

		return $listaClientes;
	}

	function buscaUmCliente($conexao, $id_cliente, $id_estabelecimento)
	{

		$sql = "SELECT * FROM cliente WHERE ID_CLIENTE=$id_cliente and id_estabelecimento=$id_estabelecimento";

		$resultado = mysqli_query($conexao, $sql);

		if($registro = mysqli_fetch_array($resultado))
		{
			return $registro;
		}
		else
		{
			return false;
		}
	}

	function buscaTodosClientes($conexao, $id_estabelecimento)
	{
		$sql = "SELECT * FROM cliente WHERE id_estabelecimento=$id_estabelecimento ORDER BY id_cliente DESC";
		$resultados = mysqli_query($conexao, $sql);

		$listaClientes = [];

		while($registro = mysqli_fetch_array($resultados))
		{
			$listaClientes[] = $registro;
		}

		return $listaClientes;
	}

	function updateCliente($conexao, $cliente)//
	{
		
		$sql = "UPDATE cliente SET nome_cliente = '$cliente[1]', apelido_cliente = '$cliente[2]', telefone_cliente = '$cliente[3]' WHERE id_cliente = $cliente[0]";

		$sucesso = mysqli_query($conexao, $sql);

		return $sucesso;
	}

	function deletaCliente($conexao, $id_cliente)//
	{
		
		$sql = "DELETE FROM cliente WHERE ID_CLIENTE=$id_cliente";

		$resultado = mysqli_query($conexao, $sql);

		if($registro = mysqli_fetch_array($resultado))
		{
			return $registro;
		}
		else
		{
			return false;
		}
	}

//--------------------------------------------------------------------------------//

	function salvaImagem($conexão, $produto, $arquivo)
	{
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


		if($deu_certo)
		{
			$sql = "INSERT INTO produto (imagem_produto, path) VALUES ('$nomeDoArquivo', '$path')";
		}
	}

	function salvaProduto($conexao, $produto, $arquivo, $id_estabelecimento)
	{

		if($_FILES['arquivo']['tmp_name'])//se troca imagem
		{

			$arquivo = $_FILES['arquivo']['name'];
			
			$pasta = "arquivos/".$arquivo;

			move_uploaded_file($_FILES['arquivo']['tmp_name'],$pasta);


			$sql = "INSERT INTO produto (nome_produto, valor_produto, local_produto, receita_produto, imagem_produto, id_estabelecimento) VALUES ('$produto[0]', '$produto[1]', 
			'$produto[2]', '$produto[3]', '$pasta', '$id_estabelecimento')";
			
			$sucesso = mysqli_query($conexao, $sql);

			return $sucesso;
		}
	}

	function buscaUmProduto($conexao, $id_produto, $id_estabelecimento)
	{

		$sql = "SELECT * FROM produto WHERE ID_PRODUTO=$id_produto and id_estabelecimento=$id_estabelecimento";

		$resultado = mysqli_query($conexao, $sql);

		if($registro = mysqli_fetch_array($resultado))
		{
			return $registro;
		}
		else
		{
			return false;
		}
	}

	function buscaProdutos($conexao, $nome_produto, $id_estabelecimento)
	{

		$sql = "SELECT * FROM produto WHERE nome_produto LIKE '%$nome_produto%' and id_estabelecimento=$id_estabelecimento";

		$resultados = mysqli_query($conexao, $sql);

		$listaProdutos = [];

		while($registro = mysqli_fetch_array($resultados))
		{

			$listaProdutos[] = $registro;
		}

		return $listaProdutos;
	}

	function buscaTodosProdutos($conexao, $id_estabelecimento)
	{

		$sql = "SELECT * FROM produto WHERE id_estabelecimento=$id_estabelecimento ORDER BY id_produto DESC";
		$resultados = mysqli_query($conexao, $sql);

		$listaProdutos = [];

		while($registro = mysqli_fetch_array($resultados))
		{
			$listaProdutos[] = $registro;
		}

		return $listaProdutos;
	}

	function updateProduto($conexao, $produto)
	{
		if($_FILES['arquivo']['tmp_name'])//se troca imagem
		{

			$arquivo = $_FILES['arquivo']['name'];
			
			$pasta = "arquivos/".$arquivo;

			move_uploaded_file($_FILES['arquivo']['tmp_name'],$pasta);

			$sql = "UPDATE produto SET nome_produto = '$produto[1]', valor_produto = '$produto[2]', local_produto = '$produto[3]', receita_produto = '$produto[4]',
			 imagem_produto = '$pasta' WHERE id_produto = $produto[0]";

			$sucesso = mysqli_query($conexao, $sql);

			return $sucesso;
		}
		else //quando não troca imagem
		{
			$sql = "UPDATE produto SET nome_produto = '$produto[1]', valor_produto = '$produto[2]', local_produto = '$produto[3]', receita_produto = '$produto[4]' WHERE
			 id_produto = $produto[0]";

			$sucesso = mysqli_query($conexao, $sql);

			return $sucesso;
		}
	}

	function deletaProduto($conexao, $id_produto)
	{
		
		$sql = "DELETE FROM produto WHERE ID_PRODUTO=$id_produto";

		$resultado = mysqli_query($conexao, $sql);

		if($registro = mysqli_fetch_array($resultado))
		{
			return $registro;
		}
		else
		{
			return false;
		}
	}

//--------------------------------------------------------------------------------//

	function salvaVenda($conexao, $venda, $id_estabelecimento)
	{
		$sql = "INSERT INTO venda (id_venda, id_prod, nome_produto, nome_cliente, quant_venda, id_cli, total_venda, data_venda, id_estabelecimento) VALUES ('$venda[0]', '$venda[1]', '$venda[2]', '$venda[3]', '$venda[4]', '$venda[5]', '$venda[6]', '$venda[7]', '$id_estabelecimento')";

		$sucesso = mysqli_query($conexao, $sql);

		if($sucesso == 1)
		{
			echo "venda cadastrada com sucesso!";
		}
		else
		{
			echo"erro ao cadastrar a venda";
			echo mysqli_error($conexao);
		}
	}

	function buscaVendas($conexao, $data_venda, $id_estabelecimento)
	{
		$sql = "SELECT * FROM venda WHERE data_venda LIKE '%$data_venda%' and id_estabelecimento=$id_estabelecimento";

		$resultados = mysqli_query($conexao, $sql);

		$listaVendas = [];

		while($registro = mysqli_fetch_array($resultados))
		{
			$listaVendas[] = $registro;
		}

		return $listaVendas;
	}

	function buscaUmaVenda($conexao, $data_venda, $id_estabelecimento)
	{

		$sql = "SELECT * FROM venda WHERE data_venda=$data_venda and id_estabelecimento=$id_estabelecimento";

		$resultado = mysqli_query($conexao, $sql);

		if($registro = mysqli_fetch_array($resultado))
		{
			return $registro;
		}
		else
		{
			return false;
		}
	}

	function buscaTodasVendas($conexao, $id_estabelecimento)
	{
		$sql = "SELECT * FROM venda WHERE id_estabelecimento=$id_estabelecimento ORDER BY id_venda DESC";
		$resultados = mysqli_query($conexao, $sql);

		$listaVendas = [];

		while($registro = mysqli_fetch_array($resultados))
		{
			$listaVendas[] = $registro;
		}

		return $listaVendas;
	}



?>