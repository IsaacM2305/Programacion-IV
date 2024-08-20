<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>laboratorio 2.7</title>
    </head>
    <body>
        <?php
            $posicion = "arriba";

            switch ($posicion){
                case "arriba":
                    echo "La variable contiene";
                    echo "el valor de arriba";
                    break;
                case "abajo":
                    echo "La variable contiene";
                    echo "el valor de abajo";
                    break;
                default:
                    echo "La variable contiene otro valor";
                    echo "distinto de arriba y abajo";
            }
        ?>
    </body>
</html>
