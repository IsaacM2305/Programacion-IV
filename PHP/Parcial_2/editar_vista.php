<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="assets/css/styles_editar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">

        <h1>Editar Tarea</h1>
        <form action="" method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($tarea['titulo']); ?>">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo htmlspecialchars($tarea['descripcion']); ?></textarea>

            <label for="fecha_compromiso">Fecha compromiso:</label>
            <input type="date" id="fecha_compromiso" name="fecha_compromiso" value="<?php echo htmlspecialchars($tarea['fecha_compromiso']); ?>">

            <label for="responsable">Responsable:</label>
            <input type="text" id="responsable" name="responsable" value="<?php echo htmlspecialchars($tarea['responsable']); ?>">

            <label for="tipo_tarea">Tipo de tarea:</label>
            <select id="tipo_tarea" name="tipo_tarea">
                <?php foreach ($tipos_tareas as $tipo_tarea) { ?>
                    <option value="<?php echo htmlspecialchars($tipo_tarea); ?>" <?php if ($tarea['tipo_tarea'] == $tipo_tarea) {
                                                                                        echo 'selected';
                                                                                    } ?>><?php echo htmlspecialchars($tipo_tarea); ?></option>
                <?php } ?>

            </select>
            <label for="estado">Estado:</label>
            <select id="estado" name="estado">
                <option value="por hacer" <?php if ($tarea['estado'] == 'por hacer') {
                                                echo 'selected';
                                            } ?>>Por hacer</option>
                <option value="en progreso" <?php if ($tarea['estado'] == 'en progreso') {
                                                echo 'selected';
                                            } ?>>En progreso</option>
                <option value="terminada" <?php if ($tarea['estado'] == 'terminada') {
                                                echo 'selected';
                                            } ?>>Terminada</option>
            </select>

            <input type="hidden" name="id" value="<?php echo htmlspecialchars($tarea['id']); ?>">
            <input type="hidden" name="etiqueta_editado" value="etiqueta_editado">
            <input type="hidden" name="editar" value="true" />
            <div class="mt-4 d-flex justify-content-end gap-3">
                <button class="btn btn-danger" href="index.php">Cancelar</button>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
        </form>
    </div>
</body>

</html>