<?php session_start();?>
<!DOCTYPE html>
<?php require '_header.php' ?>
<html lang="en">
<?php
// Incluir el archivo de conexión
include('conexion.php');

// Continuar con el resto del código
$sql = "SELECT nombre_producto, stock FROM producto ORDER BY stock DESC LIMIT 5";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result) {
    // Crear arrays para almacenar datos
    $labels = [];
    $data = [];

    // Procesar resultados de la consulta
    foreach ($result as $row) {
        $labels[] = $row['nombre_producto'];
        $data[] = $row['stock'];
    }
} else {
    // Manejar el error si la consulta falla
    echo "Error en la consulta: " . $conn->errorInfo();
}

// Cerrar la conexión
$conn = null;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Donut con Chart.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <title>Graficos</title>
</head>
<br>
<div class="container is-fluid">

<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Pedidos Pendientes</p>
                    <h4 class="mb-0"><?php echo $data['pendientes']['total']; ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Proceso</p>
                    <h4 class="mb-0"><?php echo $data['procesos']['total']; ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Finalizados</p>
                    <h4 class="mb-0"><?php echo $data['finalizados']['total']; ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Productos</p>
                    <h4 class="mb-0"><?php echo $data['productos']['total']; ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 col-lg-4">
        <div class="card radius-10">
        <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Ventas</h6>
                        </div>
                    </div>
                </div>
            <div class="card-body">                
                <div class="chart-container-2">
                    <canvas id="reportePedidos"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Ganancias</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container-1">
                    <canvas id="chart4"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Productos más vendidos</h6>
                        <html>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container-1">
                <body>
                    
                    <canvas id="donutChart" width="100" height="100"></canvas>
                    <script>
                        // Datos para el gráfico (usando datos de PHP)
                        var data = {
                            labels: <?php echo json_encode($labels); ?>,
                            datasets: [{
                                data: <?php echo json_encode($data); ?>,
                                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                                hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
                               

                            }]
                        };

                        // Opciones del gráfico
                        var options = {
                            cutoutPercentage: 50,
                            responsive: true,
                            maintainAspectRatio: true
                        };

                        // Obtener el contexto del canvas
                        var ctx = document.getElementById('donutChart').getContext('2d');

                        // Crear el gráfico de donut
                        var myDonutChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: data,
                            options: options
                        });
                    </script>
                </body>
                </html>
                    <canvas id="topProductos"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="../js/user.js"></script>
<script src="../js/acciones.js"></script>
<script src="../js/buscador.js"></script>
</html>