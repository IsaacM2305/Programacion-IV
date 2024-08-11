<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Imprimir Tabla de Multiplicar</title>
    </head>

    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="numero">Ingresa el número de la tabla de multiplicar:</label>
            <input type="number" id="numero" name="numero" required>
            <button type="submit">Generar Tabla</button>
        </form>

        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $numero = $_POST["numero"];

                echo "<h2>Tabla de Multiplicar del $numero</h2>";
                echo "<table>";

                for ($i = 1; $i <= 12; $i++) {
                    $resultado = $numero * $i;
                    echo "<tr><td>$numero x $i</td><td>=</td><td>$resultado</td></tr>";
                }

                echo "</table>";
            }
        ?>    
    </body>
</html>
