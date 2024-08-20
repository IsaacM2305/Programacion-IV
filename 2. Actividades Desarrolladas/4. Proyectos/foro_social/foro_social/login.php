<?php
session_start();
include 'includes/header.php';
include 'includes/db_connect.php';

// Manejo del formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar el usuario
    $sql = "SELECT id, nombre_usuario, contrasena, es_administrador FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $db_username, $db_password, $is_admin);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $is_admin; // Guardar el rol en la sesión

            // Redirigir a la página principal o al panel de administración si es admin
            if ($is_admin) {
                header("Location: panel_administracion.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Nombre de usuario o contraseña incorrectos.";
        }
    } else {
        $error = "Nombre de usuario o contraseña incorrectos.";
    }

    // Cerrar la consulta
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Iniciar Sesión</h1>
        <form action="login.php" method="POST">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
        <button onclick="window.location.href='index.php'" class="btn btn-secondary mt-3">Volver</button>
    </div>
    <!-- Incluye Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




