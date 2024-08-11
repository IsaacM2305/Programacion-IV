<?php
    $precio1 = $_POST['precio1'];
    $precio2 = $_POST['precio2'];
    $precio3 = $_POST['precio3'];

    $media = ($precio1 + $precio2 + $precio3)/3;

    echo "Datos recibidos <br>"; 

    echo "<br> Precio del producto en el establecimiento 1: ". $precio1. " dolares";
    echo "<br> Precio del producto en el establecimiento 2: ". $precio2. " dolares";
    echo "<br> Precio del producto en el establecimiento 3: ". $precio3. " dolares";

    echo "<br> El precio medio del producto es de : ". $media. " dolares";
?>