<?php
    
    $array = array();

    for ($i = 0; $i < 20; $i++) {
        $num = rand(1, 100);
        while (in_array($num, $array)) {
            $num = rand(1, 100);
        }
        $array[$i] = $num;
    }

    $mayor = max($array);
    $posicion = array_search($mayor, $array);

    echo "Arreglo: ";
    for ($i = 0; $i < 20; $i++) {
        echo $array[$i] . " ";
    }

    echo "<br><br>";
    echo "El elemento mayor es: " . $mayor . " y se encuentra en la posición " . $posicion;
?>
