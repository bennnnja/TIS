<?php include_once __DIR__ . '/../Plantillas/header-inicio.php';
?>

<div class="container py-5">
    <?php if (!empty($_SESSION["emailCliente"])) { ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tableListaProductos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Seleccionar cantidad</th>
                                    <th>Subtotal</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <h3 id="totalProducto"></h3>
                    <button id="btnPagar" class="btn btn-success">Pagar</button>
                </div>
            </div>
                    <script>
                        const rutCliente = '<?php echo isset($_SESSION["rutCliente"]) ? $_SESSION["rutCliente"] : ""; ?>';
                    </script>


        </div>
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <img class="img-thumbnail rounded-circle" src="https://st3.depositphotos.com/11742109/36001/v/450/depositphotos_360013274-stock-illustration-anonymous-gender-neutral-face-avatar.jpg" alt="" width="150">
                    <hr>
                    <p><p><?php echo $_SESSION['nombreCliente']; ?></p></p>
                    <p><p><?php echo $_SESSION['rutCliente']; ?></p></p>
                    <p><i class="fas fa-envelope"></i> <?php echo $_SESSION['emailCliente']; ?></p>
                    <p>Boton pagar</p>
                </div>
            </div>

        </div>
    </div>
    <?php } else { ?>
        <div class="alert alert-danger text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div class="h3">
                No estas registrado
            </div>
        </div>
    <?php } ?>
</div>

<?php include_once __DIR__ . '/../Plantillas/footer-inicio.php'; ?>
<script
      src="https://kit.fontawesome.com/81581fb069.js"
      crossorigin="anonymous"
    ></script>
<script src="<?php echo BASE_URL . 'Assets/js/clientes.js' ?>"></script>

</body>

</html>