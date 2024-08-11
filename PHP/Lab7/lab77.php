<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Imprimir Elementos de una Matriz</title>
    </head>

    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="row_index">Ingresa el número de la fila (1-3):</label>
            <input type="number" id="row_index" name="row_index" required>
            <br><br>
            <label for="col_index">Ingresa el número de la columna (1-3):</label>
            <input type="number" id="col_index" name="col_index" required>
            <br><br>
            <button type="submit">Enviar</button>
            <br><br><br>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $row_index = $_POST["row_index"];
                $col_index = $_POST["col_index"];

                $matrix = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];

                if ($row_index >= 1 && $row_index <= count($matrix) && $col_index >= 1 && $col_index <= count($matrix[0])){
                    $resultado = $matrix[$row_index - 1][$col_index - 1];
                    echo "El elemento en la fila $row_index, columna $col_index es: $resultado";
                } else {
                    echo "Los índices ingresados están fuera de los límites de la matriz.";
                }
            }
        ?>
    </body>
</html>

