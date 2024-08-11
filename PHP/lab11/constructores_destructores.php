<?php
    class Coche {
        private $color;
        private $marca;

        public function __construct($color, $marca) {
            $this->color = $color;
            $this->marca = $marca;
            echo "Coche creado: $this->marca de color $this->color<br>";
        }

        public function __destruct() {
            echo "El coche $this->marca de color $this->color ha sido destruido<br>";
        }

        public function arrancar() {
            echo "El coche ha arrancado<br>";
        }

        public function detener() {
            echo "El coche se ha detenido<br>";
        }
    }

    $miCoche = new Coche("Amarillo", "Ford");
    $miCoche->arrancar();
?>
