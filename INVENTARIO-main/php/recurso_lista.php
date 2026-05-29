<?php
/**
 * Nombre del fichero: recurso_lista.php
 * Descripción: Genera una lista de recursos con opciones para visualizar, actualizar y eliminar.
 * 
 * Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
 * Fecha: Marzo 2025
 * 
 * Parámetros de entrada: 
 *   - pagina
 *   - registros
 *   - busqueda
 *   - aula_id
 * 
 * Salida: 
 *   - Tabla HTML con la información sobre los recursos.
 *   - Documento XML que contiene los datos de la tabla.
 */

require_once "main.php";

$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
$tabla="";

$campos="recursos.recurso_id,recursos.recurso_codigo, recursos.recurso_descripcion,recursos.estado_id,recursos.recurso_nombre,recursos.precio,recursos.aula_id,aulas.aula_id,recursos.fecha_compra,recursos.fin_garantia, recursos.recurso_foto, aulas.aula_nombre,estado.descripcion";

if(isset($busqueda) && $busqueda!=""){
	$consulta_datos="SELECT $campos FROM recursos INNER JOIN aulas ON recursos.aula_id=aulas.aula_id INNER JOIN estado ON recursos.estado_id=estado.estado_id WHERE recursos.recurso_codigo LIKE '%$busqueda%' OR recursos.recurso_nombre LIKE '%$busqueda%' ORDER BY recursos.recurso_nombre ASC LIMIT $inicio,$registros";

	$consulta_total="SELECT COUNT(recurso_id) FROM recursos WHERE recurso_codigo LIKE '%$busqueda%' OR recurso_nombre LIKE '%$busqueda%'";

}elseif($aula_id>0){

	$consulta_datos="SELECT $campos FROM recursos INNER JOIN aulas ON recursos.aula_id=aulas.aula_id INNER JOIN estado ON recursos.estado_id=estado.estado_id WHERE recursos.aula_id='$aula_id' ORDER BY recursos.recurso_nombre ASC LIMIT $inicio,$registros";

	$consulta_total="SELECT COUNT(recurso_id) FROM recursos WHERE aula_id='$aula_id'";

}else{

	$consulta_datos="SELECT $campos FROM recursos INNER JOIN aulas ON recursos.aula_id=aulas.aula_id INNER JOIN estado ON recursos.estado_id=estado.estado_id ORDER BY recursos.recurso_nombre ASC LIMIT $inicio,$registros";

	$consulta_total="SELECT COUNT(recurso_id) FROM recursos";

}

$conexion=conexion();

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();

$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();

$Npaginas =ceil($total/$registros);

if($total>=1 && $pagina<=$Npaginas){
	$contador=$inicio+1;
	$pag_inicio=$inicio+1;
	foreach($datos as $rows){
		$tabla.='
			<article class="media">
				<figure class="media-left">
					<p class="image is-64x64">';
					if(is_file("./img/recurso/".$rows['recurso_foto'])){
						$tabla.='<img src="./img/recurso/'.$rows['recurso_foto'].'">';
						$camino="./img/recurso/".$rows['recurso_foto'];
					}else{
						$tabla.='<img src="./img/recurso.png">';
					}
					$tabla.='</p>
				</figure>
				
				<div class="media-content">
					<div class="content">
						<p>
						<strong>'.$contador.' - '.$rows['recurso_nombre'].'</strong><br>
						<strong>CODIGO:</strong> '.$rows['recurso_codigo'].', <strong>PRECIO:</strong> $'.$rows['recurso_precio'].', <strong>ESTADO:</strong> '.$rows['recurso_descripcion'].', <strong>UBICACIÓN:</strong> '.$rows['aula_nombre'].'
						</p>
					</div>
					<div class="has-text-right">
						<a href="index.php?vista=resource_img&resource_id_up='.$rows['recurso_id'].'" class="button is-link is-rounded is-small">Imagen</a>
						<a href="index.php?vista=resource_update&resource_id_up='.$rows['recurso_id'].'" class="button is-success is-rounded is-small">Actualizar</a>
						<a href="'.$url.$pagina.'&resource_id_del='.$rows['recurso_id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
					</div>
				</div>
			</article>

			<hr>
		';
		$contador++;
	}
	$pag_final=$contador-1;
}else{
	if($total>=1){
		$tabla.='
			<p class="has-text-centered" >
				<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
					Haga clic aquí para recargar el listado
				</a>
			</p>
		';
	}else{
		$tabla.='
			<p class="has-text-centered" >No hay registros en el sistema</p>
		';
	}
}

if($total>0 && $pagina<=$Npaginas){
	$tabla.='<p class="has-text-right">Mostrando recursos <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
}

$conexion=null;
echo $tabla;

$xml = new DOMDocument("1.0", "UTF-8");

// Creación del elemento raíz
$elementoRaiz = $xml->createElement("recursos");
$xml->appendChild($elementoRaiz);	

foreach($datos as $row){ 
	$i=1;
	$elementoFila = $xml->createElement("recurso");
	$elementoRaiz->appendChild($elementoFila);		
	// Creación de los elementos para cada columna
	$elementoColumna =  $xml->createElement('recurso_id', $row['recurso_id']);
	$elementoFila->appendChild($elementoColumna);
	$elementoColumna =  $xml->createElement('recurso_nombre', $row['recurso_nombre']);
	$elementoFila->appendChild($elementoColumna);
	$elementoColumna =  $xml->createElement('recurso_precio', $row['precio']);
	$elementoFila->appendChild($elementoColumna);
	$elementoColumna =  $xml->createElement('recurso_estado', $row['descripcion']);
	$elementoFila->appendChild($elementoColumna);
	$elementoColumna =  $xml->createElement('recurso_ubicacion', $row['aula_nombre']);
	$elementoFila->appendChild($elementoColumna);
}

$ruta= 'xml/consultas/';

// Comprobar si existe el directorio para guardar el resultado de la consulta y crearlo de no ser así
crear_directorio($ruta);

if ($total > 0) {
	$xml->formatOutput = true;
	$pi = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="../../schemas/estilo_transformacion.xslt"');
	$xml->insertBefore($pi, $xml->documentElement);
	$nombre_xml=nombrar_xml("cons-id-").'.xml';
	$xml->save($ruta.$nombre_xml);			

	echo '
		<div class="has-text-centered">
				<form method="post" action="index.php?vista=xml_display">
					<input type="hidden" name="xml_nombre" value="'.$nombre_xml.'"/><br>
					<button type="submit" class="button is-success is-rounded is-small" title="Visualizar '.$nombre_xml.'">
						Visualizar fichero guardado
					</button>
				</form>
				<br>
		<div>
	';
}

if($total>=1 && $pagina<=$Npaginas){
	echo paginador_tablas($pagina,$Npaginas,$url,7);
}