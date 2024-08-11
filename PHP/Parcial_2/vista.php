<?php
include 'modelo.php'; // Incluye el archivo que define la variable $tareas_por_hacer
$tareas_por_hacer = obtenerTareasPorHacer(); // Inicializa la variable
$tareas_en_progreso = obtenerTareasEnProgreso();
$tareas_terminadas = obtenerTareasTerminadas();
include 'conexion.php';
$total = count($tareas_por_hacer) + count($tareas_en_progreso) + count($tareas_terminadas);
$without_complete = count($tareas_por_hacer) + count($tareas_en_progreso);
try {
    if ($total === 0) {
        throw new DivisionByZeroError("El total no puede ser cero.");
    }

    $progress = ($total - $without_complete) / $total * 100;

} catch (DivisionByZeroError $e) {
    // Manejo del error de división por cero
    $progress = 0; // O puedes asignar otro valor predeterminado
    echo "Error: " . $e->getMessage(); // Opcional: mostrar el mensaje de error
} catch (Exception $e) {
    // Manejo de otros posibles errores
    echo "Se produjo un error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/styles_agregar.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Checklist Tracker</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#addTaskModal">Agregar nueva tarea</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#reportModal">Ver Reporte</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="card mt-5">
            <div class="card-body">
                <h2 class="card-title">Tareas</h2>
                <div class="d-flex gap-2 align-items-center py-2">
                    <span>Progreso general:</span>
                    <div class="progress flex-fill" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" style="width: <?php echo $progress; ?>%;"><?php echo number_format((float)$progress, 2, '.', '');; ?>%</div>
                    </div>
                </div>
                <table>
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Fecha compromiso</th>
                            <th>Responsable</th>
                            <th>Tipo de tarea</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tareas_en_progreso as $tarea) { ?>
                            <tr class="bg-warning-subtle">
                                <td><?php echo $tarea['titulo']; ?></td>
                                <td><?php echo $tarea['descripcion']; ?></td>
                                <td><?php echo $tarea['fecha_compromiso']; ?></td>
                                <td><?php echo $tarea['responsable']; ?></td>
                                <td><?php echo $tarea['tipo_tarea']; ?></td>
                                <td><?php echo $tarea['estado']; ?></td>
                                <td class="acciones">
                                    <ul class="nav justify-content-end">
                                        <li class="nav-item">
                                            <a class="nav-link text-success complete-task" href="#" data-task="<?php echo $tarea['id']; ?>"><i data-feather="check-circle"></i> Completar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="editar.php?id=<?php echo $tarea['id']; ?>">Editar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-danger" href="eliminar.php?id=<?php echo $tarea['id']; ?>">Eliminar</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php foreach ($tareas_por_hacer as $tarea) { ?>
                            <tr>
                                <td><?php echo $tarea['titulo']; ?></td>
                                <td><?php echo $tarea['descripcion']; ?></td>
                                <td><?php echo $tarea['fecha_compromiso']; ?></td>
                                <td><?php echo $tarea['responsable']; ?></td>
                                <td><?php echo $tarea['tipo_tarea']; ?></td>
                                <td><?php echo $tarea['estado']; ?></td>
                                <td>
                                    <ul class="nav justify-content-end">
                                        <li class="nav-item">
                                            <a class="nav-link text-primary-emphasis start-task" href="#" data-task="<?php echo $tarea['id']; ?>"><i data-feather="play-circle"></i> Iniciar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="editar.php?id=<?php echo $tarea['id']; ?>">Editar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-danger" href="eliminar.php?id=<?php echo $tarea['id']; ?>">Eliminar</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php } ?>

                        <?php foreach ($tareas_terminadas as $tarea) { ?>
                            <tr class="bg-dark-subtle">
                                <td><?php echo $tarea['titulo']; ?></td>
                                <td><?php echo $tarea['descripcion']; ?></td>
                                <td><?php echo $tarea['fecha_compromiso']; ?></td>
                                <td><?php echo $tarea['responsable']; ?></td>
                                <td><?php echo $tarea['tipo_tarea']; ?></td>
                                <td><?php echo $tarea['estado']; ?></td>
                                <td>
                                    <ul class="nav justify-content-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="editar.php?id=<?php echo $tarea['id']; ?>">Editar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-danger" href="eliminar.php?id=<?php echo $tarea['id']; ?>">Eliminar</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <?php
        include 'agregar_vista.php';
        ?>
    </div>
    <div class="modal" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <?php
        include 'reporte.php';
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        feather.replace();
    </script>
    <script>
        //when button with class .complete-task is clicked post to complete.php with task id as data to complete task.
        document.querySelectorAll('.complete-task').forEach(button => {
            button.addEventListener('click', function() {
                const taskId = this.getAttribute('data-task');
                // add alert to confirm task completion
                if (!confirm('¿Estás seguro de completar la tarea?')) {
                    return;
                }
                fetch('completar.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            id: taskId
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Error completing task');
                        }
                    });
            });
        });
        document.querySelectorAll('.start-task').forEach(button => {
            button.addEventListener('click', function() {
                const taskId = this.getAttribute('data-task');
                // add alert to confirm task completion
                if (!confirm('¿Estás seguro de iniciar la tarea?')) {
                    return;
                }
                fetch('start.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            id: taskId
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Error completing task');
                        }
                    });
            });
        });
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
</body>

</html>