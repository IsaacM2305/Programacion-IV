<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invertir un Vector</title>
    </head>

    <body>
        <?php 
            $original_vector = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            echo "Vector original<br>";
            echo implode(", ", $original_vector);

            $reversed_vector = array_reverse($original_vector);
            echo "<br><br>Vector invertido<br> ";
            echo implode(", ", $reversed_vector); 

        ?>    
    </body>
</html>
