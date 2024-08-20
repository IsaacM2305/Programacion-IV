<?php
    if (is_uploaded_file ($_FILES['nombre_archivo_cliente']['tmp_name'])){
        $nombreDirectorio = "archvios/";
        $nombrearchivo = $_FILES['nombre_archivo_cliente']['name'];
        $nombreCompleto = $nombreDirectorio . $nombrearchivo;

        // limite del tamaño de la imagen 
        $tamanioArchivo = $_FILES['nombre_archivo_cliente']['size'];
        $tamanioMaximo = 1000000; // 1 MB

        // Verificar formato de imagen 
        $tipoArchivo = $_FILES['nombre_archivo_cliente']['type'];
        $formatosPermitidos = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');

        if ($tamanioArchivo > $tamanioMaximo) {
            echo "El archivo excede el tamaño máximo permitido de 1 MB.";
        
        } elseif (!in_array($tipoArchivo, $formatosPermitidos)) {
            echo "El formato del archivo no es válido. Solo se permiten archivos de imagen (JPG, JPEG, GIF, PNG).";    
        
        } else {

            if (is_file($nombreCompleto)){
                $idUnico = time();
                $nombrearchivo = $idUnico . "-" . $nombrearchivo;
                echo "Archivo repetido, se cambiara el nombre a $nombrearchivo
                <br><br>";
            }
            move_uploaded_file ($_FILES['nombre_archivo_cliente']['tmp_name'],
            $nombreDirectorio . $nombrearchivo);
            
            echo "El archivo se ha subido satisfactoriamente al directorio $nombreDirectorio <br>";
        }
    } else {
        echo "No se ha podido subir el archivo <br>";
    }
    echo "<br> <a href='lab101.html'><button type='button'>Volver</button></a>";
?>