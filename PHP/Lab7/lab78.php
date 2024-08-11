<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buscar un Valor en un Arreglo Asociativo</title>
    </head>

    <body>
        <?php 
            $miArray = array("nombre" => "Juan", "edad" => 30, "ciudad" => "Panama");
            
            $valorBuscado = "Juan";
            foreach ($miArray as $valor) {
                echo "El valor a buscar es: ", $valor, "<br>";
                
                if ($valor == $valorBuscado) {
                    echo "Valor encontrado.";
                    break; 
                }
            }
        ?>    
    </body>
</html>
