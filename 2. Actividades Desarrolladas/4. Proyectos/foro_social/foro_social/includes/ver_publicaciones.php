<?php
// Conexión a la base de datos
include 'includes/conexion.php';

// Verificar si 'id' está presente en la URL
if (!isset($_GET['id'])) {
    die('Error: ID no proporcionado.');
}

$publicacion_id = intval($_GET['id']); // Asegúrate de que 'id' sea un entero para evitar SQL Injection

// Consulta para obtener la publicación
$sql = "SELECT p.title AS titulo, p.content AS contenido, u.username AS nombre_usuario, p.created_at AS fecha_creacion 
        FROM posts p 
        JOIN users u ON p.user_id = u.id 
        WHERE p.id = ? AND p.is_approved = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $publicacion_id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si la publicación fue encontrada y está aprobada
if ($result->num_rows > 0) {
    $publicacion = $result->fetch_assoc();
} else {
    echo "Publicación no encontrada o no aprobada.";
    exit();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($publicacion['titulo']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
    </style>
</head>
<body>
    <h1><?php echo htmlspecialchars($publicacion['titulo']); ?></h1>
    <p>Por: <?php echo htmlspecialchars($publicacion['nombre_usuario']); ?></p>
    <p>Publicado el: <?php echo htmlspecialchars($publicacion['fecha_creacion']); ?></p>
    <div>
        <?php echo nl2br(htmlspecialchars($publicacion['contenido'])); ?>
    </div>
    <button onclick="window.location.href='index.php'">Volver</button>
</body>
</html>





