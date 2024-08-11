<?php
include 'conexion.php';
include 'vista.php';

// Mostrar tareas por hacer, en progreso y terminadas
$sql = "SELECT * FROM tareas WHERE estado = 'por hacer' ORDER BY fecha_compromiso ASC";
$result = $conn->query($sql);
$tareas_por_hacer = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM tareas WHERE estado = 'en progreso' ORDER BY fecha_compromiso ASC";
$result = $conn->query($sql);
$tareas_en_progreso = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM tareas WHERE estado = 'terminada' ORDER BY fecha_compromiso ASC";
$result = $conn->query($sql);
$tareas_terminadas = $result->fetch_all(MYSQLI_ASSOC);


// Mostrar opciones de reporte
$tipos_tareas = array();
$sql = "SELECT * FROM tipos_tareas";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $tipos_tareas[] = $row['nombre'];
}
?>