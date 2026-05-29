<!--
	* Nombre del fichero: resource_img.php
	* Descripción: Actualizar imagen de recurso
	*
	* Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
	* Fecha: Marzo 2025
	*
	* Parámetros de entrada: 
	*	- resource_id_up (GET)
	*
	* Salida: Ninguno
-->


<div class="container is-fluid mb-6">
	<h1 class="title">Recursos</h1>
	<h2 class="subtitle">Actualizar imagen de recurso</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['resource_id_up'])) ? $_GET['resource_id_up'] : 0;

		// Verificando recurso
		$check_recurso=conexion();
		$check_recurso=$check_recurso->query("SELECT * FROM t_recurso WHERE recurso_id='$id'");

		if($check_recurso->rowCount()>0){
			$datos=$check_recurso->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<div class="columns">
		<div class="column is-two-fifths">
			<?php if(is_file("./img/recurso/".$datos['recurso_foto'])){ ?>
			<figure class="image mb-6">
				<img src="./img/recurso/<?php echo $datos['recurso_foto']; ?>">
			</figure>
			<form class="FormularioAjax" action="./php/recurso_img_eliminar.php" method="POST" autocomplete="off" >

				<input type="hidden" name="img_del_id" value="<?php echo $datos['recurso_id']; ?>">

				<p class="has-text-centered">
					<button type="submit" class="button is-danger is-rounded">Eliminar imagen</button>
				</p>
			</form>
			<?php }else{ ?>
			<figure class="image mb-6">
				<img src="./img/recurso.png">
			</figure>
			<?php } ?>
		</div>
		<div class="column">
			<form class="mb-6 has-text-centered FormularioAjax" action="./php/recurso_img_actualizar.php" method="POST" enctype="multipart/form-data" autocomplete="off" >

				<h4 class="title is-4 mb-6"><?php echo $datos['recurso_nombre']; ?></h4>
				
				<label>Foto o imagen del recurso</label><br>

				<input type="hidden" name="img_up_id" value="<?php echo $datos['recurso_id']; ?>">

				<div class="file has-name is-horizontal is-justify-content-center mb-6">
					<label class="file-label">
						<input class="file-input" type="file" name="recurso_foto" accept=".jpg, .png, .jpeg" >
						<span class="file-cta">
							<span class="file-label">Imagen</span>
						</span>
						<span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
					</label>
				</div>
				<p class="has-text-centered">
					<button type="submit" class="button is-success is-rounded">Actualizar</button>
				</p>
			</form>
		</div>
	</div>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_recurso=null;
	?>
</div>
