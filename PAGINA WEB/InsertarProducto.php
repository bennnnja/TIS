<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>

	<link rel="stylesheet" href="./css/es.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./package/dist/sweetalert2.css">
</head>

<body id="page-top">

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Registro de Producto</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                            <form  action="" method="POST">

                            <div class="form-group">
                            <label for="nombre_producto" class="form-label">Nombre Producto:</label>
                            <input type="text"  id="nombre_producto" name="nombre_producto" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cod_producto">Codigo Producto:</label><br>
                                <input type="text" name="cod_producto" id="cod_producto" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                  <label for="precio" class="form-label">Precio:</label>
                                <input type="number"  id="precio" name="precio" class="form-control" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="sabor">Sabor:</label><br>
                                <input type="text" name="sabor" id="sabor" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                  <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento:</label>
                                <input type="date"  id="fecha_vencimiento" name="fecha_vencimiento" class="form-control">
                             
                            </div>

                            <div class="form-group">
                                  <label for="stock" class="form-label">Stock:</label>
                                <input type="number"  id="stock" name="stock" class="form-control">
                             
                            </div>
                      
                        
       
                                <div class="mb-3">
                                    
                               <input type="submit" value="Guardar" id="register" class="btn btn-success" 
                               name="registrar">
                               <a href="CRUDProductos.php" class="btn btn-danger">Cancelar</a>
                               
                            </div>
                        

                        </form>

<script src="./package/dist/sweetalert2.all.js"></script>
<script src="./package/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$(function(){
		$('#register').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){


			var nombre_producto = $('#nombre_producto').val();
			var cod_producto = $('#cod_producto').val();
			var precio = $('#precio').val();
			var sabor 	= $('#sabor').val();
			var fecha_vencimiento	= $('#fecha_vencimiento').val();
            var stock	= $('#stock').val();
			

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: 'validarProducto.php',
					data: {nombre_producto: nombre_producto,cod_producto: cod_producto, precio: precio,sabor: sabor, fecha_vencimiento: fecha_vencimiento, stock: stock},
					success: function(data){
					Swal.fire({
								'title': '¡Mensaje!',
								'text': data,
                                'icon': 'success',
                                'showConfirmButton': 'false',
                                'timer': '1500'
								}).then(function() {
                window.location = "CRUDProductos.php";
            });
							
					} ,
                    
					error: function(data){
						Swal.fire({
								'title': 'Error',
								'text': data,
								'icon': 'error'
								})
					}
				});

				
			}else{
				
			}

			



		});		

		
	});
    
	
</script>
</body>
</html>