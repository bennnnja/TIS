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
    <title>Ingrediente</title>
</head>
<br>
<div class="container is-fluid">




<main class="main">
    <article>
        <section class="form-edit">
            <h4>Buscar Ingrediente</h4>
                <h5>Ingrese algun dato para buscar el Ingrediente</h5>
                <form class="d-flex">
			<form action="" method="GET">
			<input class="controls" type="search" placeholder="Buscar Ingrediente" 
			name="busqueda"> <br>
			<button class="button" type="submit" name="enviar"> <b>Buscar </b> </button> 
			</form>
            <br>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create">
				<span class="glyphicon glyphicon-plus"></span> Nuevo Ingrediente   <i class="fa fa-plus"></i> </a></button>
            <br>
            <?php
            $conexion=pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");
            $where="";

            if(isset($_GET['enviar'])){
            $busqueda = $_GET['busqueda'];


                if (isset($_GET['busqueda']))
                {
                    $where="WHERE CAST(cod_ingrediente AS TEXT) LIKE'%".$busqueda."%' OR CAST(fecha_vencimiento AS TEXT)  LIKE'%".$busqueda."%' OR nombre_ingrediente  LIKE'%".$busqueda."%' OR detalle  LIKE'%".$busqueda."%' OR CAST(stock AS TEXT)  LIKE'%".$busqueda."%'";
                }
            
            }
            ?>
            <br>
            <div class="table-container">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Nombre Ingrediente</th>
                            <th>Código Ingrediente</th>
                            <th>Fecha Vencimiento</th>
                            <th>Detalle</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

            $conexion=pg_connect("host=magallanes.inf.unap.cl dbname=brojas user=brojas password=Gt95x5cDq1");            
            $encuentro=pg_query($conexion,"SELECT nombre_ingrediente, cod_ingrediente, detalle, fecha_vencimiento, stock FROM Ingrediente $where");
            while($fila=pg_fetch_assoc($encuentro)):   
               
            ?>
            <tr>
                        
                <td><?php echo $fila['nombre_ingrediente'] ?></td>
                <td><?php echo $fila['cod_ingrediente'] ?></td>
                <td><?php echo $fila['fecha_vencimiento'] ?></td>
                <td><?php echo $fila['detalle'] ?></td>
                <td><?php echo $fila['stock'] ?></td>



            <td>

                <a class="btn btn-warning" href="editar_ingrediente.php?id=<?php echo $fila['cod_ingrediente']?> ">
                <i class="fa fa-edit"></i> </a>
                </button>

                <a class="btn btn-danger btn-del" href="eliminar_ingrediente.php?codigo_ingrediente=<?php echo $fila['cod_ingrediente']; ?>">
                <i class="fa fa-trash"></i> Eliminar </a>
            </td>
            </tr>


            <?php endwhile;?>
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

<script>
$('.btn-del').on('click', function(e){
  e.preventDefault();
  const href = $(this).attr('href')

  Swal.fire({
  title: 'Estas seguro de eliminar este ingrediente?',
  text: "¡No podrás revertir esto!!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, eliminar!', 
  cancelButtonText: 'Cancelar!', 
}).then((result)=>{
    if(result.value){
        if (result.isConfirmed) {
    Swal.fire(
      'Eliminado!',
      'El usuario fue eliminado.',
      'success'
    )
  }

        document.location.href= href;
    }   

})
})
</script>
<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>
<script src="../package/jquery-3.6.0.min.js"></script>


    <?php include('InsertarIngrediente.php'); ?>


</html>