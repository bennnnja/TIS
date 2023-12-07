<?php include_once 'Plantillas/header-inicio.php'; ?>

<section class="container top-products">
      <div class="bgh-producto">
        <h1 class="heading-producto" style="color: white">Productos</h1>
      </div>

      <div class="container-options">
        <span class="active">Botes</span>
        <span id="masRecientesTab">Paletas</span>
        <span id="mejoresVendidosTab">Ofertas</span>

        <!-- FILTRACION DE PRODUCTOS -->
        <div>
          <label for="filtro" class="label-categoria"
            >Filtrar por categoría:</label
          >
          <select
            class="select-categoria"
            id="filtro"
            onchange="filtrarProductos()"
          >
            <option value="todos">Todos</option>
            <option value="menorPrecio">Menor Precio</option>
            <option value="menorPrecio">Mayor Precio</option>
            <option value="menorPrecio">Nombre ascendente</option>
            <option value="menorPrecio">Nombre descendente</option>
            <option value="menorPrecio">Fecha ascentente</option>
            <option value="electronica">Fecha descentente</option>
          </select>
        </div>
      </div>

      <!-- FILTRACION DE PRODUCTOS -->

      <div class="container-products">
        <!-- Producto 1 -->
        <div class="card-product">
          <div class="container-img-product">
            <img src="bote helado.png" alt="Bote de Helado 1KG" />
            <div class="button-group-product">
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
          <p class="price-product">$11.000</p>
          <div class="content-card-product-page">
            <div class="stars">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-regular fa-star"></i>
            </div>
            <h3>Bote de Helado 1KG</h3>
            <button class="add-producto">
              <i class="fa-solid fa-basket-shopping"></i>
              <span>Agregar al carrito</span>
            </button>
          </div>
        </div>
        <!-- Producto 2 -->
        <div class="card-product">
          <div class="container-img-product">
            <img src="bote helado.png" alt="Bote de Helado 1KG" />
            <div class="button-group-product">
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
          <p class="price-product">$8.500</p>
          <div class="content-card-product-page">
            <div class="stars">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-regular fa-star"></i>
            </div>
            <h3>Bote de Helado 750gr</h3>
            <button class="add-producto">
              <i class="fa-solid fa-basket-shopping"></i>
              <span>Agregar al carrito</span>
            </button>
          </div>
        </div>
        <!--  -->

        <div class="card-product">
          <div class="container-img-product">
            <img src="paletas.png" alt="Pack 25 Paletas" />
            <div class="button-group-product">
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
          <p class="price-product">$6.000</p>
          <div class="content-card-product-page">
            <div class="stars">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-regular fa-star"></i>
            </div>
            <h3>Bote de helado 500gr</h3>
            <button class="add-producto">
              <i class="fa-solid fa-basket-shopping"></i>
              <span>Agregar al carrito</span>
            </button>
          </div>
        </div>
        <!--  -->
      </div>
</section>
    <?php include_once 'Views/Plantillas/footer-inicio.php'; ?>
    <script
      src="https://kit.fontawesome.com/81581fb069.js"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
