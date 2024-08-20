<?php
// Iniciar sesión
session_start();

// Destruir todas las sesiones
session_unset();
session_destroy();

// Redirigir al usuario a la página de inicio o de login
header("Location: login.php");
exit();
?>
