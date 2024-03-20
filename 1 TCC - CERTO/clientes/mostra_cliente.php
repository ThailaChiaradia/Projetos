<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="estilo_main_clientes.css" content="width=device-width,initial-scale=1.0">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mostra Clientes</title>
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

		$clientes = buscaClientes($conexao, $busca, $id_estabelecimento);//
	}
	else
	{
		$clientes = buscaTodosClientes($conexao, $id_estabelecimento);//
	}

	if(isset($_POST['fiado']))
	{
		$fiado = $_POST['fiado'];
		$clientes = clientesFiado($conexao, $fiado, $id_estabelecimento);//
	}
	
	foreach($clientes as $cliente)
	{

		$formatNumber = number_format($cliente['fiado_cliente'], 2);
		
		echo"
		<div class=	'div-itens'>
						
			<div class='div-dados'>		 
				NOME: $cliente[nome_cliente]<br> 
				APELIDO: $cliente[apelido_cliente]<br>
				TELEFONE: $cliente[telefone_cliente]<br><br>
				FIADO: R$$formatNumber<br>
			</div>
			
			<div class='itens-btn'>	
					<input type='submit' value ='Editar' formaction = 'view_edita_cliente.php?id_cliente=$cliente[id_cliente]' class='btn-item'>

					<input type='submit' value ='Excluir' formaction = 'view_exclui_cliente.php?id_cliente=$cliente[id_cliente]' class='btn-item'>					
			</div>		
		</div>
		<hr class='risco'>";
	
	}

?>