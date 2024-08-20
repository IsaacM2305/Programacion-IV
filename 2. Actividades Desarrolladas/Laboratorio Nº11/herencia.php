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

    class CocheDeportivo extends Coche {
        public function turbo() {
            echo "El turbo está activado<br>";
        }
    }

    $miCocheDeportivo = new CocheDeportivo();
    $miCocheDeportivo->color = "Azul";
    $miCocheDeportivo->marca = "Ferrari";

    $miCocheDeportivo->arrancar();
    $miCocheDeportivo->turbo();
    $miCocheDeportivo->detener();

    echo "Color: " . $miCocheDeportivo->color . "<br>";
    echo "Marca: " . $miCocheDeportivo->marca . "<br>";
?>
