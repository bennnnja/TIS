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
    <title>Pedidos</title>
</head>
<br>
<div class="container is-fluid">




<main class="main">
    <article>
        <section class="form-edit">
            <h4>Buscar Pedidos</h4>
                <h5>Ingrese algun dato para buscar el pedidos</h5>
                <form class="d-flex">
			<form action="" method="GET">
			<input class="controls" type="search" placeholder="Buscar pedido" 
			name="busqueda"> <br>
			<button class="button" type="submit" name="enviar"> <b>Buscar</b> </button> 
			</form>
            <br>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create">
				<span class="glyphicon glyphicon-plus"></span> Nuevo Pedido   <i class="fa fa-plus"></i> </a></button>
            <br>
            <?php
            $conexion=pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
            $where="";

            if(isset($_GET['enviar'])){
            $busqueda = $_GET['busqueda'];


                if (isset($_GET['busqueda']))
                {
                    $where="WHERE CAST(monto AS TEXT) LIKE'%".$busqueda."%' OR tipo_pago  LIKE'%".$busqueda."%' OR CAST(cliente_cod_cliente AS TEXT)  LIKE'%".$busqueda."%' OR CAST(fecha_pedido AS TEXT)  LIKE'%".$busqueda."%' OR cod_pedido  LIKE'%".$busqueda."%' OR cliente_cod_cliente  LIKE'%".$busqueda."%'";
                }
            
            }
            ?>
            <br>
            <div class="table-container">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Código pedido</th>
                            <th>Monto</th>
                            <th>Tipo Pago</th>
                            <th>Fecha Pedido</th>
                            <th>Email</th>
                            <th>Cod cliente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

            $conexion=pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");            
            $encuentro="SELECT cod_pedido, monto, tipo_pago, fecha_pedido, cliente_cod_cliente FROM pedido $where";
            $dato=pg_query($conexion,$encuentro);

            if(pg_num_rows($dato) >0){
                while($fila=pg_fetch_object($dato)){
                
            ?>
            <tr>
                        <td><?php echo $fila->cod_pedido; ?></td>
                        <td><?php echo $fila->monto; ?></td>
                        <td><?php echo $fila->tipo_pago; ?></td>
                        <td><?php echo $fila->fecha_pedido; ?></td>
                        <td><?php echo $fila->cliente_cod_cliente; ?></td>



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


    <?php include('InsertarPedido.php'); ?>

</html>