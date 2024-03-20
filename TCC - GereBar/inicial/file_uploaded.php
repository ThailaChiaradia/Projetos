<?php
	
	if(count($_FILES) > 0)
	{
		$file_name = $_FILES["produto"]["name"];
		print_r($_FILES);
		
		$extensao = pathinfo($_FILES["produto"]["name"], PATHINFO_EXTENSION);		

		$array_nome_arquivo = explode(".", $file_name);
		$novo_nome_arquivo = "";
		$tam = count($array_nome_arquivo)- 1;

		for ($i=0; $i < $tam; $i++) 
		{ 
			$novo_nome_arquivo .= $array_nome_arquivo[$i].".";
		}

		$novo_nome_arquivo .= $data.".".$array_nome_arquivo[$tam];


		$sucesso = move_uploaded_file($_FILES["produto"]["tmp_name"], ".imagens/$novo_nome_arquivo");

		if($sucesso > 0)
		{
			echo "Arquivo movido com sucesso";
		}
		else
		{
			echo"erro ao mover arquivo";
			echo"$sucesso";
		}

	}

?>