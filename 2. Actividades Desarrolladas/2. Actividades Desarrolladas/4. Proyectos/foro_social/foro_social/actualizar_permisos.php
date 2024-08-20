<?php
// Iniciar sesión
session_start();

// Verificar si el usuario actual es administrador
if (!isset($_SESSION["role"]) || $_SESSION["role"] != 1) {
    // Redirigir al login si no es administrador
    header("Location: login.php");
    exit;
}

// Incluir el archivo de conexión a la base de datos
include 'includes/conexion.php';

// Verificar si los parámetros necesarios están presentes
if (!isset($_GET['id']) || !isset($_GET['accion'])) {
    die("Parámetros faltantes.");
}

$id_usuario = intval($_GET['id']);
$accion = $_GET['accion'];

// Determinar la nueva acción
if ($accion == 'dar_admin') {
    $nuevo_estado = 1; // Dar permisos de administrador
} elseif ($accion == 'quitar_admin') {
    $nuevo_estado = 0; // Quitar permisos de administrador
} else {
    die("Acción no válida.");
}

// Actualizar el estado de es_administrador en la base de datos
$sql = "UPDATE usuarios SET es_administrador = ? WHERE id = ? AND id != 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $nuevo_estado, $id_usuario);
    
if ($stmt->execute()) {
    // Redirigir de vuelta al panel de administración con un mensaje de éxito
    header("Location: panel_administracion.php?mensaje=Permisos actualizados correctamente.");
    exit;
} else {
    // Manejar el error
    die("Error al actualizar permisos: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
