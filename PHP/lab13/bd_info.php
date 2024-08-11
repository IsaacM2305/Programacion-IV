<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>bd info</title>
        <link rel="stylesheet" href="static/style.css">
        <style>
            table {
                border-collapse: collapse;
                margin: auto; 
                width: 80%; 
                background-color: white;
            }
            th {
                background-color: #f8b400; 
                color: white; 
                padding: 10px;
                text-align: center; 
                border: 1px solid black;
            }
            td {
                border: 1px solid black;
                padding: 10px;
                text-align: center; 
                
            }
            .info {
                text-align: center;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <h1>DB info</h1>

        <?php
            include 'db/conexion.php';

            // Obtener el nombre de la base de datos
            $dbName = $conn->query("SELECT DATABASE()")->fetch_row()[0];
            $tableName = "usuarios"; // Nombre de la tabla

            // Mostrar información de la base de datos
            echo "<div class='info'>";
            echo "<h2>Nombre de la Base de Datos: $dbName</h2>";
            echo "<h2>Nombre de la Tabla: $tableName</h2>";
            echo "</div>";

            $sql = "SELECT * FROM pasteleria.$tableName";
            $result = $conn->query($sql);

            // Verificar si hay usuarios registrados
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Nombre</th><th>Apellido</th><th>Usuario</th>
                    <th>Correo electrónico</th><th>Teléfono</th></tr>";

                // Mostrar los datos de cada usuario en la tabla
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['firstName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['lastName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No se han registrado usuarios.</p>";
            }
            // echo "<table style='border-collapse: collapse; justify-content: center;'>";
            $conn->close();
            echo "<br> <a href='index.php'><button type='button' style='background-color: #f8b400; font-size: 16px; 
            border-radius: 4px; width: 10%; padding: 10px; border-radius: 4px; color: white; border-radius: 4px; 
            cursor: pointer;'>Volver</button></a>";
        ?>
    </body>
</html>
