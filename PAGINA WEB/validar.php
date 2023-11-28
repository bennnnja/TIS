<?php
  $conexion = pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
  if(isset($_POST)){
    if (strlen($_POST['nombre_producto']) >= 1 && strlen($_POST['cod_producto']) >= 1 && strlen($_POST['precio']) >= 1 
    && strlen($_POST['sabor']) >= 1 && strlen($_POST['fecha_vencimiento']) >= 1 && strlen($_POST['stock']) >= 1) {
        $nombre_producto = trim($_POST['nombre_producto']);
        $cod_producto = trim($_POST['cod_producto']);
        $precio = trim($_POST['precio']);
        $sabor = trim($_POST['sabor']);
        $fecha_vencimiento= trim($_POST['fecha_vencimiento']);
        $stock= trim($_POST['stock']);
  
  
    $consulta = "INSERT INTO producto (nombre_producto, cod_producto, sabor, precio, fecha_vencimiento, stock)
    VALUES ('$nombre_producto', '$cod_producto', '$sabor', '$precio', '$fecha_vencimiento', '$stock')";
      $resultado=pg_query($conexion, $consulta);
  
      if($resultado){
  echo'Correcto';
        
      }else{
        echo 'Ocurrio un error al guardar los datos';
      }
  }else{
    echo 'No data';
  }
  }

?>