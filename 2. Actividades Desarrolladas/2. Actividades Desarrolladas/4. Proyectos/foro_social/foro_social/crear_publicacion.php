<?php
include 'includes/header.php';
include 'includes/db_connect.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO publicaciones (id_usuario, titulo, contenido) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $title, $content);
    
    if ($stmt->execute()) {
        echo "<script>alert('Publicación creada exitosamente.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error al crear la publicación: " . $stmt->error . "');</script>";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center">Crear Publicación</h1>
    <form action="crear_publicacion.php" method="POST">
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crear Publicación</button>
    </form>
    <button onclick="window.location.href='index.php'" class="btn btn-secondary mt-3">Volver</button>
</div>

<?php
include 'includes/footer.php';
?>


