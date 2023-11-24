<?php

$host = 'magallanes.inf.unap.cl'; // Normalmente es localhost
$port = '5432'; // Por defecto es 5432
$dbname = 'brojas';
$user = 'brojas';
$password = 'Gt95x5cDq1';

// Obtener los valores enviados por el formulario
$rut = $_POST['rut'];
$contrasena = $_POST['contrasena'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];

// Establecer conexión
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
    $conexion = new PDO($dsn);

    // Preparar consulta de inserción en la tabla persona
    $sqlInsertPersona = "INSERT INTO persona (rut, nombre, email, contrasena, fecha_nacimiento, telefono) VALUES (:rut, :nombre, :email, :contrasena, :fecha_nacimiento, :telefono)";
    $stmtInsertPersona = $conexion->prepare($sqlInsertPersona);
    $stmtInsertPersona->bindParam(':rut', $rut);
    $stmtInsertPersona->bindParam(':nombre', $nombre);
    $stmtInsertPersona->bindParam(':telefono', $telefono);
    $stmtInsertPersona->bindParam(':email', $email);
    $stmtInsertPersona->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmtInsertPersona->bindParam(':contrasena', $contrasena);
    $stmtInsertPersona->execute();

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    header('Location: index.html');
    exit();
} catch (PDOException $e) {
    echo "Error al conectarse a la base de datos: " . $e->getMessage();
}
?>
