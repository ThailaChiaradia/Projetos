<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="estilo_login.css">
	
		<title>Login GereBar</title>
	</head>
	<body>

		<div class="main-login">
			
			<div class="left-login">
				<h1><b>GereBar</b></h1>
				<img src="imagem_login.svg" class="left-login-image" alt="imagem login GereBar">	
			</div>
			<form action="login.php" method="POST">
				<div class="right-login">
					<div class="card-login">
						<h1>LOGIN</h1>
						<!-------------------EMAIL------------------>						
						<div class="textfield">
							<label for="usuario">E-mail estabelecimento</label>
							<input type="email" name="email" placeholder="E-mail">
						</div>
						<!------------------------------------------>	

						<!------------------SENHA------------------->	
						<div class="textfield">
							<label for="senha">Senha</label>
							<input type="password" name="senha" placeholder="senha">
						</div>
						<!----------------------------------------->	

						<?php
							if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
							{	
								session_start();
        						include_once('../funcoes/funcoes_banco.php');
        						$conexao = conectaBanco();
								$email = $_POST['email'];
								$senha = $_POST['senha'];
								
								
								$sql = "SELECT * FROM ESTABELECIMENTO WHERE email_estabelecimento = '$email' and senha_estabelecimento = '$senha'";

        						$result = $conexao->query($sql);

								if(mysqli_num_rows($result) < 1)
								{//conta não existe ou incorreto
									unset($_SESSION['email']);
									unset($_SESSION['senha']);

									echo "<label class='errado'>Email ou senha incorretos!</label>";
								}
								else
								{//conta exite
									$_SESSION['email'] = $email;
									$_SESSION['senha'] = $senha;
									header("Location: ../menu/menu.php");
								}

							}
						?>

						<input type="submit" value="ENTRAR" name="submit" class="btn-login">						

						<a href="criar_conta.php" class="criar-conta">CRIAR CONTA</a>
					</div>
				</div>
			</form>
		</div>

	</body>
</html>
<?php

?>