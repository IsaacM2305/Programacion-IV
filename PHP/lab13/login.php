<?php
session_start();
    include 'db/conexion.php';

    $user = $_POST['username'];
    $pass = $_POST['pass'];

    $sql = "SELECT username, pwd FROM pasteleria.usuarios WHERE username = ? AND pwd = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if ($result->num_rows > 0) {
        // Credenciales válidas
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username']; 
        header("Location: principal.php");
      
    } else {
        // Credenciales inválidas
        echo "<h2>Usuario o contraseña incorrectos.</h2>";
        echo "<a href='index.php'><button type='button'style='background-color: #f8b400; font-size: 16px; 
            border-radius: 4px; width: 10%; padding: 10px; border-radius: 4px; color: white; border-radius: 4px; 
            cursor: pointer;'>Volver</button></a> &nbsp";
    }

    $stmt->close();
    $conn->close();
?>
