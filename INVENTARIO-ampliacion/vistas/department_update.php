<!--
	Actualizar departamento
-->

<div class="container is-fluid mb-6">
	<h1 class="title">Departamentos</h1>
	<h2 class="subtitle">Actualizar Departamento</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['dpto_id_up'])) ? $_GET['dpto_id_up'] : 0;
		$id=limpiar_cadena($id);

		// Verificando departamento
		$check_departamento=conexion();
		$check_departamento=$check_departamento->query("SELECT * FROM t_departamento WHERE t_departamento.departamento_id='$id'");

		if($check_departamento->rowCount()>0){
			$datos=$check_departamento->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<h2 class="title has-text-centered"><?php echo $datos['departamento_nombre']; ?></h2>

	<form action="./php/departamento_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="departamento_id" value="<?php echo $datos['departamento_id']; ?>" required >

		<div class="columns">
			<div class="column">
				<div class="control">
					<label>Nombre</label>
					<input class="input" type="text" name="departamento_nombre" pattern="A[0-9]{3}" maxlength="4" required value="<?php echo $datos['departamento_nombre']; ?>" >
				</div>
			</div>
			<div class="column">
				<div class="control">
					<label>Ubicación</label>
					<input class="input" type="text" name="departamento_ubicacion" pattern="E[0-4]-P[0-3]" maxlength="5" placeholder="Ee-Pp, siendo e={1,2,3,4} y p={1,2,3}" title="EePp, siendo e={1,2,3,4} y p={1,2,3}" value="<?php echo $datos['departamento_ubicacion']; ?>" >
				</div>
			</div>
			<div class="column">
				<div class="control">
					<label>Descripción</label>
					<input class="input" type="text" name="departamento_descripcion" pattern="[A-Z][a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,24}" maxlength="25" value="<?php echo $datos['departamento_descripcion']; ?>" placeholder="[A-Z][a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,24}" title="Cadena de entre 5 y 24 letras o dígitos. empieza por mayúscula" >
				</div>
			</div>

		</div>
		<p class="has-text-centered">
			<button type="submit" class="ana-color">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_departamento=null;
	?>
</div>