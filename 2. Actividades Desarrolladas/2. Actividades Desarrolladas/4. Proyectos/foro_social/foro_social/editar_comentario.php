<?php
session_start();
include 'includes/db_connect.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$comment_id = intval($_GET['id']);
$post_id = intval($_GET['post_id']);

// Verificar si el comentario pertenece al usuario o si el usuario es administrador
$sql_check_permission = "SELECT id_usuario FROM comentarios WHERE id = ?";
$stmt_check = $conn->prepare($sql_check_permission);
$stmt_check->bind_param("i", $comment_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$comment = $result_check->fetch_assoc();

if ($comment['id_usuario'] != $_SESSION['user_id'] && !$_SESSION['is_admin']) {
    echo "<script>alert('No tienes permiso para editar este comentario.'); window.location.href='post.php?id=$post_id';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = trim($_POST['content']);

    if (empty($content)) {
        echo "<script>alert('El contenido no puede estar vacío.'); window.location.href='editar_comentario.php?id=$comment_id&post_id=$post_id';</script>";
        exit();
    }

    $sql = "UPDATE comentarios SET contenido = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $content, $comment_id);

    if ($stmt->execute()) {
        echo "<script>alert('Comentario actualizado exitosamente.'); window.location.href='post.php?id=$post_id';</script>";
    } else {
        echo "<script>alert('Error al actualizar el comentario.');</script>";
    }
    $stmt->close();
}

$sql = "SELECT contenido FROM comentarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $comment_id);
$stmt->execute();
$result = $stmt->get_result();
$comment = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Comentario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Comentario</h1>
    <form action="editar_comentario.php?id=<?= $comment_id ?>&post_id=<?= $post_id ?>" method="POST">
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea class="form-control" id="content" name="content" rows="5" required><?= htmlspecialchars($comment['contenido']) ?></textarea>
        </div>
        <div class="d-flex justify-content-start">
            <button type="submit" class="btn btn-primary mr-2">Actualizar Comentario</button>
            <a href="post.php?id=<?= $post_id ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>






