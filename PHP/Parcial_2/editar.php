<?php
include 'conexion.php';

// Obtener el ID de la tarea desde la URL
$id = $_GET['id'];

// Obtener los datos de la tarea específica
$sql = "SELECT * FROM tareas WHERE id = '$id'";
$result = $conn->query($sql);
$tarea = $result->fetch_assoc();

// Obtener los tipos de tarea desde la base de datos
$sql_tipos = "SELECT nombre FROM tipos_tareas";
$result_tipos = $conn->query($sql_tipos);
$tipos_tareas = [];
while ($row = $result_tipos->fetch_assoc()) {
  $tipos_tareas[] = $row['nombre'];
}

// Procesar el formulario de edición cuando se envía
if (isset($_POST['editar'])) {
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $fecha_compromiso = $_POST['fecha_compromiso'];
  $responsable = $_POST['responsable'];
  $tipo_tarea = $_POST['tipo_tarea'];
  $estado = $_POST['estado'];

  // Determinar si la tarea ha sido modificada
  $etiqueta_editado = 1;

  // Actualizar la tarea en la base de datos
  $sql = "UPDATE tareas SET titulo = '$titulo', descripcion = '$descripcion', fecha_compromiso = '$fecha_compromiso', responsable = '$responsable', tipo_tarea = '$tipo_tarea', estado = '$estado', etiqueta_editado = '$etiqueta_editado' WHERE id = '$id'";
  $conn->query($sql);

  // Redirigir a la página principal después de la actualización
  header('Location: index.php');
  exit;
}

// Incluir la vista de edición
include 'editar_vista.php';

// Cerrar la conexión a la base de datos
$conn->close();
?>



