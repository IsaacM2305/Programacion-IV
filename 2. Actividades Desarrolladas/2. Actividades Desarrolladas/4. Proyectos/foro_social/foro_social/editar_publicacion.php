<?php
session_start();
include 'includes/db_connect.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$post_id = intval($_GET['id']);

// Verificar si el usuario es el autor de la publicación o un administrador
$sql_check_permission = "SELECT id_usuario FROM publicaciones WHERE id = ?";
$stmt_check = $conn->prepare($sql_check_permission);
$stmt_check->bind_param("i", $post_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$post = $result_check->fetch_assoc();

if (!$post || ($post['id_usuario'] != $_SESSION['user_id'] && !$_SESSION['is_admin'])) {
    echo "<script>alert('No tienes permiso para editar esta publicación.'); window.location.href='post.php?id=$post_id';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (empty($title) || empty($content)) {
        echo "<script>alert('El título y el contenido no pueden estar vacíos.'); window.location.href='editar_publicacion.php?id=$post_id';</script>";
        exit();
    }

    $sql = "UPDATE publicaciones SET titulo = ?, contenido = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $content, $post_id);

    if ($stmt->execute()) {
        echo "<script>alert('Publicación actualizada exitosamente.'); window.location.href='post.php?id=$post_id';</script>";
    } else {
        echo "<script>alert('Error al actualizar la publicación.');</script>";
    }
    $stmt->close();
}

// Obtener los datos de la publicación para el formulario de edición
$sql = "SELECT titulo, contenido FROM publicaciones WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Publicación</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Publicación</h1>
    <form action="editar_publicacion.php?id=<?= $post_id ?>" method="POST">
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($post['titulo']) ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea class="form-control" id="content" name="content" rows="5" required><?= htmlspecialchars($post['contenido']) ?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Actualizar Publicación</button>
            <a href="post.php?id=<?= $post_id ?>" class="btn btn-secondary ml-2">Cancelar</a>
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







