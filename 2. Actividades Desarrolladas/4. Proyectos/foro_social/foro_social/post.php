<?php
session_start();
include 'includes/db_connect.php';
include 'includes/header.php';

$post_id = intval($_GET['id']);

// Obtener los detalles de la publicación
$sql = "SELECT 
            p.titulo AS title, 
            p.contenido AS content, 
            u.nombre_usuario AS username, 
            p.creado_en AS created_at, 
            p.id_usuario 
        FROM foro_social_latina.publicaciones p
        INNER JOIN foro_social_latina.usuarios u ON p.id_usuario = u.id 
        WHERE p.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    echo "<script>alert('Publicación no encontrada.'); window.location.href='index.php';</script>";
    exit();
}

// Obtener los comentarios de la publicación
$sql_comments = "SELECT 
                    c.id, c.contenido AS content, 
                    u.nombre_usuario AS username, 
                    c.creado_en AS created_at, 
                    c.id_usuario 
                FROM foro_social_latina.comentarios c
                INNER JOIN foro_social_latina.usuarios u ON c.id_usuario = u.id
                WHERE c.id_publicacion = ?
                ORDER BY c.creado_en DESC";
$stmt_comments = $conn->prepare($sql_comments);
$stmt_comments->bind_param("i", $post_id);
$stmt_comments->execute();
$comments = $stmt_comments->get_result();
?>

<div class="container mt-5">
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <p class="text-muted">Por <?= htmlspecialchars($post['username']) ?> el <?= htmlspecialchars($post['created_at']) ?></p>
    <p><?= htmlspecialchars($post['content']) ?></p>

    <!-- Mostrar los botones de edición y eliminación si el usuario es el autor o un administrador -->
    <?php if (isset($_SESSION['user_id']) && ($post['id_usuario'] == $_SESSION['user_id'] || $_SESSION['is_admin'])): ?>
        <a href="editar_publicacion.php?id=<?= $post_id ?>" class="btn btn-warning">Editar Publicación</a>
        <a href="eliminar_publicacion.php?id=<?= $post_id ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta publicación?')">Eliminar Publicación</a>
    <?php endif; ?>

    <!-- Mostrar los comentarios -->
    <h3>Comentarios</h3>
    <?php if ($comments->num_rows > 0): ?>
        <?php while ($comment = $comments->fetch_assoc()): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text"><?= htmlspecialchars($comment['content']) ?></p>
                    <p class="text-muted">Por <?= htmlspecialchars($comment['username']) ?> el <?= htmlspecialchars($comment['created_at']) ?></p>

                    <!-- Mostrar los botones de edición y eliminación si el usuario es el autor o un administrador -->
                    <?php if (isset($_SESSION['user_id']) && ($comment['id_usuario'] == $_SESSION['user_id'] || $_SESSION['is_admin'])): ?>
                        <a href="editar_comentario.php?id=<?= $comment['id'] ?>&post_id=<?= $post_id ?>" class="btn btn-warning btn-sm">Editar Comentario</a>
                        <a href="eliminar_comentario.php?id=<?= $comment['id'] ?>&post_id=<?= $post_id ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este comentario?')">Eliminar Comentario</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay comentarios aún.</p>
    <?php endif; ?>

    <!-- Formulario para agregar un comentario -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <h4>Agregar un comentario</h4>
        <form action="agregar_comentario.php" method="POST">
            <div class="form-group">
                <textarea class="form-control" name="content" rows="3" required placeholder="Escribe tu comentario aquí..."></textarea>
            </div>
            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post_id) ?>">
            <button type="submit" class="btn btn-primary">Agregar Comentario</button>
        </form>
    <?php else: ?>
        <p><a href="login.php">Inicia sesión</a> para agregar un comentario.</p>
    <?php endif; ?>
</div>

<?php
include 'includes/footer.php';
$stmt->close();
$stmt_comments->close();
$conn->close();
?>











