<?php session_start();?>
<!DOCTYPE html>
<?php require '_header.php' ?>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="estiouser.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <title>Oferta</title>
</head>
<br>
<div class="container is-fluid">




<main class="main">
    <article>
        <section class="form-edit">
            <h4>Buscar Oferta</h4>
                <h5>Ingrese algun dato para buscar la Oferta</h5>
                <form class="d-flex">
			<form action="" method="GET">
			<input class="controls" type="search" placeholder="Buscar Oferta" 
			name="busqueda"> <br>
			<button class="button" type="submit" name="enviar"> <b>Buscar </b> </button> 
			</form>
            <br>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create">
				<span class="glyphicon glyphicon-plus"></span> Nuevo Oferta   <i class="fa fa-plus"></i> </a></button>
                <a href="fpdf/PdfOferta.php" class="btn btn-success"><i class="fas fa-file-pdf"></i>Generar Reportes</a>
            <br>
            <?php
            $conexion=pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
            $where="";

            if(isset($_GET['enviar'])){
            $busqueda = $_GET['busqueda'];


                if (isset($_GET['busqueda']))
                {
                    $where="WHERE CAST(cod_oferta AS TEXT) LIKE'%".$busqueda."%' OR descripcion  LIKE'%".$busqueda."%' OR CAST(descuento AS TEXT)  LIKE'%".$busqueda."%' OR CAST(tiempo_inicio AS TEXT)  LIKE'%".$busqueda."%' OR CAST(tiempo_fin AS TEXT)  LIKE'%".$busqueda."%' OR CAST(empleado_cod_empleado AS TEXT)  LIKE'%".$busqueda."%'";
                }
            
            }
            ?>
            <br>
            <div class="table-container">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Código Oferta</th>
                            <th>Descripcion</th>
                            <th>Descuento</th>
                            <th>Tiempo Inicio</th>
                            <th>Tiempo Fin</th>
                            <th>Cod Empleado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

            $conexion=pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");            
            $encuentro="SELECT cod_oferta, descripcion, descuento, tiempo_inicio, tiempo_fin, empleado_cod_empleado FROM oferta $where";
            $dato=pg_query($conexion,$encuentro);

            if(pg_num_rows($dato) >0){
                while($fila=pg_fetch_object($dato)){
                
            ?>
            <tr>
                        <td><?php echo $fila->cod_oferta; ?></td>
                        <td><?php echo $fila->descripcion; ?></td>
                        <td><?php echo $fila->descuento; ?></td>
                        <td><?php echo $fila->tiempo_inicio; ?></td>
                        <td><?php echo $fila->tiempo_fin; ?></td>
                        <td><?php echo $fila->empleado_cod_empleado; ?></td>



                        <td>
                                <a href="#" class="btn btn-warning">Editar</a>
                                <a href="#" class="btn btn-danger">Eliminar</a>
                            </td>
            </tr>


            <?php
            }
            }else{

                ?>
                <tr class="text-center">
                <td colspan="16">No existen registros</td>
                </tr>

                
                <?php
                
            }
            ?>
                </tbody>
                </table>
            </div>
        </section>
    </article>
</main>
	</body>
  </table>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>
<script src="../package/jquery-3.6.0.min.js"></script>


    <?php include('InsertarOferta.php'); ?>


</html>