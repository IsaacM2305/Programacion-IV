<?php
    include 'db/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['telefono'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        // Validar que las contraseñas coincidan
        if ($password != $confirmPassword) {
            echo "Las contraseñas no coinciden.";
        } else {
            $sql = "INSERT INTO pasteleria.usuarios (firstName, lastName, username, email, phone, pwd) 
                VALUES ('$firstName', '$lastName', '$username', '$email', '$phone', '$password')";
            if ($conn->query($sql) === TRUE) {
                header('Location: index.php');
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
?>
