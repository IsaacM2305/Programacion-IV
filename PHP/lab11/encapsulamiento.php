<?php
    class Coche {
        private $color;
        private $marca;

        public function setColor($color) {
            $this->color = $color;
        }

        public function getColor() {
            return $this->color;
        }

        public function setMarca($marca) {
            $this->marca = $marca;
        }

        public function getMarca() {
            return $this->marca;
        }

        public function arrancar() {
            echo "El coche ha arrancado<br>";
        }

        public function detener() {
            echo "El coche se ha detenido<br>";
        }
    }

    $miCoche = new Coche();
    $miCoche->setColor("Verde");
    $miCoche->setMarca("Honda");

    echo "Color: " . $miCoche->getColor() . "<br>";
    echo "Marca: " . $miCoche->getMarca() . "<br>";
    $miCoche->arrancar();
?>
