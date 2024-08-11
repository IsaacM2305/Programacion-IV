<?php
function obtenerTareasPorHacer() {
    $conexion = mysqli_connect("localhost", "root", "", "checklist_tracker");
    $query = "SELECT * FROM tareas WHERE estado = 'por hacer'";
    $resultado = mysqli_query($conexion, $query);
    $tareas = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
      $tareas[] = $fila;
    }
    return $tareas;
}

function obtenerTareasEnProgreso() {
    $conexion = mysqli_connect("localhost", "root", "", "checklist_tracker");
    $query = "SELECT * FROM tareas WHERE estado = 'en progreso'";
    $resultado = mysqli_query($conexion, $query);
    $tareas = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $tareas[] = $fila;
    }
    return $tareas;
}

function obtenerTareasTerminadas() {
    $conexion = mysqli_connect("localhost", "root", "", "checklist_tracker");
    $query = "SELECT * FROM tareas WHERE estado = 'terminada'";
    $resultado = mysqli_query($conexion, $query);
    $tareas = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $tareas[] = $fila;
    }
    return $tareas;
}
?>