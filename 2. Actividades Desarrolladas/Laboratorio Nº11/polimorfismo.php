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

        public function descripcion() {
            echo "Este es un coche normal<br>";
        }
    }

    class CocheDeportivo extends Coche {
        public function turbo() {
            echo "El turbo está activado<br>";
        }

        public function descripcion() {
            echo "Este es un coche deportivo<br>";
        }
    }

    $miCoche = new Coche();
    $miCoche->descripcion();

    $miCocheDeportivo = new CocheDeportivo();
    $miCocheDeportivo->descripcion();
?>
