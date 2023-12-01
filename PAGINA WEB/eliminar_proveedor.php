<?php
if(isset($_GET['codigo_proveedor'])) {
    $codigo_proveedor = $_GET['codigo_proveedor'];
    
    $conexion = pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
    $consulta = pg_query($conexion, "DELETE FROM proveedor WHERE cod_proveedor ='$codigo_proveedor'");
    
    if ($consulta) {
        header('Location: CRUDProveedor.php');
        exit();
    } else {
        echo "Error al eliminar el proveedor.";
    }
} else {
    echo "No se proporcionó un código de proveedor válido.";
}
?>
