<?php

$cod_producto= $_POST['cod_producto'];
$conexion=pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
$consulta= "SELECT * FROM producto WHERE cod_producto = $cod_producto";
$consultasprodu=pg_query($conexion,$consulta);
$fila = pg_fetch_assoc($consultasprodu);

?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>

</head>


<div class="modal fade" id="editar<?php echo $fila['cod_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar el registro de <?php echo $fila['nombre_producto']; ?></h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

            <form  action="funciones.php" method="POST">

            <div class="form-group">
            <label for="nombre_producto" class="form-label">Nombre Producto:</label>
            <input type="text"  id="nombre_producto" name="nombre_producto" class="form-control" value="<?php echo $fila['nombre_producto']?>">
            </div>
            <div class="form-group">
                <label for="cod_producto">Codigo Producto:</label><br>
                <input type="text" name="cod_producto" id="cod_producto" class="form-control" value="<?php echo $fila['nombre_producto']?>">
            </div>
            <div class="form-group">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number"  id="precio" name="precio" class="form-control" value="<?php echo $fila['precio']?>">
                
            </div>
            <div class="form-group">
                <label for="sabor">Sabor:</label><br>
                <input type="text" name="sabor" id="sabor" class="form-control" value="<?php echo $fila['sabor']?>">
            </div>

            <div class="form-group">
                <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento:</label>
                <input type="date"  id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" value="<?php echo $fila['fecha_vencimiento']?>">
            
            </div>

            <div class="form-group">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number"  id="stock" name="stock" class="form-control" value="<?php echo $fila['stock']?>">
            
            </div>



                <div class="mb-3">
                    
                <input type="hidden" name="accion" value="editar">
                <input type="hidden" name="id" value="<?php echo $fila['cod_producto']; ?>">
                <br>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Editar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            
            </div>


            </form>
        </div>
    </div>
</div>
</div>




</html>