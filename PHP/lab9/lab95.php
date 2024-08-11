<?php

    $dimension = $_POST["n_numero"];
    
    if ($dimension % 2 == 0) {
        echo "<p>Matriz identidad de orden $dimension</p>";
        echo "<table border='1'>";
        
        for ($i = 1; $i <= $dimension; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $dimension; $j++) {
                if ($i == $j) {
                    echo "<td>1</td>";
                } else {
                    echo "<td>0</td>";
                }
            }
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "El valor de la dimension debe ser un número par.";
    }

?>
