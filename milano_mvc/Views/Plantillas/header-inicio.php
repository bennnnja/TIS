<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<title>Gelateria Milano</title>

		<link rel="stylesheet" href="<?php echo BASE_URL; ?>Assets/css/estilo">

</head>
   
<body>
		<header>
			<div class="container-hero">
				<div class="container hero">
					<div class="customer-support">
						<img src="<?php echo BASE_URL ?>Assets/imgs/logomilano.png" alt="">
					</div>

					<div class="container-logo">
						<i class="fa-solid fa-ice-cream"></i>
						<h1 class="logo"><a href="index.php">GELATERIA MILANO</a></h1>
					</div>
						
					

					<div class="container-user">
					<a href="#" data-toggle="modal" data-target="#modalLogin"><i class="fa-solid fa-user"></i></a>
					<a href="#" id="verCarrito">
                              <i class="fa-solid fa-basket-shopping" aria-hidden="false"></i>
                              <span class="padding_10" id="btnCantidadCarrito"></span></a>
					</div>		
				</div>
			</div>

			<div class="container-navbar">
				<nav class="navbar container">
					<i class="fa-solid fa-bars"></i>
					<ul class="menu">
						<li><a href="<?php echo BASE_URL ?>">Inicio</a></li>
						<li><a href="<?php echo BASE_URL . 'principal/productos' ?>">Productos</a></li>
						<li><a href="SobreNosotros.html">Sobre Nosotros</a></li>
					</ul>

					<form class="search-form">
						<input type="search" placeholder="Buscar..." />
						<button class="btn-search">
							<i class="fa-solid fa-magnifying-glass"></i>
						</button>
					</form>
				</nav>
			</div>
		</header>
</body>