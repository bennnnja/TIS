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
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>Assets/css/estilo.css" />
	</head>
	<body>
		<header>
			<div class="container-hero">
				<div class="container hero">
					<div class="customer-support">
						<img src="<?php echo BASE_URL; ?>Assets/imgs/logo milano.png" alt="">
					</div>

					<div class="container-logo">
						<i class="fa-solid fa-ice-cream"></i>
						<h1 class="logo"><a href="index.html">GELATERIA MILANO</a></h1>
					</div>
						
					<a href="Views/LoginRegistro.html" class="btn__quote">Iniciar Sesion</a>

				</div>
			</div>

			<div class="container-navbar">
				<nav class="navbar container">
					<i class="fa-solid fa-bars"></i>
					<ul class="menu">
						<li><a href="index.html">Inicio</a></li>
						<li><a href="Productos.html">Productos</a></li>
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

		<section class="banner">
			<div class="content-banner">
				<p>Helado Delicioso</p>
				<h2>100% Natural <br />Helado Fresco</h2>
				<a href="Productos.html">Comprar ahora</a>
			</div>
		</section>

		<main class="main-content">
			<section class="container container-features">
				<div class="card-feature">
					<i class="fa-solid fa-location-dot"></i>
					<div class="feature-content">
						<span>Visita nuestro local</span>
						<p>Vicente Zegers 999</p>
					</div>
				</div>
				<div class="card-feature">
					<i class="fa-solid fa-ice-cream"></i>
					<div class="feature-content">
						<span>Variedad de productos</span>
						<p>Botes y paletas disponibles</p>
					</div>
				</div>
				<div class="card-feature">
					<i class="fa-solid fa-phone-volume"></i>
					<div class="feature-content">
						<span>Si tienes dudas, contactanos</span>
						<p>+56 9 83647598</p>
					</div>
				</div>
			</section>

			<section class="container top-categories">
				<h1 class="heading-1">Mejores Categorías</h1>
				<div class="container-categories">
					<div class="card-category category-moca">
						<p>BOTES</p>
						<span>Ver más</span>
					</div>
					<div class="card-category category-expreso">
						<p>PALETAS</p>
						<span>Ver más</span>
					</div>
					<div class="card-category category-capuchino">
						<p>VARIOS</p>
						<span>Ver más</span>
					</div>
				</div>
			</section>

			<section class="container top-products">
				<h1 class="heading-1">Mejores Productos</h1>
			
				<div class="container-options">
					<button class="category-btn" data-category="destacados">Destacados</button>
					<button class="category-btn" data-category="recientes">Más recientes</button>
					<button class="category-btn" data-category="vendidos">Mejores Vendidos</button>
					<button class="category-btn" data-category="todos">Todos</button>
				</div>
			
				<div class="container-products">
					<!-- Producto 1 -->
					<div class="card-product destacados">
						<div class="container-img">
							<img src="<?php echo BASE_URL; ?>Assets/imgs/bote helado.png" alt="Bote de Helado 1KG" />
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>Bote de Helado 1KG</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$13.000</p>
						</div>
					</div>
					<!-- Producto 2 -->
					<div class="card-product destacados">
						<div class="container-img">
							<img
								src="<?php echo BASE_URL; ?>Assets/imgs/bote helado.png"
								alt="Bote de helado 750Gr"
							/>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>Bote de helado 750Gr</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$10.000</p>
						</div>
					</div>
					<!-- Producto 3 -->
					<div class="card-product recientes">
						<div class="container-img">
							<img src="<?php echo BASE_URL; ?>Assets/imgs/paletas.png" alt="Pack 50 Paletas" />
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>Pack 50 Paletas</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$27.500</p>
						</div>
					</div>
					<!-- Producto 4 -->
					<div class="card-product recientes">
						<div class="container-img">
							<img src="<?php echo BASE_URL; ?>Assets/imgs/paletas.png" alt="Pack 50 Paletas" />
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>Pack 50 Paletas</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$27.500</p>
						</div>
					</div>
					<!-- Producto 5 -->
					<div class="card-product vendidos">
						<div class="container-img">
							<img src="<?php echo BASE_URL; ?>Assets/imgs/paletas.png" alt="Pack 50 Paletas" />
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>Pack 50 Paletas</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$27.500</p>
						</div>
					</div>
					<!-- Producto 6 -->
					<div class="card-product vendidos">
						<div class="container-img">
							<img src="<?php echo BASE_URL; ?>Assets/imgs/paletas.png" alt="Pack 50 Paletas" />
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>Pack 50 Paletas</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$27.500</p>
						</div>
					</div>
				</div>
			</section>
			
			<button id="filter-btn">Mostrar Todos</button>

			<section class="gallery">
				<img
					src="<?php echo BASE_URL; ?>Assets/imgs/imagen 1.webp"
					alt="Gallery Img1"
					class="gallery-img-1"
				/><img
					src="<?php echo BASE_URL; ?>Assets/imgs/imagen 2.jpg"
					alt="Gallery Img2"
					class="gallery-img-2"
				/><img
					src="<?php echo BASE_URL; ?>Assets/imgs/imagen 3.jpg"
					alt="Gallery Img3"
					class="gallery-img-3"
				/><img
					src="<?php echo BASE_URL; ?>Assets/imgs/imagen 4.jpg"
					alt="Gallery Img4"
					class="gallery-img-4"
				/><img
					src="<?php echo BASE_URL; ?>Assets/imgs/imagen 5.jpg"
					alt="Gallery Img5"
					class="gallery-img-5"
				/>
			</section>

			<section class="container specials">
				<h1 class="heading-1">Ofertas</h1>

				<div class="container-products">
					<!-- Producto 1 -->
					<div class="card-product">
						<div class="container-img">
							<img src="<?php echo BASE_URL; ?>Assets/imgs/paletas.png" alt="Cafe Irish" />
							<span class="discount">-15%</span>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>Pack 25 Paletas</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$11.900 <span>$14.000</span></p>
						</div>
					</div>
					<!-- Producto 2 -->
					<div class="card-product">
						<div class="container-img">
							<img
								src="<?php echo BASE_URL; ?>Assets/imgs/paletas.png"
								alt="Cafe incafe-ingles.jpg"
							/>
							<span class="discount">-18%</span>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>Pack 50 Paletas</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$22.550 <span>$27.500</span></p>
						</div>
					</div>
					<!--  -->
					<div class="card-product">
						<div class="container-img">
							<img src="<?php echo BASE_URL; ?>Assets/imgs/bote helado.png" alt="Cafe Viena" />
							<span class="discount">-25%</span>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
							</div>
							<h3>Bote de Helado 750GR</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$7.500 <span>$10.000</span></p>
						</div>
					</div>
					<!--  -->
					<div class="card-product">
						<div class="container-img">
							<img src="<?php echo BASE_URL; ?>Assets/imgs/bote helado.png" alt="Cafe Liqueurs" />
							<span class="discount">-23%</span>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>Bote de Helado 1KG</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$10.010 <span>$13.000</span></p>
						</div>
					</div>
				</div>
			</section>
		</main>

		<footer class="footer">
			<div class="container container-footer">
				<div class="menu-footer">
					<div class="contact-info">
						<p class="title-footer">Información de Contacto</p>
						<ul>
							<li>
								Dirección: Vicente Zegers 999, Iquique, Chile
							</li>
							<li>Teléfono: +56-572-412571</li>
							<li>WhatsApp: +569-44982963</li>
							<li>Email: info@gelateriamilano.cl</li>
						</ul>
						<div class="social-icons">
							<span class="facebook">
								<i class="fa-brands fa-facebook-f"></i>
							</span>
							<span class="twitter">
								<i class="fa-brands fa-twitter"></i>
							</span>
							<span class="youtube">
								<i class="fa-brands fa-youtube"></i>
							</span>
							<span class="instagram">
								<i class="fa-brands fa-instagram"></i>
							</span>
						</div>
					</div>

					<div class="information">
						<p class="title-footer">Información</p>
						<ul>
							<li><a href="#">Acerca de Nosotros</a></li>
							<li><a href="#">Politicas de Privacidad</a></li>
							<li><a href="#">Términos y condiciones</a></li>
						</ul>
					</div>

					<div class="my-account">
						<p class="title-footer">Mi cuenta</p>

						<ul>
							<li><a href="#">Mi cuenta</a></li>
							<li><a href="#">Historial de ordenes</a></li>
							<li><a href="#">Lista de deseos</a></li>
						</ul>
					</div>
				</div>

				<div class="copyright">
					<p>
						Desarrollado por Estudiantes UNAP
					</p>
				</div>
			</div>
		</footer>

		<script
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
		<script>
			document.addEventListener("DOMContentLoaded", function () {
    const filterButton = document.getElementById("filter-btn");
    const categoryButtons = document.querySelectorAll(".category-btn");
    const products = document.querySelectorAll(".card-product");

    // Ocultar todos los productos
    function hideAllProducts() {
        products.forEach(function (product) {
            product.style.display = "none";
        });
    }

    // Mostrar productos de una categoría específica
    function showProducts(category) {
        hideAllProducts();
        if (category === "todos") {
            products.forEach(function (product) {
                product.style.display = "block";
            });
        } else {
            const selectedProducts = document.querySelectorAll(`.${category}`);
            selectedProducts.forEach(function (product) {
                product.style.display = "block";
            });
        }
    }

    // Manejar clic en botones de categoría
    categoryButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const category = button.getAttribute("data-category");
            showProducts(category);
        });
    });

    // Manejar clic en el botón "Mostrar Todos"
    filterButton.addEventListener("click", function () {
        showProducts("todos");
    });
});

		</script>
	</body>
</html>