<?php
	/**
	 * Nombre del fichero: aula_lista.php
	 * Descripción: Este script genera una lista de aulas con opciones para ver recursos, actualizar y eliminar.
	 *
	 * Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
	 * Fecha: Marzo 2025
	 *
	 * Parámetros de entrada: 
	 *   - $pagina 
	 *   - $registros 
	 *   - $busqueda 
	 *   - $url
	 *
	 *  Salida: 
	 *   - HTML con la tabla de aulas
	 */

	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	if(isset($busqueda) && $busqueda!=""){

		// Consulta para obtener los datos de las aulas según la búsqueda
		$consulta_datos="SELECT * FROM t_aula WHERE aula_nombre LIKE '%$busqueda%' OR aula_ubicacion LIKE '%$busqueda%' ORDER BY aula_nombre ASC LIMIT $inicio,$registros";

		// Consulta para obtener el total de aulas según la búsqueda
		$consulta_total="SELECT COUNT(aula_id) FROM t_aula WHERE aula_nombre LIKE '%$busqueda%' OR aula_ubicacion LIKE '%$busqueda%'";

	}else{

		// Consulta para obtener todos los datos de las aulas
		$consulta_datos="SELECT * FROM t_aula ORDER BY aula_nombre ASC LIMIT $inicio,$registros";

		// Consulta para obtener el total de aulas
		$consulta_total="SELECT COUNT(aula_id) FROM t_aula";
		
	}

	$conexion=conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);

	$tabla.='
	<div class="table-container">
		<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
			<thead>
				<tr class="has-text-centered">
					<th>#</th>
					<th>Nombre</th>
					<th>Ubicación</th>
					<th>Descripción</th>
					<th>Recursos</th>
					<th colspan="2">Opciones</th>
				</tr>
			</thead>
			<tbody>
	';

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			$tabla.='
				<tr class="has-text-centered" >
					<td>'.$contador.'</td>
					<td>'.$rows['aula_nombre'].'</td>
					<td>'.substr($rows['aula_ubicacion'],0,14).'</td>
					<td>'.substr($rows['aula_descripcion'],0,25).'</td>
					<td>
						<a href="index.php?vista=resource_room&room_id='.$rows['aula_id'].'" class="button is-link is-rounded is-small">Ver recursos</a>
					</td>
					<td>
						<a href="index.php?vista=room_update&room_id_up='.$rows['aula_id'].'" class="button is-success is-rounded is-small">Actualizar</a>
					</td>
					<td>
						<a href="'.$url.$pagina.'&room_id_del='.$rows['aula_id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
					</td>
				</tr>
			';
			$contador++;
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="5">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="5">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}

	$tabla.='</tbody></table></div>';

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando aulas <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;
	// Se crea un nuevo documento XML

	$xml = new DOMDocument("1.0", "UTF-8");

	// Creación del elemento raíz
	$elementoRaiz = $xml->createElement("aulas");
	$xml->appendChild($elementoRaiz);	

	foreach($datos as $row){ 
		$i=1;
		$elementoFila = $xml->createElement("aula");
		$elementoRaiz->appendChild($elementoFila);
		// Creación de los elementos para cada columna
		$elementoColumna =  $xml->createElement('aula_id', $row['aula_id']);
		$elementoFila->appendChild($elementoColumna);
		$elementoColumna =  $xml->createElement('aula_nombre', $row['aula_nombre']);
		$elementoFila->appendChild($elementoColumna);
		$elementoColumna =  $xml->createElement('aula_ubicacion', $row['aula_ubicacion']);
		$elementoFila->appendChild($elementoColumna);
		$elementoColumna =  $xml->createElement('aula_descripcion', $row['aula_descripcion']);
		$elementoFila->appendChild($elementoColumna);
	}

	$ruta= 'xml/consultas/aulas/';

	// Comprobar si existe el directorio para guardar el resultado de la consulta y crearlo de no ser así
	crear_directorio($ruta);

	if ($total > 0) {
		$xml->formatOutput = true;
		$pi = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="../../xslt/aulas.xslt"');
		$xml->insertBefore($pi, $xml->documentElement);
		$nombre_xml=nombrar_xml("cons-mantenimientos-id-").'.xml';
		$xml->save($ruta.$nombre_xml);

		echo '
			<div class="has-text-centered">
					<form method="post" action="index.php?vista=xml_display_aulas">
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
	