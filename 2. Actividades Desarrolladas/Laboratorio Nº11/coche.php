<?php
    class Coche {
        public $color;
        public $marca;

        public function arrancar() {
            echo "El coche ha arrancado<br>";
        }

        public function detener() {
            echo "El coche se ha detenido<br>";
        }
    }

    $miCoche = new Coche();
    $miCoche->color = "Rojo";
    $miCoche->marca = "Toyota";

    $miCoche->arrancar();
    $miCoche->detener();

    echo "Color: " . $miCoche->color . "<br>";
    echo "Marca: " . $miCoche->marca . "<br>";
?>
