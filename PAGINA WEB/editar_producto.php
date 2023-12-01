<?php

$cod_producto= $_GET['cod_producto'];
$conexion= pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
$consulta= "SELECT * FROM producto WHERE cod_producto = '$cod_producto'";
$resultado = pg_query($conexion, $consulta);
$usuario = pg_fetch_assoc($resultado);

?>


<!DOCTYPE html>
<?php require '_header.php' ?>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>


    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/es.css">
</head>

<body id="page-top">


<form  action="funciones.php" method="POST">
<div id="login" >
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                            <h3 class="text-center">Editar usuario</h3>
                            <div class="form-group">
                            <label for="nombre_producto" class="form-label">Nombre Producto</label>
                            <input type="text"  id="nombre_producto" name="nombre_producto" class="form-control" value="<?php echo $usuario['nombre_producto'];?>"required>
                            </div>
                            <div class="form-group">
                                <label for="cod_producto" class="form-label">Codigo Producto</label>
                                <input type="text" id="cod_producto" name="cod_producto" class="form-control" value="<?php echo $usuario['cod_producto']; ?>" required>
                            </div>
                            <div class="form-group">
                            <label for="precio" class="form-label">Precio</label>
                                <input type="number" id="precio" name="precio" class="form-control" value="<?php echo $usuario['precio']; ?>" required>
                             
                            </div>
                            <div class="form-group">
                                <label for="sabor" class="form-label">Sabor</label>
                                <input type="text" id="sabor" name="sabor" class="form-control" value="<?php echo $usuario['sabor']; ?>" required>
                             
                            </div>
                            <div class="form-group">
                                <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
                                <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" value="<?php echo $usuario['fecha_vencimiento']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" id="stock" name="stock" class="form-control" value="<?php echo $usuario['stock']; ?>" required>
                            </div>
                                  <input type="hidden" name="accion" value="editar_registro_producto">
                                <input type="hidden" name="id" value="<?php echo $cod_producto;?>">
                        
                           <br>

                                <div class="mb-3">
                                    
                                <button type="submit" class="btn btn-success" >Editar</button>
                               <a href="CRUDProductos.php" class="btn btn-danger">Cancelar</a>
                               
                            </div>
                            </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>