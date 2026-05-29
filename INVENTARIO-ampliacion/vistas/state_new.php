<?php
// Incluye el archivo con la conexión a la base de datos y funciones comunes
require_once "./php/main.php";
?>

<!-- Encabezado del formulario -->
<div class="container is-fluid mb-6">
    <h1 class="title">Estado</h1>
    <h2 class="subtitle">Nuevo registro</h2>
</div>

<!-- Contenedor del formulario -->
<div class="container pb-6 pt-6">

    <!-- Aquí aparecerán los mensajes de resultado del formulario (éxito o error) -->
    <div class="form-rest mb-6 mt-6"></div>

    <!-- Formulario para enviar un nuevo estado -->
    <!-- 
        action: archivo PHP que guardará el nuevo estado en la base de datos
        method: POST para enviar los datos
        class="FormularioAjax": indica que usará AJAX si está implementado
        autocomplete="off": evita autocompletado del navegador
    -->
    <form action="./php/estado_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">

        <!-- Campo de texto para escribir la descripción del nuevo estado -->
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                <div class="control">
                    <label for="estado_descripcion">Descripción del estado</label>
                    <input class="input" type="text" name="estado_descripcion" id="estado_descripcion"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]{5,30}" 
                        maxlength="30"
                        placeholder="Ej: En servicio"
                        title="Solo letras, entre 5 y 30 caracteres"
                        required>
                </div>
            </div>
        </div>

        <!-- Botón para guardar el nuevo estado -->
        <br>
        <p class="has-text-centered">
            <button type="submit" class="button is-info is-rounded">Guardar</button>
        </p>
    </form>
</div>
