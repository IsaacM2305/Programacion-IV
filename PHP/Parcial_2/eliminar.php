<?php
include 'conexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM tareas WHERE id = '$id'";
$conn->query($sql);

header('Location: index.php');
exit;
?>