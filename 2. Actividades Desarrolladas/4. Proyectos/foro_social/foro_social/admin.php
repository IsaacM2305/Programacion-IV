<?php
// Incluir el archivo de conexión a la base de datos
include 'includes/conexion.php';

// Iniciar sesión
session_start();

// Verificar si se envió el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"]; // Campo del formulario
    $password = $_POST["password"]; // Campo del formulario

    // Consulta para verificar el usuario y contraseña
    $sql = "SELECT * FROM foro_social_latina.usuarios WHERE es_administrador = 1 AND nombre_usuario = ?";
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña
        if ($row["contrasena"] === $password) { // Asegúrate de que este nombre de columna es correcto
            // Establecer variables de sesión
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["nombre_usuario"]; // Asegúrate de que este nombre de columna es correcto
            $_SESSION["role"] = $row["es_administrador"];

            // Redirigir al panel de administración
            header("Location: panel_administracion.php");
            exit;
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Login</h1>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

