<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ecuacion1</title>
</head>
    <body>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Recoger los datos del formulario
                $numeroA = $_POST['numeroA'];
                $numeroB = $_POST['numeroB'];
                $numeroC = $_POST['numeroC'];
                $operacion = $_POST['operacion'];

                // Variable para almacenar el resultado
                $resultadox1 = null;

                // Realizar la operación seleccionada
                switch ($operacion) {
                    case 'Negativo':
                        $n = 1;
                        $resultadox1 = (-$numeroB + sqrt(($numeroB*$numeroB - 4 * $numeroA * $numeroC))) / (2*$numeroA);
                        break;
                    case 'Positivo':
                        $resultado = $numeroA - $numeroB;
                        break;

                    default:
                        $n = 2;
                        $resultado = "Operación no válida.";
                        break;
                }

                // Mostrar el resultado
                echo "Resultado de la operación x$n: $resultadox1";
            } else {
                echo "Método no permitido.";
            }
        ?>
    </body>
</html>