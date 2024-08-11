<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Imprimir Elementos de un Vector</title>
    </head>

    <body>
        <?php 
            $n_array = array(3, 4, 5, 23, 35, 54, 99);

            for ($i = 0; $i < count($n_array); $i++) {
                echo "<br>", $n_array[$i];
            }
        ?>    
    </body>
</html>
