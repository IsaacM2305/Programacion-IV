<?php
session_start();
include 'includes/db_connect.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar y sanitizar entradas
    $post_id = intval($_POST['post_id']);
    $user_id = intval($_SESSION['user_id']);
    $content = trim($_POST['content']);

    if (empty($content)) {
        echo "<script>alert('El comentario no puede estar vacío.'); window.location.href='post.php?id=$post_id';</script>";
        exit();
    }

    // Preparar y ejecutar la consulta para insertar el comentario
    $sql = "INSERT INTO comentarios (id_publicacion, id_usuario, contenido, creado_en) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "<script>alert('Error en la preparación de la consulta: " . htmlspecialchars($conn->error) . "'); window.location.href='post.php?id=$post_id';</script>";
        exit();
    }
    $stmt->bind_param("iis", $post_id, $user_id, $content);

    if ($stmt->execute()) {
        echo "<script>alert('Comentario agregado exitosamente.'); window.location.href='post.php?id=$post_id';</script>";
    } else {
        echo "<script>alert('Error al agregar el comentario: " . htmlspecialchars($stmt->error) . "'); window.location.href='post.php?id=$post_id';</script>";
    }
    
    $stmt->close();
}
$conn->close();
?>

