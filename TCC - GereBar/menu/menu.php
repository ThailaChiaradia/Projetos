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
	$senha = $estabelecimento['senha_estabelecimento'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Menu GereBar</title>
		<link rel="stylesheet" href="estilo_menu.css" content="width=device-width,initial-scale=1.0">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" /><!--icone abrir menu vertical-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<script src="https://kit.fontawesome.com/f7c4b8b062.js" crossorigin="anonymous"></script>
	</head>

		<?php
			require_once '../funcoes/menus_laterais.php';
			menuLateralMenu();
		?>
	

		<div class="menu-cima">
			<h1>Perfil Usuário</h1>
		</div>
	<body>

		<div class="main-menu">
			<div class="left-div">
				<img src="bartender.svg" class="left-login-image" alt="imagem login GereBar">
			</div>

			<div class="right-div">
			<form method="POST" action="menu.php" class="form-cadastro">
				<div class="card-conta">
					<h1>MUDAR CREDENCIAIS</h1><br>
					<div class="textfield">
						<label>Nome Estabelecimento: </label> 
						<input name="nome" type="text" value="<?php echo $nome?>" class="form-input" required>
						<br>
					</div>

					<div class="textfield">
						<label>Email:</label> 
						<input name="email" type="text" value= "<?php echo $email?>" class="form-input" required>
						<br>
					</div>

					<div class="textfield">
						<label class="centraliza">ALTERAR SENHA</label>
						<label>Nova senha:</label> 
						<input name="senhanova" type="password" class="form-input">
						<br>
					</div>

					<div class="textfield">
						<label>Senha atual:</label>
						<input name="senhaantiga" type="password" class="form-input" required>
					</div>

					<?php
						if(isset($_POST['salvatudo']))
						{
							$nome = $_POST['nome'];
							$email = $_POST['email'];
							$senhanova = $_POST['senhanova'];
							$senhaantiga = $_POST['senhaantiga'];
						
							if($senha == $senhaantiga and $senhanova != false)
							{   
								echo "<label class='tudocerto'>Credenciais alteradas com sucesso!</label>";
								
								$alteraEstabelecimento = "UPDATE ESTABELECIMENTO SET nome_estabelecimento = '$nome', email_estabelecimento = '$email', senha_estabelecimento = '$senhanova' WHERE email_estabelecimento = '$logado'";
								$sucesso = mysqli_query($conexao, $alteraEstabelecimento);				
							}
							elseif($senha == $senhaantiga and $senhanova == false)
							{  
								echo "<label class='tudocerto'>Credenciais alteradas com sucesso!</label>";
								
								$alteraEstabelecimento = "UPDATE ESTABELECIMENTO SET nome_estabelecimento = '$nome', email_estabelecimento = '$email', senha_estabelecimento = '$senha' WHERE email_estabelecimento = '$logado'";
								$sucesso = mysqli_query($conexao, $alteraEstabelecimento);
							}
							elseif($senha != $senhaantiga)
							{   
								echo "<label class='errado'>Senha inválida!</label>";
							}
						}
					?>
					<input name="salvatudo" type="submit" value="Alterar Dados" class="btn-conta">
					
				</div>				
			</form>
			</div>
		</div>
	</;body>
</html>