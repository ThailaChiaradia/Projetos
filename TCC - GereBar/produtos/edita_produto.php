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
<?php
	
	require_once '../funcoes/funcoes_banco.php';

	$produto = $_POST["produto"];

	$arquivo = $_FILES['arquivo'];

	$conexao = conectaBanco();

	updateProduto($conexao, $produto, $arquivo);


	header("Location: view_produtos.php?id_produto=$produto[0]");

?>