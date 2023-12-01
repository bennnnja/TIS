<?php

function editar_registro_producto()
{
    $conexion = pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");

    // Obtener los valores del formulario
    $nombre_producto = $_POST['nombre_producto'];
    $sabor = $_POST['sabor'];
    $precio = $_POST['precio'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $cod_producto = $_POST['cod_producto'];
    $stock = $_POST['stock'];

    $consulta = "UPDATE producto SET cod_producto='$cod_producto', nombre_producto='$nombre_producto', sabor='$sabor', precio='$precio', fecha_vencimiento='$fecha_vencimiento' , stock='$stock'WHERE cod_producto='$cod_producto'";

    $resultado = pg_query($conexion, $consulta);

    if ($resultado) {
        // La consulta se ejecutó correctamente
        header('Location: CRUDProductos.php');
    } else {
        // Error en la consulta
        echo "Error al actualizar los datos: " . pg_last_error($conexion);
    }
}


if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        //casos de registros

        case 'editar_registro_producto':
            editar_registro_producto();
            break; 
    }
}