<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="estilo_main_vendas.css" content="width=device-width,initial-scale=1.0">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mostra Vendas</title>
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

		$vendas = buscaVendas($conexao, $busca, $id_estabelecimento);
	}
	else
	{
		$vendas = buscaTodasVendas($conexao, $id_estabelecimento);
	}

	foreach($vendas as $venda)
	{
        $formatNumber = number_format($venda['total_venda'], 2);
		$formatData = date('d/m/Y H:i:s', strtotime($venda['data_venda']));
		
		echo"
		<div class=	'div-itens'>						
			<div class='div-dados'>
            	Cliente: $venda[nome_cliente]<br>
                Produto: $venda[nome_produto]<br> 
				Quantidade: $venda[quant_venda]<br>
				Data: $formatData<br><br> 
				TOTAL PEDIDO: R$$formatNumber
			</div>
		</div>
		<hr class='risco'>";
	
	}



?>