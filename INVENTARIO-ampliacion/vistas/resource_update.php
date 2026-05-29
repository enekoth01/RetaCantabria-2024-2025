<!--
	* Nombre del fichero: resource_update.php
	* Descripción: Actualiza los datos de un recurso en la base de datos.
	*
	* Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
	* Fecha: Marzo 2025
	*
	* Parámetros de entrada: resource_id_up (ID del recurso a actualizar)
	* Salida: Ninguno
-->

<div class="container is-fluid mb-6">
	<h1 class="title">Recursos</h1>
	<h2 class="subtitle">Actualizar recurso</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['resource_id_up'])) ? $_GET['resource_id_up'] : 0;
		$id=limpiar_cadena($id);

		// Verificando recurso
		$check_recurso=conexion();
		$check_recurso=$check_recurso->query("SELECT * FROM t_recurso WHERE recurso_id='$id'");

		if($check_recurso->rowCount()>0){
			$datos=$check_recurso->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<h2 class="title has-text-centered"><?php echo $datos['recurso_nombre']; ?></h2>

	<form action="./php/recurso_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="recurso_id" value="<?php echo $datos['recurso_id']; ?>" required >

		<div class="columns">
			<div class="column">
				<div class="control">
					<label>Código</label>
					<input class="input" type="text" name="recurso_codigo" pattern="[A-Z]{3}-[0-9]{4}" maxlength="8" required value="<?php echo $datos['recurso_codigo']; ?>" >
				</div>
			</div>
			<div class="column">
				<div class="control">
					<label>Nombre</label>
					<input class="input" type="text" name="recurso_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,50}" maxlength="50" required value="<?php echo $datos['recurso_nombre']; ?>" >
				</div>
			</div>
		</div>
		<div class="columns">
			<div class="column">
				<div class="control">
					<label>Precio</label>
					<input class="input" type="text" name="recurso_precio" pattern="[0-9.]{1,25}" maxlength="25" required value="<?php echo $datos['recurso_precio']; ?>" >
				</div>
			</div>
			<div class="column">
				<label>Aula</label><br>
				<div class="select is-rounded">
					<select name="recurso_aula" >
						<?php
							$aulas=conexion();
							$aulas=$aulas->query("SELECT * FROM t_aula");
							if($aulas->rowCount()>0){
								$aulas=$aulas->fetchAll();
								foreach($aulas as $row){
									if($datos['aula_id']==$row['aula_id']){
										echo '<option value="'.$row['aula_id'].'" selected="" >'.$row['aula_nombre'].' (Actual)</option>';
									}else{
										echo '<option value="'.$row['aula_id'].'" >'.$row['aula_nombre'].'</option>';
									}
								}
							}
							$aulas=null;
						?>
					</select>
				</div>
			</div>

			<div class="column">
				<label>Estado</label><br>
				<div class="select is-rounded">
					<select name="recurso_estado" >
						<?php
							$estados=conexion();
							$estados=$estados->query("SELECT * FROM t_estado");
							if($estados->rowCount()>0){
								$estados=$estados->fetchAll();
								foreach($estados as $row){
									if($datos['estado_id']==$row['estado_id']){
										echo '<option value="'.$row['estado_id'].'" selected="" >'.$row['estado_descripcion'].' (Actual)</option>';
									}else{
										echo '<option value="'.$row['estado_id'].'" >'.$row['estado_descripcion'].'</option>';
									}
								}
							}
							$estados=null;
						?>
					</select>
				</div>
			</div>
		</div>

		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_recurso=null;
	?>
</div>