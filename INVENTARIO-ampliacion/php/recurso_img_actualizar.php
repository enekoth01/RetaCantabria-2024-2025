<?php
    /**
     * Nombre del fichero: recurso_img_actualizar.php
     * Descripción: Actualiza la imagen de un recurso en la base de datos.
     * 
     * Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
     * Fecha: Marzo 2025
     * 
     * Parámetros de entrada: 
     *   - img_up_id: ID del recurso a actualizar (POST)
     *   - recurso_foto: Archivo de imagen a subir (FILES)
     * 
     * Salida: 
     *   - Mensaje de éxito o error en formato HTML
     */

    require_once "main.php";

    // Almacenando datos
    $resource_id=limpiar_cadena($_POST['img_up_id']);

    // Verificando recurso
    $check_recurso=conexion();
    $check_recurso=$check_recurso->query("SELECT * FROM t_recurso WHERE recurso_id='$resource_id'");

    if($check_recurso->rowCount()==1){
        $datos=$check_recurso->fetch();
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen del recurso que intenta actualizar no existe
            </div>
        ';
        exit();
    }
    $check_recurso=null;

    // Comprobando si se ha seleccionado una imagen
    if($_FILES['recurso_foto']['name']=="" || $_FILES['recurso_foto']['size']==0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No ha seleccionado ninguna imagen o foto
            </div>
        ';
        exit();
    }

    // Directorios de imagenes
    $img_dir='../img/recurso/';

    // Comprobar si existe el directorio para guardar imágenes y crearlo de no ser así
    crear_directorio($img_dir);

    // Cambiando permisos al directorio
    chmod($img_dir, 0777);

    // Comprobando formato de las imagenes
    if(mime_content_type($_FILES['recurso_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['recurso_foto']['tmp_name'])!="image/png"){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen que ha seleccionado es de un formato que no está permitido
            </div>
        ';
        exit();
    }

    // Comprobando que la imagen no supere el peso permitido
    if(($_FILES['recurso_foto']['size']/1024)>3072){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen que ha seleccionado supera el límite de peso permitido
            </div>
        ';
        exit();
    }

    // Extensión de las imagenes
    switch(mime_content_type($_FILES['recurso_foto']['tmp_name'])){
        case 'image/jpeg':
            $img_ext=".jpg";
        break;
        case 'image/png':
            $img_ext=".png";
        break;
    }

    // Nombre de la imagen
    $img_nombre=renombrar_fotos($datos['recurso_nombre']);

    // Nombre final de la imagen
    $foto=$img_nombre.$img_ext;

    // Moviendo imagen al directorio
    if(!move_uploaded_file($_FILES['recurso_foto']['tmp_name'], $img_dir.$foto)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
            </div>
        ';
        exit();
    }

    // Eliminando la imagen anterior
    if(is_file($img_dir.$datos['recurso_foto']) && $datos['recurso_foto']!=$foto){
        chmod($img_dir.$datos['recurso_foto'], 0777);
        unlink($img_dir.$datos['recurso_foto']);
    }

    // Actualizando datos
    $actualizar_recurso=conexion();
    $actualizar_recurso=$actualizar_recurso->prepare("UPDATE t_recurso SET recurso_foto=:foto WHERE recurso_id=:id");

    $marcadores=[
        ":foto"=>$foto,
        ":id"=>$resource_id
    ];

    if($actualizar_recurso->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡IMAGEN O FOTO ACTUALIZADA!</strong><br>
                La imagen del recurso ha sido actualizada exitosamente, pulse Aceptar para recargar los cambios.

                <p class="has-text-centered pt-5 pb-5">
                    <a href="index.php?vista=resource_img&resource_id_up='.$resource_id.'" class="button is-link is-rounded">Aceptar</a>
                </p">
            </div>
        ';
    }else{

        if(is_file($img_dir.$foto)){
            chmod($img_dir.$foto, 0777);
            unlink($img_dir.$foto);
        }

        echo '
            <div class="notification is-warning is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_recurso=null;
?>