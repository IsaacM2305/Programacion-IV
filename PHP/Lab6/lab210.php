<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>laboratorio 2.10</title>
    </head>
    <body>
        <?php
            $personas = array(
                            array("nombre"=> "Rosa", "estatura" => 168, "sexo" => "F"),
                            array("nombre"=> "Ignacio", "estatura" => 175, "sexo" => "M"),
                            array("nombre"=> "Daniel", "estatura" => 172, "sexo" => "M"),
                            array("nombre"=> "Ruben", "estatura" => 182, "sexo" => "M")
                        );

            echo "<b>DATOS SOBRE EL PERSONAL <b><br><hr>";

            $numPersonas = count($personas);
            for ($i = 0; $i < $numPersonas; $i++){
                echo "Nombre: <b>", $personas[$i]["nombre"], "</b><br>";
                echo "Estatura: <b>", $personas[$i]["estatura"], "cm </b><br>";
                echo "Sexo: <b>", $personas[$i]["sexo"], "</b><br><br>";
            }
        ?>
    </body>
</html>
