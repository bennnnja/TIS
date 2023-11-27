<?php session_start();?>
<!DOCTYPE html>
<?php require '_header.php' ?>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <title>Perfil</title>
</head>
<br>
<div class="container is-fluid">




<section class="section profile">
                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="undraw_profile.svg" alt="Profile" class="rounded-circle">
                                <?php
                                if(isset($_SESSION['nombre'])) {
                                    // Si el email está definido en la sesión, lo puedes usar en esta página
                                    $nombre = $_SESSION['nombre'];
                                    echo "<h2>$nombre</h2>";
                                } else {
                                    echo "<h2>No se ha proporcionado un email</h2>";
                                }
                                ?>
                                <div class="social-links mt-2">
                                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Perfil</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Perfil</button>
                                    </li>



                                </ul>
                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <h5 class="card-title">Detalles de Perfil</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Nombre</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $_SESSION['nombre']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">RUT</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $_SESSION['rut']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $_SESSION['email']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Telefono</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $_SESSION['telefono']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Fecha nacimiento</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $_SESSION['fecha_nacimiento']; ?></div>
                                        </div>


                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                        <!-- Profile Edit Form -->

                                        <form id="form">


                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="usuario" type="text" data-id="<?php echo $fila['id']; ?>" class="form-control" id="usuario" value="<?php echo $fila['usuario']; ?>">
                                                </div>
                                            </div>


                                            <div class="row mb-3">
                                                <label for="company" class="col-md-4 col-lg-3 col-form-label">Correo</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="correo" type="text" class="form-control" id="correo" value="<?php echo $fila['correo']; ?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Job" class="col-md-4 col-lg-3 col-form-label">Tipó de Usuario</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="rol" type="text" class="form-control" id="rol" readonly value="<?php echo $fila['rol']; ?>">
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" id="submitedit" class="btn btn-primary">Guardar Cambios</button>
                                            </div>
                                        </form><!-- End Profile Edit Form -->

                                    </div>


                                </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="../js/user.js"></script>
<script src="../js/acciones.js"></script>
<script src="../js/buscador.js"></script>
</html>