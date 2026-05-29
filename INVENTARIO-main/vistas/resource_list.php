<!--
    * Nombre del fichero: resource_list.php
    * Descripción: Lista de recursos disponibles.
    *
    * Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
    * Fecha: Marzo 2025
    *
    * Parámetros de entrada: 
    *    - resource_id_del (opcional): ID del recurso a eliminar.
    *    - page (opcional): Número de página para la paginación.
    *    - room_id (opcional): ID del aula para filtrar los recursos.
    *
    * Salida: Ninguno
-->

<div class="container is-fluid mb-6">
    <h1 class="title">Recursos</h1>
    <h2 class="subtitle">Lista de recursos</h2>


<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        // Eliminar recurso
        if(isset($_GET['resource_id_del'])){
            require_once "./php/recurso_eliminar.php";
        }

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
        $url="index.php?vista=resource_list&page="; // <==
        $registros=15;
        $busqueda="";

        // Paginador recurso
        require_once "./php/recurso_lista.php";
    ?>
</div>
</div>