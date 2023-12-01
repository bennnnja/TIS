<?php
$host = 'magallanes.inf.unap.cl'; // Normalmente es localhost
$port = '5432'; // Por defecto es 5432
$dbname = 'brojas';
$user = 'brojas';
$password = 'Gt95x5cDq1';

try {
    // Crear la conexión
    $conn = new PDO("pgsql:host=$host;dbname=$dbname;user=$user;password=$password");

    // Establecer el modo de error para PDO a excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Otras configuraciones de conexión si es necesario

} catch (PDOException $e) {
    // Manejar errores de conexión
    die("Error de conexión: " . $e->getMessage());
}
?>
