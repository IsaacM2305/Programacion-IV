<?php
session_start();
include 'includes/db_connect.php';

// Verificar si el usuario es administrador
if (!isset($_SESSION['user_id']) || !isset($_SESSION['es_administrador']) || !$_SESSION['es_administrador']) {
    echo "<script>alert('No tienes permiso para realizar esta acción.'); window.location.href='index.php';</script>";
    exit();
}

// Obtener el ID del comentario y la acción de la URL
if (isset($_GET['id']) && isset($_GET['accion'])) {
    $comment_id = intval($_GET['id']);
    $accion = $_GET['accion'];

    // Validar la acción
    if ($accion != 'aprobar' && $accion != 'rechazar') {
        echo "<script>alert('Acción no válida.'); window.location.href='comentarios.php';</script>";
        exit();
    }

    // Determinar el nuevo estado basado en la acción
    $nuevo_estado = ($accion == 'aprobar') ? 1 : 2;

    // Actualizar el estado del comentario
    $sql = "UPDATE comentarios SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $nuevo_estado, $comment_id);

    if ($stmt->execute()) {
        $mensaje = ($accion == 'aprobar') ? 'Comentario aprobado con éxito.' : 'Comentario rechazado con éxito.';
        header("Location: comentarios.php?mensaje=" . urlencode($mensaje));
    } else {
        echo "<script>alert('Error al actualizar el comentario.'); window.location.href='comentarios.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Datos insuficientes.'); window.location.href='comentarios.php';</script>";
}

$conn->close();
?>
