<?php
// Incluye la conexión y funciones comunes
require_once "./php/main.php";
?>

<!-- Encabezado -->
<div class="container is-fluid mb-6">
    <h1 class="title">Estado</h1>
    <h2 class="subtitle">Buscar estado</h2>
</div>

<!-- Formulario de búsqueda -->
<div class="container pb-6 pt-6">
    <form method="GET" autocomplete="off">
        <div class="columns">
            <div class="column is-6 is-offset-3">
                <div class="field has-addons">
                    <!-- Campo de texto para ingresar búsqueda -->
                    <div class="control is-expanded">
                        <input class="input" type="text" name="buscar_estado"
                               placeholder="Buscar por descripción (Ej: En servicio, En reserva...)"
                               pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]{3,30}" 
                               maxlength="30"
                               title="Introduce entre 3 y 30 letras">
                    </div>
                    <!-- Botón de búsqueda -->
                    <div class="control">
                        <button type="submit" class="button is-info">
                            Buscar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <br>

    <!-- Sección de resultados -->
    <?php
    // Verificamos si hay una búsqueda
    if (isset($_GET['buscar_estado']) && !empty(trim($_GET['buscar_estado']))) {
        // Limpiar la entrada para evitar inyecciones
        $busqueda = limpiar_cadena($_GET['buscar_estado']);

        // Conexión a la base de datos
        $conexion = conexion();

        // Consulta con búsqueda parcial usando LIKE
        $consulta = $conexion->prepare("SELECT * FROM t_estado 
                                        WHERE estado_descripcion 
                                        LIKE :busqueda 
                                        ORDER BY estado_id ASC");

        // Se pasa la búsqueda con comodines
        $consulta->execute([':busqueda' => "%$busqueda%"]);

        $resultados = $consulta->fetchAll();
        $conexion = null;

        if (count($resultados) > 0) {
            echo '<div class="table-container">';
            echo '<table class="table is-bordered is-hoverable is-fullwidth">';
            echo '<thead><tr><th>ID</th><th>Descripción</th></tr></thead><tbody>';

            // Mostrar resultados en la tabla
            foreach ($resultados as $estado) {
                echo '<tr>';
                echo '<td>' . $estado['estado_id'] . '</td>';
                echo '<td>' . $estado['estado_descripcion'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody></table></div>';
        } else {
            echo '<p class="has-text-centered has-text-grey">No se encontraron resultados.</p>';
        }
    }
    ?>
</div>
