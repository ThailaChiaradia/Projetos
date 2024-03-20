<?php

    session_start();

    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {//acessa sistema

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

            $mensagem = "Email ou senha incorretos";
            $vmensagem = 1;
            header("Location: login.php");
        }
        else
        {//conta exite
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header("Location: ../menu/menu.php");
        }


    }
    else
    {//não acessa
        header("Location: login.php");
    }
?>