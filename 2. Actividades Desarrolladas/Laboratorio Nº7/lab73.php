<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calcular el Factorial de un Número</title>
    </head>

    <body>
        <h1>Calculadora de Factorial</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="numero">Ingrese un número:</label>
            <input type="number" id="numero" name="numero" required>
            <input type="submit" name="submit" value="Calcular Factorial">
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $numero = $_POST["numero"];
                $factorial = 1;
                for ($i = 1; $i <= $numero; $i++) {
                    $factorial *= $i;
                }
                echo "El factorial de $numero es: $factorial";
            }
        ?>
    </body>
</html>