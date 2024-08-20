<?php
session_start();
include 'includes/db_connect.php';

// // Verificar si el usuario está autenticado
// if (!isset($_SESSION['id'])) {
//     header("Location: login.php");
//     exit();
// }

$post_id = intval($_GET['id']);

// Verificar si el usuario es el autor de la publicación o un administrador
$sql_check_permission = "SELECT p.id_usuario, u.es_administrador 
                        FROM foro_social_latina.publicaciones p 
                        INNER JOIN foro_social_latina.usuarios u ON u.id = p.id_usuario
                        WHERE p.id = ?";
$stmt_check = $conn->prepare($sql_check_permission);
$stmt_check->bind_param("i", $post_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$post = $result_check->fetch_assoc();

// Verificar permisos
if (!$post || ($post['id_usuario'] != $_SESSION['id'] && $post['es_administrador'] != 1)) {
    echo "<script>alert('No tienes permiso para eliminar esta publicación.'); window.location.href='post.php?id=$post_id';</script>";
    exit();
}

// Eliminar publicación
$sql_delete = "DELETE FROM publicaciones WHERE id = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("i", $post_id);

if ($stmt_delete->execute()) {
    echo "<script>alert('Publicación eliminada exitosamente.'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Error al eliminar la publicación.');</script>";
}

// Cerrar declaraciones y conexión
$stmt_check->close();
$stmt_delete->close();
$conn->close();
?>
