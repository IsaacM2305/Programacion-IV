<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultados</title>
        <link rel="stylesheet" href="static/style.css">
    </head>
    <body>
        <h1>Resultados</h1>
        <style>
            table {
                border-collapse: collapse;
                margin: auto; 
                width: 80%; 
                background-color: white;
            }
            th {
                background-color: blue; 
                color: white; 
                padding: 10px;
                text-align: center; 
            }
            td {
                border: 1px solid black;
                padding: 10px;
                text-align: center; 
            }
        </style>
        <?php
            include 'db/conexion.php';

            // Consultar los usuarios de la base de datos
            $sql = "SELECT * FROM quiz_database.quiz_form_data";
            $result = $conn->query($sql);

            // Verificar si hay usuarios registrados
            if ($result->num_rows > 0) {
                
                echo "<table style='border-collapse: collapse; justify-content: center;'>";
                echo "<tr><th style='border: 1px solid black; padding: 8px;'>Nombre</th><th style='border: 1px solid black; padding: 8px;'>Apellido</th><th style='border: 1px solid black; padding: 8px;'>Usuario</th>
                <th style='border: 1px solid black; padding: 8px;'>Correo electronico</th><th style='border: 1px solid black; padding: 8px;'>Teléfono</th></tr>";

                // Mostrar los datos de cada usuario en la tabla
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td style='border: 1px solid black; padding: 8px;'>" . $row['firstName'] . "</td>";
                    echo "<td style='border: 1px solid black; padding: 8px;'>" . $row['lastName'] . "</td>";
                    echo "<td style='border: 1px solid black; padding: 8px;'>" . $row['username'] . "</td>";
                    echo "<td style='border: 1px solid black; padding: 8px;'>" . $row['email'] . "</td>";
                    echo "<td style='border: 1px solid black; padding: 8px;'>" . $row['phone'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No se han registrado usuarios.";
            }

        // Cerrar la conexión
        $conn->close();
        echo "<br> <a href='index.php'><button type='button'>Volver</button></a> &nbsp";
  
    ?>

    </body>
</html>

