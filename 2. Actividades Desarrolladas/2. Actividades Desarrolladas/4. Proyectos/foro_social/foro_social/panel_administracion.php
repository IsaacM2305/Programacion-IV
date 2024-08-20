<?php
// Iniciar sesión
session_start();

// Verificar si el usuario actual es administrador
if (!isset($_SESSION["role"]) || $_SESSION["role"] != 1) {
    // Redirigir al login si no es administrador
    header("Location: login.php");
    exit;
}

// Incluir el archivo de conexión a la base de datos
include 'includes/conexion.php';

// Obtener el número total de publicaciones pendientes
$sql = "SELECT COUNT(*) as total FROM moderacion WHERE estado = 'pendiente'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_publicaciones_pendientes = $row['total'];

// Obtener el número total de comentarios pendientes
$sql = "SELECT COUNT(*) as total FROM comentarios WHERE estado = 'pendiente'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_comentarios_pendientes = $row['total'];

// Obtener la lista de usuarios
$sql = "SELECT id, nombre_usuario, es_administrador FROM usuarios";
$usuarios_result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Bienvenido al Panel de Administración</h1>
    <div class="card">
        <h2>Moderación de Contenido</h2>
        <p>Total de publicaciones pendientes: <strong><?php echo $total_publicaciones_pendientes; ?></strong></p>
        <p>Total de comentarios pendientes: <strong><?php echo $total_comentarios_pendientes; ?></strong></p>
        <a href="index.php">Ir a moderar publicaciones</a><br>
        <a href="comentarios.php">Ir a moderar comentarios</a>
    </div>

    <div class="card">
        <h2>Gestión de Administradores</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre de Usuario</th>
                <th>Es Administrador</th>
                <th>Acción</th>
            </tr>
            <?php if ($usuarios_result && $usuarios_result->num_rows > 0): ?>
                <?php while ($usuario = $usuarios_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nombre_usuario']; ?></td>
                        <td><?php echo $usuario['es_administrador'] ? 'Sí' : 'No'; ?></td>
                        <td>
                            <?php if ($usuario['es_administrador'] == 0): ?>
                                <a href="actualizar_permisos.php?id=<?php echo $usuario['id']; ?>&accion=dar_admin">Dar permisos de administrador</a>
                            <?php else: ?>
                                <a href="actualizar_permisos.php?id=<?php echo $usuario['id']; ?>&accion=quitar_admin">Quitar permisos de administrador</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay usuarios disponibles.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="card">
        <h2>Opciones Adicionales</h2>
        <a href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>

