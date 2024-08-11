<?php
    abstract class Vehiculo {
        abstract protected function descripcion();
    }

    class Coche extends Vehiculo {
        public function descripcion() {
            echo "Este es un coche<br>";
        }
    }

    $miCoche = new Coche();
    $miCoche->descripcion();
?>
