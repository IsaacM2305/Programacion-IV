<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Suma de Elementos de un Vector</title>
    </head>

    <body>
        <?php 
            $numeros = array(5, 10, 42, 20, 80);
            $suma = array_sum($numeros);
            echo "La suma de los elementos del vector es: " . $suma;
        ?>    
    </body>
</html>
