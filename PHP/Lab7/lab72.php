<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Suma de Números Pares del 1 al 100</title>
    </head>

    <body>
        <?php 
            $n_pares = 0;
            for ($i = 1; $i <= 100; $i++) {
                if ($i % 2 == 0) {
                    $n_pares += $i;
                }
                
            }
            echo "La suma de los números pares del 1 al 100 es: $n_pares";
        ?>    
    </body>
</html>
