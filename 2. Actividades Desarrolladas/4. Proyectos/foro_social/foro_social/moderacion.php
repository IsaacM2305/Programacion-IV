<?php
include 'includes/header.php';
include 'includes/db_connect.php';

session_start();
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

// Moderación de publicaciones
$sql_posts = "SELECT posts.id, posts.title, posts.content, users.username, posts.created_at, posts.is_approved 
              FROM posts 
              JOIN users ON posts.user_id = users.id";
$result_posts = $conn->query($sql_posts);

// Moderación de comentarios
$sql_comments = "SELECT comments.id, comments.content, users.username, comments.created_at, comments.is_approved 
                 FROM comments 
                 JOIN users ON comments.user_id = users.id";
$result_comments = $conn->query($sql_comments);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $id = intval($_POST['id']);
    $action = isset($_POST['action']) ? intval($_POST['action']) : null;
    $action_type = isset($_POST['action_type']) ? $_POST['action_type'] : null;

    if ($type == 'post') {
        if ($action_type === null) {
            // Handle approve or reject
            $sql = "UPDATE posts SET is_approved = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $action, $id);
            if ($stmt->execute()) {
                echo "<script>alert('Publicación moderada exitosamente.'); window.location.href='moderacion.php';</script>";
            } else {
                echo "<script>alert('Error al moderar la publicación.');</script>";
            }
        } else {
            // Handle edit or delete
            if ($action_type == 'edit') {
                header("Location: editar_publicacion.php?id=$id");
                exit();
            } elseif ($action_type == 'delete') {
                $sql = "DELETE FROM posts WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    echo "<script>alert('Publicación eliminada exitosamente.'); window.location.href='moderacion.php';</script>";
                } else {
                    echo "<script>alert('Error al eliminar la publicación.');</script>";
                }
            }
        }
    } else {
        if ($action_type === null) {
            // Handle approve or reject
            $sql = "UPDATE comments SET is_approved = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $action, $id);
            if ($stmt->execute()) {
                echo "<script>alert('Comentario moderado exitosamente.'); window.location.href='moderacion.php';</script>";
            } else {
                echo "<script>alert('Error al moderar el comentario.');</script>";
            }
        } else {
            // Handle edit or delete
            if ($action_type == 'edit') {
                header("Location: editar_comentario.php?id=$id");
                exit();
            } elseif ($action_type == 'delete') {
                $sql = "DELETE FROM comments WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    echo "<script>alert('Comentario eliminado exitosamente.'); window.location.href='moderacion.php';</script>";
                } else {
                    echo "<script>alert('Error al eliminar el comentario.');</script>";
                }
            }
        }
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center">Moderación de Contenido</h1>
    <h2>Publicaciones</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Contenido</th>
                <th>Autor</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result_posts->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                    <td><?= $row['is_approved'] ? 'Aprobada' : 'Pendiente' ?></td>
                    <td>
                        <form action="moderacion.php" method="POST" style="display:inline;">
                            <input type="hidden" name="type" value="post">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="action_type" value="edit">
                            <button type="submit" class="btn btn-sm btn-primary">Editar</button>
                        </form>
                        <form action="moderacion.php" method="POST" style="display:inline;">
                            <input type="hidden" name="type" value="post">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="action_type" value="delete">
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                        <form action="moderacion.php" method="POST" style="display:inline;">
                            <input type="hidden" name="type" value="post">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="action" value="<?= $row['is_approved'] ? 0 : 1 ?>" class="btn btn-sm btn-<?= $row['is_approved'] ? 'danger' : 'success' ?>">
                                <?= $row['is_approved'] ? 'Rechazar' : 'Aprobar' ?>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Comentarios</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Contenido</th>
                <th>Autor</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result_comments->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                    <td><?= $row['is_approved'] ? 'Aprobado' : 'Pendiente' ?></td>
                    <td>
                        <form action="moderacion.php" method="POST" style="display:inline;">
                            <input type="hidden" name="type" value="comment">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="action_type" value="edit">
                            <button type="submit" class="btn btn-sm btn-primary">Editar</button>
                        </form>
                        <form action="moderacion.php" method="POST" style="display:inline;">
                            <input type="hidden" name="type" value="comment">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="action_type" value="delete">
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                        <form action="moderacion.php" method="POST" style="display:inline;">
                            <input type="hidden" name="type" value="comment">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="action" value="<?= $row['is_approved'] ? 0 : 1 ?>" class="btn btn-sm btn-<?= $row['is_approved'] ? 'danger' : 'success' ?>">
                                <?= $row['is_approved'] ? 'Rechazar' : 'Aprobar' ?>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <button onclick="window.location.href='index.php'" class="btn btn-secondary mt-3">Volver</button>
</div>

<?php
include 'includes/footer.php';
?>





