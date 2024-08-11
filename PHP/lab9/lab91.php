<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ventas = $_POST["ventas"];

        if ($ventas >= 80) {
            $imagen = "static/feliz.png";
            echo "<br> Las ventas superan el 80%";

        } elseif ($ventas >= 50 && $ventas < 80) {
            $imagen = "static/serio.png";
            echo "<br> Las ventas estan entre el 50% a 79%";

        } else {
            $imagen = "static/triste.png";
            echo "<br> Las ventas estan por debajo del 50%";
        }
        echo "<br><img id='image' src='$imagen' alt='caritas'>";

    }
 
?>
