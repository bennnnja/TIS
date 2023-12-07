<?php include_once 'Views/Plantillas/header-inicio.php'; ?>

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
					<?php foreach ($data['topProductos'] as $producto) { ?>
					<div class="card-product destacados">
						<div class="container-img">
							<img src="<?php echo BASE_URL; ?>Assets/imgs/bote helado.png" alt="<?php echo $producto['nombre_producto'] ?>" />
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
							<h3><?php echo $producto['nombre_producto'] ?></h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$<?php echo $producto['precio'] ?><</p>
						</div>
					</div>
					<?php } ?>
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

		<?php include_once 'Views/Plantillas/footer-inicio.php'; ?>

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