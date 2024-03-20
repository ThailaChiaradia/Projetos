<html>
	<head>
	<script src="https://kit.fontawesome.com/f7c4b8b062.js" crossorigin="anonymous"></script>
	</head>
</html>
<?php

	function menuLateralClientes() 
	{
		echo'
			<input type="checkbox" id="check">
		<label for="check">
			<i class="fas fa-bars" id="btn"></i>
			<i class="fas fa-times" id="cancel"></i>
		</label>


		<div class="sidebar">
			<header>GereBar</header>

			<a href="../menu/menu.php">
				<i class="fas fa-user"></i>
				<span>Perfil usuário</span>
			</a>

			<a href="../produtos/view_produtos.php">
				<i class="fas fa-beer"></i>
				<span>Produtos</span>
			</a>

			<a href="view_clientes.php" class="active">
				<i class="fas fa-users"></i>
				<span>Clientes</span>
			</a>

			<a href=../vendas/view_vendas.php>
				<i class="fas fa-shopping-cart"></i>
				<span>Vendas</span>
			</a>

			<a href="../funcoes/sair.php">
				<i class="fa-solid fa-right-from-bracket"></i>
				<span>SAIR</span>
			</a>
		</div>
		';
	}

	function menuLateralMenu()
	{
		echo'
			<div class="sidebar">
				<header>GereBar</header>

				<a href="menu.php" class="active">
					<i class="fas fa-user"></i>
					<span>Perfil usuário</span>
				</a>

				<a href="../produtos/view_produtos.php">
					<i class="fas fa-beer"></i>
					<span>Produtos</span>
				</a>

				<a href="../clientes/view_clientes.php">
					<i class="fas fa-users"></i>
					<span>Clientes</span>
				</a>

				<a href="../vendas/view_vendas.php">
					<i class="fas fa-shopping-cart"></i>
					<span>Vendas</span>
				</a>

				<a href="../funcoes/sair.php">
				<i class="fa-solid fa-right-from-bracket"></i>
				<span>SAIR</span>
				</a>
			</div>
		';
	}

	function menuLateralProdutos()
	{
		echo'
		<input type="checkbox" id="check">
		<label for="check">
			<i class="fas fa-bars" id="btn"></i>
			<i class="fas fa-times" id="cancel"></i>
		</label>


			<div class="sidebar">
				<header>GereBar</header>

				<a href="../menu/menu.php">
					<i class="fas fa-user"></i>
					<span>Perfil usuário</span>
				</a>

				<a href="view_produtos.php" class="active">
					<i class="fas fa-beer"></i>
					<span>Produtos</span>
				</a>

				<a href="../clientes/view_clientes.php">
					<i class="fas fa-users"></i>
					<span>Clientes</span>
				</a>

				<a href="../vendas/view_vendas.php">
					<i class="fas fa-shopping-cart"></i>
					<span>Vendas</span>
				</a>

				<a href="../funcoes/sair.php">
				<i class="fa-solid fa-right-from-bracket"></i>
				<span>SAIR</span>
				</a>
			</div>
		';
	}


	function menuLateralVendas()
	{
		echo'
			<input type="checkbox" id="check">
			<label for="check">
				<i class="fas fa-bars" id="btn"></i>
				<i class="fas fa-times" id="cancel"></i>
			</label>


			<div class="sidebar">
				<header>GereBar</header>

				<a href="../menu/menu.php">
					<i class="fas fa-user"></i>
					<span>Perfil usuário</span>
				</a>

				<a href="../produtos/view_produtos.php">
					<i class="fas fa-beer"></i>
					<span>Produtos</span>
				</a>

				<a href="../clientes/view_clientes.php">
					<i class="fas fa-users"></i>
					<span>Clientes</span>
				</a>

				<a href="view_vendas.php" class="active">
					<i class="fas fa-shopping-cart"></i>
					<span>Vendas</span>
				</a>

				<a href="../funcoes/sair.php">
				<i class="fa-solid fa-right-from-bracket"></i>
				<span>SAIR</span>
				</a>
			</div>
		';
	}

?>