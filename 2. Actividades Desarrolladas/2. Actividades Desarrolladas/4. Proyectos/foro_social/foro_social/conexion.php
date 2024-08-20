<?php
// conexion.php
$host = "localhost"; // o el nombre del host
$usuario = "root"; // tu nombre de usuario
$password = ""; // tu contraseña
$base_de_datos = "foro_social_latina"; // nombre de la base de datos correcto

// Crear conexión
$conn = new mysqli($host, $usuario, $password, $base_de_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Configurar la conexión para manejar correctamente los caracteres UTF-8
$conn->set_charset("utf8mb4");
?>
