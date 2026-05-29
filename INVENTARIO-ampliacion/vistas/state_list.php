<?php
// Incluye el archivo que contiene la función de conexión a la base de datos
require_once "./php/main.php";

// Conexión a la base de datos
$conexion = conexion();

// Consulta para obtener todos los estados existentes en la tabla
$consulta = $conexion->query("SELECT * FROM t_estado ORDER BY estado_id ASC");

// Verifica si hay resultados
$estados = $consulta->rowCount() > 0 ? $consulta->fetchAll() : [];

$conexion = null; // Cerramos la conexión
?>

<!-- Encabezado de la sección -->
<div class="container is-fluid mb-6">
    <h1 class="title">Estado</h1>
    <h2 class="subtitle">Listado de estados</h2>
</div>

<!-- Tabla que muestra los estados -->
<div class="container pb-6 pt-6">
    <div class="table-container">
        <table class="table is-bordered is-striped is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Recorre todos los resultados y los muestra en la tabla
                if (count($estados) > 0) {
                    foreach ($estados as $estado) {
                        echo '<tr>';
                        echo '<td>' . $estado['estado_id'] . '</td>';
                        echo '<td>' . $estado['estado_descripcion'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    // Si no hay registros, muestra un mensaje
                    echo '<tr><td colspan="2" class="has-text-centered">No hay estados registrados</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
