<?php
// Consultas para el reporte
$reportes = [
    'Por Tipo de Tarea' => "SELECT tt.nombre AS tipo_tarea, COUNT(t.id) AS cantidad
                            FROM tareas t
                            JOIN tipos_tareas tt ON t.tipo_tarea = tt.id
                            GROUP BY tt.nombre",

    'Por Estado' => "SELECT estado, COUNT(id) AS cantidad
                     FROM tareas
                     GROUP BY estado",

    'Por Día' => "SELECT DATE(fecha_compromiso) AS fecha, COUNT(id) AS cantidad
                  FROM tareas
                  GROUP BY DATE(fecha_compromiso)",

    'Por Semana' => "SELECT YEARWEEK(fecha_compromiso, 1) AS semana, COUNT(id) AS cantidad
                     FROM tareas
                     GROUP BY YEARWEEK(fecha_compromiso, 1)",

    'Por Mes' => "SELECT YEAR(fecha_compromiso) AS anio, MONTH(fecha_compromiso) AS mes, COUNT(id) AS cantidad
                  FROM tareas
                  GROUP BY YEAR(fecha_compromiso), MONTH(fecha_compromiso)",

    'Por Año' => "SELECT YEAR(fecha_compromiso) AS anio, COUNT(id) AS cantidad
                  FROM tareas
                  GROUP BY YEAR(fecha_compromiso)"
];
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Reporte de Tareas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php foreach ($reportes as $titulo => $sql) : ?>
                <h2><?php echo htmlspecialchars($titulo); ?></h2>
                <table>
                    <thead>
                        <tr>
                            <?php
                            // Obtén los nombres de las columnas
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $columns = array_keys($result->fetch_assoc());
                                foreach ($columns as $column) {
                                    echo "<th>" . htmlspecialchars(ucfirst(str_replace('_', ' ', $column))) . "</th>";
                                }
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Ejecuta la consulta y muestra los resultados
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <?php foreach ($row as $value) : ?>
                                    <td><?php echo htmlspecialchars($value); ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>

    </div>
</div>