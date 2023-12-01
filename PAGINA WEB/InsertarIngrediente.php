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
                    <h3 class="modal-title" id="exampleModalLabel">Registro de Ingrediente</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
<form  action="" method="POST">

                            <div class="form-group">
                            <label for="nombre_ingrediente" class="form-label">Nombre Ingrediente:</label>
                            <input type="text"  id="nombre_ingrediente" name="nombre_ingrediente" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cod_ingrediente">Codigo Ingrediente:</label><br>
                                <input type="number" name="cod_ingrediente" id="cod_ingrediente" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="detalle">Detalle:</label><br>
                                <input type="text" name="detalle" id="detalle" class="form-control" placeholder="">
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
                               <a href="CRUDIngrediente.php" class="btn btn-danger">Cancelar</a>
                               
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


			var nombre_ingrediente = $('#nombre_ingrediente').val();
			var cod_ingrediente = $('#cod_ingrediente').val();
			var detalle 	= $('#detalle').val();
			var fecha_vencimiento	= $('#fecha_vencimiento').val();
            var stock	= $('#stock').val();
			

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: 'validarIngrediente.php',
					data: {nombre_ingrediente: nombre_ingrediente,cod_ingrediente: cod_ingrediente, detalle: detalle, fecha_vencimiento: fecha_vencimiento, stock: stock},
					success: function(data){
					Swal.fire({
								'title': '¡Mensaje!',
								'text': data,
                                'icon': 'success',
                                'showConfirmButton': 'false',
                                'timer': '1500'
								}).then(function() {
                window.location = "CRUDIngrediente.php";
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