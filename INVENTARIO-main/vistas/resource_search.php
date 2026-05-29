<!--
    * Nombre del fichero: resource_search.php
    * Descripción: Página para buscar y gestionar recursos.
    *
    * Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
    * Fecha: Marzo 2025
    *
    * Parámetros de entrada: 
    *   - modulo_buscador (POST)
    *   - busqueda_recurso (SESSION)
    *   - resource_id_del (GET)
    *   - page (GET)
    *   - room_id (GET)
    *
    * Salida: Ninguno
-->



<div class="container is-fluid mb-6">
	<h1 class="title">Recursos</h1>
	<h2 class="subtitle">Buscar recurso</h2>

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        // Verificar si se ha enviado el formulario de búsqueda
        if(isset($_POST['modulo_buscador'])){
            require_once "./php/buscador.php";
        }

        // Verificar si no hay una búsqueda activa
        if(!isset($_SESSION['busqueda_recurso']) && empty($_SESSION['busqueda_recurso'])){
    ?>
    <div class="columns">
        <div class="column">
            <form action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="recurso">
                <div class="field is-grouped">
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="text" name="txt_buscador" placeholder="¿Qué estas buscando?" title="Introduce el código o nombre de un recurso" pattern="[A-Z]{3}-[0-9]{4}|[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,50}" maxlength="50" >
                    </p>
                    <p class="control">
                        <button class="button is-info is-rounded" type="submit" >Buscar</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <?php }else{ ?>
    <div class="columns">
        <div class="column">
            <form class="has-text-centered mt-6 mb-6" action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="recurso"> 
                <input type="hidden" name="eliminar_buscador" value="recurso">
                <p>Estas buscando <strong>"<?php echo $_SESSION['busqueda_recurso']; ?>"</strong></p>
                <br>
                <button type="submit" class="button is-danger is-rounded">Eliminar busqueda</button>
            </form>
        </div>
    </div>
    <?php
            // Eliminar recurso
            if(isset($_GET['resource_id_del'])){
                require_once "./php/recurso_eliminar.php";
            }

            // Verificar la página actual
            if(!isset($_GET['page'])){
                $pagina=1;
            }else{
                $pagina=(int) $_GET['page'];
                if($pagina<=1){
                    $pagina=1;
                }
            }

            $aula_id = (isset($_GET['room_id'])) ? $_GET['room_id'] : 0;

            $pagina=limpiar_cadena($pagina);
            $url="index.php?vista=resource_search&page="; // URL base para el paginador
            $registros=15;
            $busqueda=$_SESSION['busqueda_recurso']; // Término de búsqueda

            // Paginador recurso
            require_once "./php/recurso_lista.php";
        } 
    ?>
</div>
</div>
