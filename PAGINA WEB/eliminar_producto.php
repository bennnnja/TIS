<?php
if(isset($_GET['codigo_producto'])) {
    $codigo_producto = $_GET['codigo_producto'];
    
    $conexion = pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
    $consulta = pg_query($conexion, "DELETE FROM producto WHERE cod_producto ='$codigo_producto'");
    
    if ($consulta) {
        header('Location: CRUDProductos.php');
        exit();
    } else {
        echo "Error al eliminar el producto.";
    }
} else {
    echo "No se proporcionó un código de producto válido.";
}
?>
