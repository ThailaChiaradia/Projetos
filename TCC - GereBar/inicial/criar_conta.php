<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="estilo_criar_conta.css">

		<title>Criar Conta GereBar</title>
	</head>

	<body>

		<div class="main-criar-conta">
			
			<div class="left-conta">
				<h1><b>GereBar</b></h1>					
				<img src="imagem_login.svg" class="left-login-image" alt="imagem login GereBar">
				<h3 class="textoh3">Gerenciamento de Bar Online</h3>
			</div>

		<form action="criar_conta.php" method="POST">
			<div class="right-conta">
				<div class="card-conta">
					<h1>CRIAR CONTA</h1>

					<!-------------------NOME-ESTABELECIMENTO------------------>
					<div class="textfield">
						<label>Nome Estabelecimento</label>
						<input type="text" name="nome" placeholder="estabelecimento" required>
					</div>
					<!--------------------------------------------------------->


					<!-----------------------EMAIL----------------------------->
					<div class="textfield">
						<label>E-mail</label>
						<input type="email" name="email" placeholder="e-mail" required>
					</div>
					<!--------------------------------------------------------->


					<!-----------------------SENHA----------------------------->
					<div class="textfield">
						<label>Senha</label>
						<input type="password" name="senha" placeholder="senha" required>
					</div>
					<!---------------------------------------------------------->
                    
                    <?php
    
                    	if(isset($_POST['submit']))
                    	{
                    		require_once '../funcoes/funcoes_banco.php';
                    		$conexao = conectaBanco();
                    
                            mysqli_select_db($conexao, "id19742933_barfagundes");
                            
                    		$nome = $_POST['nome'];
                    		$email = $_POST['email'];
                    		$senha = $_POST['senha'];
                    		
                    		$select_email = "SELECT * FROM estabelecimento where email_estabelecimento = '$email' LIMIT 1";
                    		$resultado = mysqli_query($conexao, $select_email);
                            
                            if(mysqli_num_rows($resultado) == 0)
                    		{
                    		    $sql = "INSERT INTO estabelecimento (nome_estabelecimento, email_estabelecimento, senha_estabelecimento) VALUES ('$nome', '$email', '$senha')";
                    		    $sucesso = mysqli_query($conexao, $sql);
                    		    
                    		    if($sucesso == 1)
                        		{
                    				echo "<script>window.location.replace('login.php');</script>";
                        		}
                        		else
                        		{
                        		    echo "<label style = 'color: red' class='errado'>Erro ao cadastrar estabelecimento. Tente novamente mais tarde.</label>";    		
                        		}			
                    		}
                    		else
                    		{
                    		    echo "<label style = 'color: red' class='errado'>E-mail ja cadastrado</label>";
                    		}
                    	}   
                    
                    ?>  
                    
					<input type="submit" name="submit" class="btn-conta" value="cadastrar">

					<a href="login.php" class="criar-conta">ENTRAR COM CONTA EXISTENTE</a>
				</div>
			</div>
		</form>
			

		</div>

	</body>
</html>