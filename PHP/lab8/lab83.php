<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laboratorio 3.4</title>
    </head>
    <body>
        <?php
            if(array_key_exists('enviar', $_POST)){
                if ($_REQUEST['Apellido'] != ''){
                    echo "El apellido ingresado es:". $_REQUEST['Apellido'];
                }
                else{
                    echo "Favor coloque el apellido";
                }
                echo "<br>";
                
                if ($_REQUEST['Nombre'] != ''){
                    echo "El nombre ingresado es: ". $_REQUEST['Nombre'];
                }
                else{
                    echo "Favor coloque el apellido";
                }
            }
            else{
            ?>  
                <form action="lab83.php" method="post">
                   Nombre: <input type="text" name="Nombre"><br><br>
                   Apellido: <input type="text" name="Apellido"><br><br>
                   <input type="submit" name="enviar" value="Enviar datos"> 
                </form>
            <?php
            }
            ?>
    </body>
</html>