<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultados</title>
    </head>
    <body>
        <h1>Resultados</h1>

        <?php
            session_start();
            if (!isset($_SESSION['users'])) {
                $_SESSION['users'] = array();
            }

            if (isset($_POST["firstname"])) {
                $firstName = $_POST['firstname'];
                $lastName = $_POST['lastname'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $phone = $_POST['telefono'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirm_password'];
                
                if ($password == $confirmPassword) {
                    $userData = array(
                        'firstname' => $firstName,
                        'lastname' => $lastName,
                        'username' => $username,
                        'email' => $email,
                        'phone' => $phone
                    );
                    
                    // Verificar si el usuario ya existe en el arreglo
                    $userExists = false;
                    foreach ($_SESSION['users'] as $user) {
                        if ($user['username'] == $userData['username']) {
                            $userExists = true;
                            break;
                        }
                    }
                
                    
                    // Mostrar la tabla con los usuarios registrados
                    if (count($_SESSION['users']) > 0) {
                        echo "<table style='border-collapse: collapse;'>";
                        echo "<tr><th style='border: 1px solid black; padding: 8px;'>Nombre</th><th style='border: 1px solid black; padding: 8px;'>Apellido</th><th style='border: 1px solid black; padding: 8px;'>Usuario</th><th style='border: 1px solid black; padding: 8px;'>Correo</th><th style='border: 1px solid black; padding: 8px;'>Teléfono</th></tr>";
                        foreach ($_SESSION['users'] as $userData) {
                            echo "<tr>";
                            echo "<td style='border: 1px solid black; padding: 8px;'>" . $userData['firstname'] . "</td>";
                            echo "<td style='border: 1px solid black; padding: 8px;'>" . $userData['lastname'] . "</td>";
                            echo "<td style='border: 1px solid black; padding: 8px;'>" . $userData['username'] . "</td>";
                            echo "<td style='border: 1px solid black; padding: 8px;'>" . $userData['email'] . "</td>";
                            echo "<td style='border: 1px solid black; padding: 8px;'>" . $userData['phone'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        
                    } else {
                        echo "No se han registrado usuarios.";
                    }

                    // Agregar el usuario solo si no existe
                    if (!$userExists) {
                        $_SESSION['users'][] = $userData;
                    } else {
                        echo "<h3>El usuario ya existe. Por favor, inténtalo de nuevo con un nombre de usuario diferente: $username </h3><br>";
                    }

                } else {
                    echo "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
                }


            }

            if (isset($_GET['clear'])) {
                $_SESSION['users'] = array();
                echo "Usuarios eliminados.";
                header("Location: index.html");
                exit;
            }
        echo "<br> <a href='index.html'><button type='button'>Volver</button></a> &nbsp";
        echo "<a href='datos.php?clear=1'><button type='button'>Eliminar usuarios</button></a>";
    ?>    
    </body>
</html>

