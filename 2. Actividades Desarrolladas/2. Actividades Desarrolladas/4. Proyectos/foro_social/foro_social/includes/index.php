<?php
session_start();
include 'includes/db_connect.php';
include 'includes/header.php';

// Consulta de publicaciones recientes con conteo de comentarios
$sql = "SELECT 
            p.id, p.titulo AS title, 
            p.contenido AS content, 
            u.nombre_usuario AS username, 
            p.creado_en AS created_at,
                (SELECT COUNT(*) 
                    FROM foro_social_latina.comentarios c 
                    WHERE c.id_publicacion = p.id
                ) AS comment_count       
        FROM foro_social_latina.publicaciones p
        INNER JOIN foro_social_latina.usuarios u ON p.id_usuario = u.id 
        ORDER BY p.creado_en DESC 
        LIMIT 10";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Foro Social</title>
    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Foro Social</h1>

        <?php if (isset($_SESSION['user_id'])): ?>
            <p class="text-center">Hola, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
            <a href="logout.php" class="btn btn-secondary mb-3">Cerrar sesión</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-primary mb-3">Iniciar sesión</a>
            <a href="register.php" class="btn btn-secondary mb-3">Registrarse</a>
        <?php endif; ?>

        <a href="crear_publicacion.php" class="btn btn-primary mb-3">Crear Publicación</a>
        <form action="buscar.php" method="GET" class="form-inline my-2 my-lg-0 mb-3">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="query">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>

        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</p>
                                <p class="text-muted">Por <?= htmlspecialchars($row['username']) ?> el <?= htmlspecialchars($row['created_at']) ?></p>
                                <p class="text-muted"><?= $row['comment_count'] ?> comentarios</p>
                                <a href="post.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-sm btn-outline-secondary">Ver más</a>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <a href="eliminar_publicacion.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta publicación?');">Eliminar</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No hay publicaciones recientes.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Incluye Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
