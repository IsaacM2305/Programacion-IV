<?php
session_start();
include 'includes/db_connect.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $comment_id = intval($_GET['id']);
    $post_id = intval($_GET['post_id']);

    // Verificar si el usuario es el propietario del comentario o un administrador
    $sql_check_permission = "SELECT id_usuario FROM comentarios WHERE id = ?";
    $stmt_check = $conn->prepare($sql_check_permission);
    $stmt_check->bind_param("i", $comment_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $comment = $result_check->fetch_assoc();

    if ($comment['id_usuario'] != $_SESSION['user_id'] && $_SESSION['role'] != 1) {
        echo "<script>alert('No tienes permiso para eliminar este comentario.'); window.location.href='post.php?id=$post_id';</script>";
        exit();
    }

    $sql = "DELETE FROM comentarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);

    if ($stmt->execute()) {
        echo "<script>alert('Comentario eliminado exitosamente.'); window.location.href='post.php?id=$post_id';</script>";
    } else {
        echo "<script>alert('Error al eliminar el comentario.'); window.location.href='post.php?id=$post_id';</script>";
    }
    $stmt->close();
}

$conn->close();
?>


