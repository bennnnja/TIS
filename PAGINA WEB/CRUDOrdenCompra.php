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
    <title>Orden de compra</title>
</head>
<br>
<div class="container is-fluid">




<main class="main">
    <article>
        <section class="form-edit">
            <h4>Buscar Orden de compra</h4>
                <h5>Ingrese algun dato para buscar la Orden de compra</h5>
                <form class="d-flex">
			<form action="" method="GET">
			<input class="controls" type="search" placeholder="Buscar Orden" 
			name="busqueda"> <br>
			<button class="button" type="submit" name="enviar"> <b>Buscar </b> </button> 
			</form>
            <br>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create">
				<span class="glyphicon glyphicon-plus"></span> Nuevo Orden de Compra   <i class="fa fa-plus"></i> </a></button>
            <br>
            <?php
            $conexion=pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
            $where="";

            if(isset($_GET['enviar'])){
            $busqueda = $_GET['busqueda'];


                if (isset($_GET['busqueda']))
                {
                    $where="WHERE CAST(cod_orden AS TEXT) LIKE'%".$busqueda."%' OR descripcion  LIKE'%".$busqueda."%' OR CAST(monto AS TEXT)  LIKE'%".$busqueda."%' OR metodo_pago_orden  LIKE'%".$busqueda."%' OR CAST(fecha_orden AS TEXT)  LIKE'%".$busqueda."%' OR CAST(empleado_cod_empleado AS TEXT)  LIKE'%".$busqueda."%' OR proveedor_cod_proveedor  LIKE'%".$busqueda."%'";
                }
            
            }
            ?>
            <br>
            <div class="table-container">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Código Orden</th>
                            <th>Descripcion</th>
                            <th>Monto</th>
                            <th>Metodo Pago</th>
                            <th>Fecha Orden</th>
                            <th>Cod Empleado</th>
                            <th>Cod Proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

            $conexion=pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");            
            $encuentro="SELECT cod_orden, descripcion, monto, metodo_pago_orden, fecha_orden, empleado_cod_empleado, proveedor_cod_proveedor FROM orden_de_compra $where";
            $dato=pg_query($conexion,$encuentro);

            if(pg_num_rows($dato) >0){
                while($fila=pg_fetch_object($dato)){
                
            ?>
            <tr>
                        <td><?php echo $fila->cod_orden; ?></td>
                        <td><?php echo $fila->descripcion; ?></td>
                        <td><?php echo $fila->monto; ?></td>
                        <td><?php echo $fila->metodo_pago_orden; ?></td>
                        <td><?php echo $fila->fecha_orden; ?></td>
                        <td><?php echo $fila->empleado_cod_empleado; ?></td>
                        <td><?php echo $fila->proveedor_cod_proveedor; ?></td>



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


    <?php include('InsertarOrdenCompra.php'); ?>


</html>