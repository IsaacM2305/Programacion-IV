<?php
    $numero = $_POST["numero"];
    if ($numero >= 0){
        $factorial = 1;
        for ($i = 1; $i <= $numero; $i++) {
            $factorial *= $i;
        }
        echo "<p>El factorial de $numero es: $factorial</p>";
    } else {
        echo "<p> El número ingresado debe ser entero y positivo.</p>";
    }
?>
