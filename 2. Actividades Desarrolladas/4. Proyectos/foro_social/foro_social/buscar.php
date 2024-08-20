<?php
session_start();
include 'includes/header.php';
include 'includes/db_connect.php';

// Obtener la consulta de búsqueda
$query = $_GET['query'] ?? '';

// Buscar publicaciones y comentarios
$sql_posts = "SELECT p.id, p.titulo AS title, p.contenido AS content, u.nombre_usuario AS username, p.fecha_creacion AS created_at 
              FROM publicaciones p 
              JOIN usuarios u ON p.id_usuario = u.id 
              WHERE p.titulo LIKE ? OR p.contenido LIKE ? 
              ORDER BY p.fecha_creacion DESC";
$stmt = $conn->prepare($sql_posts);
$search_query = "%$query%";
$stmt->bind_param("ss", $search_query, $search_query);
$stmt->execute();
$result_posts = $stmt->get_result();

$sql_comments = "SELECT c.id, c.contenido AS content, u.nombre_usuario AS username, c.fecha_creacion AS created_at 
                 FROM comentarios c 
                 JOIN usuarios u ON c.id_usuario = u.id 
                 WHERE c.contenido LIKE ? 
                 ORDER BY c.fecha_creacion DESC";
$stmt_comments = $conn->prepare($sql_comments);
$stmt_comments->bind_param("s", $search_query);
$stmt_comments->execute();
$result_comments = $stmt_comments->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de la Búsqueda</title>
    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Resultados de la Búsqueda</h1>

        <?php if (isset($_SESSION['user_id'])): ?>
            <p class="text-center">Hola, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
            <a href="logout.php" class="btn btn-secondary mb-3">Cerrar sesión</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-primary mb-3">Iniciar sesión</a>
            <a href="register.php" class="btn btn-secondary mb-3">Registrarse</a>
        <?php endif; ?>

        <h2>Publicaciones</h2>
        <div class="row">
            <?php if ($result_posts->num_rows > 0): ?>
                <?php while ($row = $result_posts->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</p>
                                <p class="text-muted">Por <?= htmlspecialchars($row['username']) ?> el <?= htmlspecialchars($row['created_at']) ?></p>
                                <a href="post.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-sm btn-outline-secondary">Ver más</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No se encontraron publicaciones.</p>
            <?php endif; ?>
        </div>

        <h2>Comentarios</h2>
        <div class="row">
            <?php if ($result_comments->num_rows > 0): ?>
                <?php while ($row = $result_comments->fetch_assoc()): ?>
                    <div class="col-md-12">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <p class="card-text"><?= htmlspecialchars($row['content']) ?></p>
                                <p class="text-muted">Por <?= htmlspecialchars($row['username']) ?> el <?= htmlspecialchars($row['created_at']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No se encontraron comentarios.</p>
            <?php endif; ?>
        </div>

        <button onclick="window.location.href='index.php'" class="btn btn-secondary mt-3">Volver</button>
    </div>

    <!-- Incluye Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$stmt_comments->close();
$conn->close();
?>




