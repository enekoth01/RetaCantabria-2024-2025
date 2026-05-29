<div class="container is-fluid mb-6">
    <h1 class="title">Mantenimiento</h1>
    <h2 class="subtitle">Nuevo registro</h2>
</div>
<div class="container pb-6 pt-6">
    <?php
        // Requiere el archivo maintenance.php para funciones principales
        require_once "./php/main.php";
    ?>
    <div class="form-rest mb-6 mt-6"></div>
 
    <form action="./php/mantenimiento_guardar.php" method="POST"
        class="FormularioAjax" autocomplete="off"
        enctype="multipart/form-data" onsubmit="return validarFechas()">
   
    <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Recurso</label><br>
                    <div class="select is-rounded">
                        <select name="mantenimiento_recurso" >
                            <option value="" selected="" >Seleccione una opción</option>
                            <?php
                                 //Conexión a la base de datos y obtención de recursos
                                $recursos=conexion();
                                $recursos=$recursos->query("SELECT * FROM t_recurso");
                                if($recursos->rowCount()>0){
                                    $recursos=$recursos->fetchAll();
                                    foreach($recursos as $row){
                                        echo '<option value="'.$row['recurso_id'].'" >'.$row['recurso_nombre'].'</option>';
                                    }
                                }
                                $recursos=null;
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Usuario</label><br>
                    <div class="select is-rounded">
                        <select name="mantenimiento_usuario" >
                            <option value="" selected="" >Seleccione una opción</option>
                            <?php
                                // Conexión a la base de datos y obtención de usuarios
                                $usuarios=conexion();
                                $usuarios=$usuarios->query("SELECT * FROM t_usuario");
                                if($usuarios->rowCount()>0){
                                    $usuarios=$usuarios->fetchAll();
                                    foreach($usuarios as $row){
                                        echo '<option value="'.$row['usuario_id'].'" >'.$row['usuario_nombre']." ".$row['usuario_apellido'].'</option>';
                                    }
                                }
                                $usuarios=null;
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Fecha de mantenimiento</label><br>
                    <input type="datetime-local" name="mantenimiento_fecha" min="2022-01-01T07:00" max="<?php echo $currentDateTime ?>"  required />
                </div>
            </div>
       
        <div class="has-text-centered">
            <div class="control">
                <!-- Descripción del aula -->
                <label>Descripción</label>                              
                <textarea name="mantenimiento_descripcion" rows="4" cols="50" pattern="[A-Z][a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,24}" maxlength="100" placeholder="[A-Z][a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,24}" title="Cadena de entre 5 y 100 letras o dígitos. empieza por mayúscula" required></textarea>
            </div>
        </div>
    </div>
 
        <p class="has-text-centered">
            <button type="submit" class="button is-info is-rounded">Guardar</button>
        </p>
    </form>
</div>