<!--
    Listar departamentos
    He hecho predict del nombre de lo parametros y archivos (a espera de que Ana suba la parte de la lógica).
    Si necesito cambiarlo porque no encaja el nombre lo cambiare.
-->


<div class="container is-fluid mb-6">
    <h1 class="title">Departamentos</h1>
    <h2 class="subtitle">Lista de departamentos</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        // Eliminar aula
        if(isset($_GET['department_id_del'])){
            require_once "./php/departamento_eliminar.php";
        }

        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=department_list&page=";
        $registros=15;
        $busqueda="";

        // Paginador aula
        require_once "./php/departamento_lista.php";
    ?>
</div>