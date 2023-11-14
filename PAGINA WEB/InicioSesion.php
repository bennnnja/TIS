<?php

$host = 'magallanes.inf.unap.cl'; // Normalmente es localhost
$port = '5432'; // Por defecto es 5432
$dbname = 'brojas';
$user = 'brojas';
$password = 'Gt95x5cDq1';

// Obtener los valores enviados por el formulario
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

// Establecer conexión
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
    $conexion = new PDO($dsn);

    // Consulta para verificar las credenciales de inicio de sesión
    $sql = "SELECT * FROM persona WHERE email = :email AND contrasena = :contrasena";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->execute();

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if ($stmt->rowCount() > 0) {
        echo'
            <script>
                alert("Bienvenido a Gelateria Milano");
                window.location = "index.html";
            </script>
        ';
    } else {
        echo'
            <script>
                alert("Usuario no existe, por favor verifique los datos introducidos");
                window.location = "LoginRegistro.html";
            </script>
        ';
    }
} catch (PDOException $e) {
    echo "Error al conectarse a la base de datos: " . $e->getMessage();
}
?>