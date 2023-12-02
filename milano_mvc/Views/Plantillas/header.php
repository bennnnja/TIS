<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>GELATERIA MILANO</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>Assets/css/styles.css">
    <link href="<?php echo BASE_URL; ?>Assets/css/sb-admin-2.css" rel="stylesheet">
</head>
<body>
    
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="MiPerfil.php">
    <div class="sidebar-brand-icon rotate-n-15">
    </div>
    <div class="sidebar-brand-text mx-3">ADMIN</div>
</a>
<hr class="sidebar-divider my-0">
<li class="nav-item active">
    <a class="nav-link" href="Graficos.php">
        <i class="material-icons-outlined"></i>
        <span>Graficos</span></a>
</li>
<hr class="sidebar-divider">
<div class="sidebar-heading">
    ADMINISTRADOR
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="CRUDProductos.php">
    <span class="material-icons">pattern</span>
        <span>Productos</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="CRUDProveedor.php">
        <span class="material-icons">category</span>
        <span>Proveedor</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="CRUDOrdenCompra.php">
    <span class="material-icons">pattern</span>
        <span>Orden de compra</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="CRUDIngrediente.php">
    <span class="material-icons">pattern</span>
        <span>Ingrediente</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="CRUDOferta.php">
    <span class="material-icons">pattern</span>
        <span>Oferta</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="CRUDPedido.php">
    <span class="material-icons">pattern</span>
        <span>Pedido</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="CRUDEmpleado.php">
    <span class="material-icons">pattern</span>
        <span>Empleado</span>
    </a>
</li>
<hr class="sidebar-divider">
<div class="sidebar-heading">
    PERFIL
</div>
<li class="nav-item">
    <a class="nav-link collapsed" href="MiPerfil.php">
        <span class="material-icons">people</span>
        <span>Información usuario</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="../../includes/_sesion/cerrarSesion.php">
    <span class="material-icons">logout</span>
        <span>Salir</span></a>
        
</li>

<hr class="sidebar-divider d-none d-md-block">

<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0"></button>
</div>
</ul>
<!-- EMPIEZA EL NAVBAR -->
       <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
                <nav class="navbar navbar-expand navbar-dark bgg-dark topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                <span class="material-icons">search</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php
                                if(isset($_SESSION['email'])) {
                                    // Si el email está definido en la sesión, lo puedes usar en esta página
                                    $email = $_SESSION['email'];
                                    echo "<span>$email</span>";
                                } else {
                                    echo "<span>No se ha proporcionado un email</span>";
                                }
                                ?> </span>
                                <span class="material-icons">account_circle</span>
                            </a>
                        </li>
                    </ul>
                </nav>


