<?php
session_start();
include 'includes/db_connect.php';
include 'includes/header.php';

// Verificar si el usuario es administrador
if (!isset($_SESSION['user_id']) || !$_SESSION['role']) { // Asegúrate de que $_SESSION['role'] sea un valor verdadero para admin
    echo "<script>alert('No tienes permiso para acceder a esta página.'); window.location.href='index.php';</script>";
    exit();
}

// Obtener todos los comentarios
$sql = "SELECT 
            c.id AS comment_id, 
            c.contenido AS content, 
            u.nombre_usuario AS username, 
            c.creado_en AS created_at, 
            c.estado AS status, 
            p.titulo AS post_title, 
            p.id AS post_id 
        FROM comentarios c
        INNER JOIN usuarios u ON c.id_usuario = u.id
        INNER JOIN publicaciones p ON c.id_publicacion = p.id
        ORDER BY c.creado_en DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$comments = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios del Foro</title>
    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Comentarios del Foro</h1>

        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['mensaje']) ?></div>
        <?php endif; ?>

        <?php if ($comments->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Contenido</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Publicación</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($comment = $comments->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($comment['comment_id']) ?></td>
                            <td><?= htmlspecialchars($comment['content']) ?></td>
                            <td><?= htmlspecialchars($comment['username']) ?></td>
                            <td><?= htmlspecialchars($comment['created_at']) ?></td>
                            <td><a href="post.php?id=<?= $comment['post_id'] ?>" target="_blank"><?= htmlspecialchars($comment['post_title']) ?></a></td>
                            <td>
                                <?= $comment['status'] == 1 ? 'Aprobado' : ($comment['status'] == 2 ? 'Rechazado' : 'Pendiente') ?>
                            </td>
                            <td>
                                <?php if ($comment['status'] == 0): ?>
                                    <a href="aprobar_rechazar_comentario.php?id=<?= $comment['comment_id'] ?>&accion=aprobar" class="btn btn-success btn-sm" onclick="return confirm('¿Estás seguro de que deseas aprobar este comentario?')">Aprobar</a>
                                    <a href="aprobar_rechazar_comentario.php?id=<?= $comment['comment_id'] ?>&accion=rechazar" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas rechazar este comentario?')">Rechazar</a>
                                <?php else: ?>
                                    <span class="text-muted">Acción no disponible</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay comentarios en el foro.</p>
        <?php endif; ?>

    </div>

    <!-- Incluye Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>



