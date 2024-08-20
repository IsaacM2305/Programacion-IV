<?php
session_start();
include 'conexion.php';

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    echo "Usuario no encontrado";
    exit();
}

// Obtener el nombre de usuario desde la sesión
$nombre_usuario = $_SESSION['usuario'];

// Verifica que la conexión se haya establecido
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta para obtener la información del usuario
$sql = "SELECT * FROM usuarios WHERE nombre_usuario=?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit();
    }
    $stmt->close();
} else {
    die("Error en la consulta: " . $conn->error);
}

// Verifica si se envió el formulario para actualizar el perfil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nuevo_nombre_usuario = $_POST['nombre_usuario'];
    $nuevo_email = $_POST['email'];
    $nueva_contraseña = $_POST['password'];

    // Actualiza la información del usuario
    $sql = "UPDATE usuarios SET nombre_usuario=?, email=?, contraseña=? WHERE nombre_usuario=?";
    if ($stmt = $conn->prepare($sql)) {
        $nueva_contraseña_hash = password_hash($nueva_contraseña, PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $nuevo_nombre_usuario, $nuevo_email, $nueva_contraseña_hash, $nombre_usuario);
        if ($stmt->execute()) {
            // Actualiza la sesión con el nuevo nombre de usuario
            $_SESSION['usuario'] = $nuevo_nombre_usuario;
            echo "Perfil actualizado con éxito.";
        } else {
            echo "Error al actualizar el perfil: " . $stmt->error;
        }
        $stmt->close();
    } else {
        die("Error en la consulta: " . $conn->error);
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
</head>
<body>
    <h1>Editar Perfil</h1>
    <form method="POST" action="editar_perfil.php">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($user['nombre_usuario']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password">

        <button type="submit">Actualizar Perfil</button>
    </form>

    <button onclick="window.location.href='index.php'">Volver</button>
</body>
</html>




