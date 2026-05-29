<!-- 
    * Nombre del fichero: resource_upload_file.php
    * Descripción: Formulario para cargar recursos de modo masivo mediante un archivo XML.
    * 
    * Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
    * Fecha: Marzo 2025
    * 
    * Parámetros de entrada: 
    *   - archivo XML con la estructura de los recursos a cargar)
    *
    * Salida: Ninguno
-->


<div class="container is-fluid mb-6">
	<h1 class="title">Recursos</h1>
	<h2 class="subtitle">Cargar recursos de modo masivo</h2>
</div>

<div class="container pb-6 pt-6">
    <div class="form-rest mb-6 mt-6"></div>
    <form action="./php/recurso_cargar_masivo.php" method="post" class="FormularioAjax" enctype="multipart/form-data">
        <div class="control">
            <label for="xml_file">Selecciona el archivo XML:</label>
            <div class="file is-small has-name">
                <label class="file-label">
                    <input class="file-input" type="file" name="xml_recursos" accept=".xml" required>
                    <span class="file-cta">
                        <span class="file-label">Fichero</span>
                    </span>
                    <span class="file-name">.XML (MAX 500 KB)</span>
                </label>
            </div>
        </div>
        <p class="has-text-centered">
            <br>
            <button class="button is-info is-rounded" type="submit">Cargar Recursos</button>     
        </p>   
    </form>
</div>