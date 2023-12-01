<?php
if(isset($_GET['codigo_ingrediente'])) {
    $codigo_ingrediente = $_GET['codigo_ingrediente'];
    
    $conexion = pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
    $consulta = pg_query($conexion, "DELETE FROM ingrediente WHERE cod_ingrediente ='$codigo_ingrediente'");
    
    if ($consulta) {
        header('Location: CRUDIngrediente.php');
        exit();
    } else {
        echo "Error al eliminar el ingrediente.";
    }
} else {
    echo "No se proporcionó un código de ingrediente válido.";
}
?>
