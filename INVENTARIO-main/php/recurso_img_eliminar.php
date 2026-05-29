<?php
    /**
     * Nombre del fichero: recurso_img_eliminar.php
     * Descripción: Elimina la imagen de un recurso en la base de datos y en el sistema de archivos.
     *
     * Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
     * Fecha: Marzo 2025
     * 
     * Parámetros de entrada: 
     *   - img_del_id: ID de la imagen a eliminar.
     * 
     * Salida: 
     *   - Notificación del resultado de la operación
     */

    require_once "main.php";

    // Almacenando datos
    $resource_id = limpiar_cadena($_POST['img_del_id']);

    // Verificando recurso
    $check_recurso = conexion();
    $check_recurso = $check_recurso->query("SELECT * FROM t_recurso WHERE recurso_id='$resource_id'");

    if ($check_recurso->rowCount() == 1) {
        $datos = $check_recurso->fetch();
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen del recurso que intenta eliminar no existe
            </div>
        ';
        exit();
    }
    $check_recurso = null;

    // Directorios de imagenes
    $img_dir = '../img/recurso/';

    // Cambiando permisos al directorio
    chmod($img_dir, 0777);

    // Eliminando la imagen
    if (is_file($img_dir . $datos['recurso_foto'])) {

        chmod($img_dir . $datos['recurso_foto'], 0777);

        if (!unlink($img_dir . $datos['recurso_foto'])) {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    Error al intentar eliminar la imagen del recurso, por favor intente nuevamente
                </div>
            ';
            exit();
        }
    }

    // Actualizando datos
    $actualizar_recurso = conexion();
    $actualizar_recurso = $actualizar_recurso->prepare("UPDATE t_recurso SET recurso_foto=:foto WHERE recurso_id=:id");

    $marcadores = [
        ":foto" => "",
        ":id" => $resource_id
    ];

    if ($actualizar_recurso->execute($marcadores)) {
        echo '
            <div class="notification is-info is-light">
                <strong>¡IMAGEN O FOTO ELIMINADA!</strong><br>
                La imagen del recurso ha sido eliminada exitosamente, pulse Aceptar para recargar los cambios.

                <p class="has-text-centered pt-5 pb-5">
                    <a href="index.php?vista=resource_img&resource_id_up=' . $resource_id . '" class="button is-link is-rounded">Aceptar</a>
                </p">
            </div>
        ';
    } else {
        echo '
            <div class="notification is-warning is-light">
                <strong>¡IMAGEN O FOTO ELIMINADA!</strong><br>
                Ocurrieron algunos inconvenientes, sin embargo la imagen del recurso ha sido eliminada, pulse Aceptar para recargar los cambios.

                <p class="has-text-centered pt-5 pb-5">
                    <a href="index.php?vista=resource_img&resource_id_up=' . $resource_id . '" class="button is-link is-rounded">Aceptar</a>
                </p">
            </div>
        ';
    }
    $actualizar_recurso = null;
?>