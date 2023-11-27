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
    <title>Ingrediente</title>
</head>
<br>
<div class="container is-fluid">




<main class="main">
    <article>
        <section class="form-edit">
            <h4>Buscar Ingrediente</h4>
                <h5>Ingrese algun dato para buscar el Ingrediente</h5>
                <form class="d-flex">
			<form action="" method="GET">
			<input class="controls" type="search" placeholder="Buscar Ingrediente" 
			name="busqueda"> <br>
			<button class="button" type="submit" name="enviar"> <b>Buscar </b> </button> 
			</form>
            <?php
            $conexion=pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
            $where="";

            if(isset($_GET['enviar'])){
            $busqueda = $_GET['busqueda'];


                if (isset($_GET['busqueda']))
                {
                    $where="WHERE CAST(cod_ingrediente AS TEXT) LIKE'%".$busqueda."%' OR CAST(fecha_vencimiento AS TEXT)  LIKE'%".$busqueda."%' OR nombre_ingreiente  LIKE'%".$busqueda."%' OR detalle  LIKE'%".$busqueda."%' OR CAST(stock AS TEXT)  LIKE'%".$busqueda."%'";
                }
            
            }
            ?>
            <br>
            <div class="table-container">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Nombre Ingrediente</th>
                            <th>Código Ingrediente</th>
                            <th>Fecha Vencimiento</th>
                            <th>Detalle</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

            $conexion=pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");            
            $encuentro="SELECT nombre_ingrediente, cod_ingreiente, detalle, fecha_vencimiento, stock FROM Ingrediente $where";
            $dato=pg_query($conexion,$encuentro);

            if(pg_num_rows($dato) >0){
                while($fila=pg_fetch_object($dato)){
                
            ?>
            <tr>
                        <td><?php echo $fila->nombre_ingrediente; ?></td>
                        <td><?php echo $fila->cod_ingreiente; ?></td>
                        <td><?php echo $fila->fecha_vencimiento; ?></td>
                        <td><?php echo $fila->detalle; ?></td>
                        <td><?php echo $fila->stock; ?></td>



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
<script src="../js/user.js"></script>
<script src="../js/acciones.js"></script>
<script src="../js/buscador.js"></script>


</html>