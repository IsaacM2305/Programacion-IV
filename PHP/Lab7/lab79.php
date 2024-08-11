<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ordenar un Vector</title>
    </head>

    <body>
        <?php 
            $numeros = array(5, 2, 9, 1, 7);
            echo "Orden original: ";
            foreach ($numeros as $numero) {
                echo "<br>". $numero . "\n";
            }

            sort($numeros);
            echo "<br><br>Ordenamiento del vecto de menor a mayor: ";
            foreach ($numeros as $numero) {
                echo "<br>". $numero . "\n";
            }
        ?>    
    </body>
</html>
