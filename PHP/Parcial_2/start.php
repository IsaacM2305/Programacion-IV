<?php
include 'conexion.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$sql = "UPDATE tareas SET estado = 'en progreso' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array('success' => 'ok'));
} else {
    echo json_encode(array('success' => 'error'));
}


