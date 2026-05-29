<div class="container is-fluid mb-6">
    <h1 class="title">Mantenimiento de recursos</h1>
    <h2 class="subtitle">Buscar mantenimiento</h2>
</div>
 
<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php"; // Cargar funciones principales
 
        if(isset($_POST['modulo_buscador'])){
            require_once "./php/buscador.php"; // Cargar módulo de búsqueda
        }
 
        if(!isset($_SESSION['busqueda_mantenimiento']) && empty($_SESSION['busqueda_mantenimiento'])){
    ?>
    <div class="columns">
        <div class="column">
            <form action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="mantenimiento">
                <div class="field is-grouped">
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="text" name="txt_buscador" placeholder="¿Qué estás buscando?" title="Introduce el nombre o código de un recurso o el nombre, apellido, usuario o email de un usuario"
                            pattern="[A-Z]{3}-[0-9]{4}|[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,50}|[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ ]{3,40}|[a-z0-9]{4,20}|[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}" maxlength="70" >
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
                <input type="hidden" name="modulo_buscador" value="mantenimiento">
                <input type="hidden" name="eliminar_buscador" value="mantenimiento">
                <p>Estas buscando <strong>"<?php echo $_SESSION['busqueda_mantenimiento']; ?>"</strong></p>
                <br>
                <button type="submit" class="button is-danger is-rounded">Eliminar busqueda</button>
            </form>
        </div>
    </div>
   <?php
            // Eliminar mantenimiento
            if(isset($_GET['maintenance_id_del'])){
                require_once "./php/mantenimiento_eliminar.php"; // Cargar script para eliminar mantenimiento
            }
 
            // Paginación
            if(!isset($_GET['page'])){
                $pagina=1;
            }else{
                $pagina=(int) $_GET['page'];
                if($pagina<=1){
                    $pagina=1;
                }
            }
 
            $pagina=limpiar_cadena($pagina);
            $url="index.php?vista=maintenance_search&page="; // URL para la paginación
            $registros=15;
            $busqueda=$_SESSION['busqueda_mantenimiento']; // Texto de búsqueda
 
            // Paginador mantenimiento
            require_once "./php/mantenimiento_lista.php"; // Cargar lista de mantenimiento
        }
    ?>
</div>