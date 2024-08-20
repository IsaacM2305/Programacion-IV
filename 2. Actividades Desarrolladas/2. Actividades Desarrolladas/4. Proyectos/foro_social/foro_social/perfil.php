<?php
include 'includes/header.php';
include 'includes/db_connect.php';

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Manejo del formulario de actualización del perfil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo_electronico = $_POST['correo_electronico'];
    $password = $_POST['password'];

    if ($password) {
        // Si se proporciona una nueva contraseña, se debe actualizar tanto el correo como la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nombre_usuario = ?, correo_electronico = ?, contrasena = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre_usuario, $correo_electronico, $password_hash, $user_id);
    } else {
        // Si no se proporciona una nueva contraseña, solo se actualiza el nombre de usuario y el correo
        $sql = "UPDATE usuarios SET nombre_usuario = ?, correo_electronico = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nombre_usuario, $correo_electronico, $user_id);
    }
    
    if ($stmt->execute()) {
        echo "<script>alert('Perfil actualizado exitosamente.');</script>";
    } else {
        echo "<script>alert('Error al actualizar perfil.');</script>";
    }
}

// Consulta para obtener la información del usuario
$sql = "SELECT nombre_usuario, correo_electronico FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<div class="container mt-5">
    <h1 class="text-center">Perfil de Usuario</h1>
    <form action="perfil.php" method="POST">
        <div class="form-group">
            <label for="nombre_usuario">Nombre de Usuario</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?= htmlspecialchars($user['nombre_usuario']) ?>" required>
        </div>
        <div class="form-group">
            <label for="correo_electronico">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?= htmlspecialchars($user['correo_electronico']) ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Nueva Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
    <button onclick="window.location.href='index.php'" class="btn btn-secondary mt-3">Volver</button>
</div>

<?php
include 'includes/footer.php';
?>


