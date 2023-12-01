<?php
  $conexion = pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
  if(isset($_POST)){
    if (strlen($_POST['nombre_proveedor']) >= 1 && strlen($_POST['cod_proveedor']) >= 1 
    && strlen($_POST['telefono']) >= 1 && strlen($_POST['email_proveedor']) >= 1 && strlen($_POST['ubicacion']) >= 1) {
        $nombre_proveedor = trim($_POST['nombre_proveedor']);
        $cod_proveedor = trim($_POST['cod_proveedor']);
        $telefono = trim($_POST['telefono']);
        $email_proveedor= trim($_POST['email_proveedor']);
        $ubicacion= trim($_POST['ubicacion']);
  
  
    $consulta = "INSERT INTO proveedor (nombre_proveedor, cod_proveedor, telefono, email_proveedor, ubicacion)
    VALUES ('$nombre_proveedor', '$cod_proveedor', '$telefono', '$email_proveedor', '$ubicacion')";
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