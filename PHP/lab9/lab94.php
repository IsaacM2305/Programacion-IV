<?php
    session_start();
    if (!isset($_SESSION['numbers'])) {
        $_SESSION['numbers'] = [];
    }

    if (isset($_POST["submit"])) {
        $number = $_POST["number"];
        

        if ($number % 2 == 0) {
            if (count($_SESSION['numbers']) < 10) {
                $_SESSION['numbers'][] = $number;
                header("Location: lab94.php");
                exit;

            } else {
                echo "Ya has ingresado 10 numeros pares";
            }

        } else {
            echo "<h4> AVISO: El número ingresado no es par: ( $number )</h4>";
        }


    } elseif (isset($_POST["clear"])) {
        $_SESSION['numbers'] = [];
        echo "Arreglo vaciado";
        header("Location: lab94.html");
        exit;
    }

    if (count($_SESSION['numbers']) > 0) {
        echo "<p>Números ingresados:</p>";
        echo "<ul>";
        foreach ($_SESSION['numbers'] as $num) {
            echo "<li>$num</li>";
        }
        echo "</ul>";
    }

    echo "<br> Volver para ingresar mas numeros <br>";
    echo "<a href='lab94.html'><button type='button'>Volver</button></a>";

?>