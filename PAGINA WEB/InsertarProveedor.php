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
                    <h3 class="modal-title" id="exampleModalLabel">Registro de Proveedor</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
<form  action="" method="POST">

                            <div class="form-group">
                            <label for="nombre_proveedor" class="form-label">Nombre Proveedor:</label>
                            <input type="text"  id="nombre_proveedor" name="nombre_proveedor" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cod_proveedor">Codigo Proveedor:</label><br>
                                <input type="number" name="cod_proveedor" id="cod_proveedor" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                  <label for="telefono" class="form-label">Telefono:</label>
                                <input type="number"  id="telefono" name="telefono" class="form-control" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="email_proveedor">Correo:</label><br>
                                <input type="email" name="email_proveedor" id="email_proveedor" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                  <label for="ubicacion" class="form-label">Ubicacion:</label>
                                <input type="text"  id="ubicacion" name="ubicacion" class="form-control">
                             
                            </div>
                      
                        
       
                                <div class="mb-3">
                                    
                               <input type="submit" value="Guardar" id="register" class="btn btn-success" 
                               name="registrar">
                               <a href="CRUDProveedor.php" class="btn btn-danger">Cancelar</a>
                               
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


			var nombre_proveedor = $('#nombre_proveedor').val();
			var cod_proveedor = $('#cod_proveedor').val();
			var telefono = $('#telefono').val();
			var email_proveedor 	= $('#email_proveedor').val();
			var ubicacion	= $('#ubicacion').val();
			

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: 'validarProveedor.php',
					data: {nombre_proveedor: nombre_proveedor,cod_proveedor: cod_proveedor, telefono: telefono,email_proveedor: email_proveedor, ubicacion: ubicacion},
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