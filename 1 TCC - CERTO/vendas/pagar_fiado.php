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

	$pagar = $_POST['pagar'];

	$sqlCliente = "SELECT * FROM cliente WHERE nome_cliente = '$pagar[0]'";
	$sucessoCliente = mysqli_query($conexao, $sqlCliente);
	$cliente = mysqli_fetch_assoc($sucessoCliente);

	$idCliente = $cliente['id_cliente'];
	$nomeCliente = $cliente['nome_cliente'];
	$fiadoAntigo = $cliente['fiado_cliente'];

	$novoFiado = $fiadoAntigo - $pagar[1];

	$updateFiado = "UPDATE CLIENTE SET fiado_cliente = '$novoFiado' WHERE id_cliente = $idCliente";
	$sucessor2 = mysqli_query($conexao, $updateFiado);

	header("Location: ../clientes/view_clientes.php");
?>

