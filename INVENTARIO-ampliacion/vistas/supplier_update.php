<!--
	* Nombre del fichero: supplier_update.php
	* Descripción: Actualiza los datos de un recurso en la base de datos.
	*
	* Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
	* Fecha: Marzo 2025
	*
	* Parámetros de entrada: proveedor_id_up (ID del proveedor a actualizar)
	* Salida: Ninguno
-->

<div class="container is-fluid mb-6">
	<h1 class="title">Proveedores</h1>
	<h2 class="subtitle">Actualizar proveedor</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";
		require_once "./php/main.php";

		$id = isset($_GET['proveedor_id_up']) ? limpiar_cadena($_GET['proveedor_id_up']) : 0;

		// Verificando recurso
		$check_recurso = conexion();
		$check_recurso = $check_recurso->query("SELECT * FROM t_proveedor WHERE proveedor_id='$id'");

		if($check_recurso->rowCount() > 0){
			$datos = $check_recurso->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<h2 class="title has-text-centered"><?php echo $datos['proveedor_nombre']; ?></h2>

	<form action="./php/proveedor_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

		<input type="hidden" name="proveedor_id" value="<?php echo $datos['proveedor_id']; ?>" required>

		<div class="columns">
			<div class="column">
				<div class="control">
					<label>Código</label>
					<input class="input" type="text" name="proveedor_codigo" pattern="[A-Z]{3}-[0-9]{4}" maxlength="8" required value="<?php echo $datos['proveedor_codigo']; ?>">
				</div>
			</div>
			<div class="column">
				<div class="control">
					<label>Nombre</label>
					<input class="input" type="text" name="proveedor_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,50}" maxlength="50" required value="<?php echo $datos['proveedor_nombre']; ?>">
				</div>
			</div>
		</div>

		<div class="columns">
			<div class="column">
				<div class="control">
					<label>Email</label>
					<input class="input" type="email" name="proveedor_email" maxlength="70" value="<?php echo $datos['proveedor_email']; ?>">
				</div>
			</div>
			<div class="column">
				<div class="control">
					<label>Teléfono</label>
					<input class="input" type="tel" name="telefono_proveedor" pattern="^\+?\d{7,15}$" maxlength="15" placeholder="Número de teléfono" title="Número de teléfono de 7 a 15 dígitos, opcionalmente comenzando con +" value="<?php echo $datos['proveedor_telefono']; ?>" required>
				</div>
			</div>
		</div>

		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>

	<?php 
		} else {
			include "./inc/error_alert.php";
		}
		$check_recurso = null;
	?>
</div>