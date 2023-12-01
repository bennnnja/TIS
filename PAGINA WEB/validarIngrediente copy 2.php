<?php
  $conexion = pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
  if(isset($_POST)){
    if (strlen($_POST['nombre_ingrediente']) >= 1 && strlen($_POST['cod_ingrediente']) >= 1 
    && strlen($_POST['detalle']) >= 1 && strlen($_POST['fecha_vencimiento']) >= 1 && strlen($_POST['stock']) >= 1) {
        $nombre_ingrediente = trim($_POST['nombre_ingrediente']);
        $cod_ingrediente = trim($_POST['cod_ingrediente']);
        $detalle = trim($_POST['detalle']);
        $fecha_vencimiento= trim($_POST['fecha_vencimiento']);
        $stock= trim($_POST['stock']);
  
  
    $consulta = "INSERT INTO ingrediente (nombre_ingrediente, cod_ingrediente, detalle, fecha_vencimiento, stock)
    VALUES ('$nombre_ingrediente', '$cod_ingrediente', '$detalle', '$fecha_vencimiento', '$stock')";
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