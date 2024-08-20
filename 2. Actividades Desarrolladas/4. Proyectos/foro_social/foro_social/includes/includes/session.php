<?php
session_start();

// Verifica si el usuario está conectado
if (isset($_SESSION['user_id'])) {
    // Puedes recuperar información del usuario aquí si lo deseas
    // Ejemplo: $username = $_SESSION['username'];
}
?>
