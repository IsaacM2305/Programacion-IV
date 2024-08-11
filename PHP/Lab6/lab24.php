<html>
    <head>
        <title>laboratorio 2.4</title>
    </head>
    <body>
        <?php
            // Creacion del arreglo array("clave" => "valor")
            $personas = array("Juan" => "Panama",
            "John" => "USA",
            "Eica" => "Finlandia",
            "Kusanagi" => "Japon");
            
            // Recorrer todo el arreglo
            foreach ($personas as $persona => $pais){
                print("$persona es de $pais <br>");
            }
            // impresion especifica

            echo "<br>".$personas["Juan"];
            echo "<br>".$personas["Eica"];
        ?>
    </body>
</html>