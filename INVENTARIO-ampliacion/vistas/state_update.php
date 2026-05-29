<?php
// Incluye funciones y conexión a la base de datos
require_once "./php/main.php";

// Conexión a la base de datos
$conexion = conexion();

// Consulta para obtener todos los estados existentes
$consulta = $conexion->query("SELECT * FROM t_estado ORDER BY estado_id ASC");

// Verifica si hay resultados
$estados = $consulta->rowCount() > 0 ? $consulta->fetchAll() : [];

$conexion = null; // Cerramos la conexión
?>

<!-- Encabezado -->
<div class="container is-fluid mb-6">
    <h1 class="title">Estado</h1>
    <h2 class="subtitle">Actualizar estado</h2>
</div>

<!-- Formulario para seleccionar el estado a actualizar -->
<div class="container pb-6 pt-6">
    <form action="./php/estado_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

        <!-- Selección del estado a editar -->
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label for="estado_id">Selecciona un estado</label>
                    <div class="select is-rounded">
                        <select name="estado_id" id="estado_id" required>
                            <option value="">Seleccione una opción</option>
                            <?php
                            // Genera las opciones del select con los estados disponibles
                            foreach ($estados as $estado) {
                                echo '<option value="' . $estado['estado_id'] . '">' . $estado['estado_descripcion'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nuevo valor para la descripción -->
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label for="estado_nuevo">Nueva descripción</label>
                    <input class="input" type="text" name="estado_nuevo" id="estado_nuevo"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]{5,30}"
                        maxlength="30"
                        placeholder="Ej: En servicio"
                        title="Solo letras, entre 5 y 30 caracteres"
                        required>
                </div>
            </div>
        </div>

        <!-- Botón para guardar los cambios -->
        <br>
        <p class="has-text-centered">
            <button type="submit" class="button is-success is-rounded">Actualizar</button>
        </p>
    </form>
</div>
