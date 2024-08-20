<?php
include 'includes/header.php';
include 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; //password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Validación y registro del usuario
    $sql = "INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);
    
    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso. Por favor, verifique su correo electrónico para confirmar el registro.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error en el registro: " . $stmt->error . "');</script>";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center">Registro de Usuario</h1>
    <form action="registro.php" method="POST">
        <div class="form-group">
            <label for="username">Nombre de Usuario</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
    <button onclick="window.location.href='index.php'" class="btn btn-secondary mt-3">Volver</button>
</div>

<?php
include 'includes/footer.php';
?>
