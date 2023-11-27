<?php
session_start(); // Iniciar la sesión

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
        // Obtener los datos del usuario
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Guardar los datos en variables de sesión
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rut'] = $usuario['rut'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['telefono'] = $usuario['telefono'];
        $_SESSION['fecha_nacimiento'] = $usuario['fecha_nacimiento'];

        // Redirigir a MiPerfil.php
        header("Location: indexIniciado.php");
        exit;
    } else {
        echo '
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
