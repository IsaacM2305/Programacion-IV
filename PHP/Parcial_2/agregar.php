<?php
include 'conexion.php';
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha_compromiso = $_POST['fecha_compromiso'];
$responsable = $_POST['responsable'];
$tipo_tarea = $_POST['tipo_tarea'];
$estado = $_POST['estado'];

$sql = "INSERT INTO tareas (titulo, descripcion, fecha_compromiso, responsable, tipo_tarea, estado) VALUES ('$titulo', '$descripcion', '$fecha_compromiso', '$responsable', '$tipo_tarea', '$estado')";
$conn->query($sql);

header('Location: index.php');
exit;
