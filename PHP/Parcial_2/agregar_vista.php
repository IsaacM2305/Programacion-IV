<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "checklist_tracker");

// Obtener los tipos de tareas
$query = "SELECT * FROM tipos_tareas";
$resultado = mysqli_query($conexion, $query);
$tipos_tareas = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $tipos_tareas[] = $fila['nombre'];
}

// Cerrar la conexión
mysqli_close($conexion);
?>
<div class="modal-dialog">
    <form action="agregar.php" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Nueva Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo">
                <br>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"></textarea>
                <br>
                <label for="fecha_compromiso">Fecha compromiso:</label>
                <input type="date" id="fecha_compromiso" name="fecha_compromiso">
                <br>
                <label for="responsable">Responsable:</label>
                <input type="text" id="responsable" name="responsable">
                <br>
                <label for="tipo_tarea">Tipo de tarea:</label>
                <select id="tipo_tarea" name="tipo_tarea">
                    <?php foreach ($tipos_tareas as $tipo_tarea) { ?>
                        <option value="<?php echo $tipo_tarea; ?>"><?php echo $tipo_tarea; ?></option>
                    <?php } ?>
                </select>
                <br>
                <label for="estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="por hacer">Por hacer</option>
                    <option value="en progreso">En progreso</option>
                    <option value="terminada">Terminada</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>

        </div>
    </form>
</div>