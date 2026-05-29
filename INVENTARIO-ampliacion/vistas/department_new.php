<!--
	Nuevo departamento
-->


<div class="container is-fluid mb-6">
	<h1 class="title">Departamentos</h1>
	<h2 class="subtitle">Nuevo Departamento</h2>
</div>

<div class="container pb-6 pt-6">

<div class="form-rest mb-6 mt-6"></div>

<form action="./php/departamento_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
	<div class="columns">
		<div class="column">
			<div class="control">
				<!-- Nombre del Departamento -->
				<label>Nombre</label>
				<input class="input" type="text" name="dpto_nombre" pattern="A[0-9]{3}" maxlength="4" placeholder="A[0-9]{3}" required />
			</div>
		</div>
		
		<div class="select is-rounded">
            		<select name="mantenimiento_recurso" >
                		<option value="" selected="" >Seleccione una opción</option>
                		<?php
                			//Conexión a la base de datos y obtención de recursos
                    			$recursos=conexion();
                    			$recursos=$recursos->query("SELECT t_usuario.usuario_id, t_usuario.usuario_nombre, t_usuario.usuario_apellido FROM t_usuario LEFT JOIN t_departamento ON t_usuario.usuario_id = t_departamento.responsable_id WHERE t_departamento.responsable_id IS NULL");
                    			if($recursos->rowCount()>0){
                        			$recursos=$recursos->fetchAll();
                        			foreach($recursos as $row){
                            			echo '<option value="'.$row['usuario_id'].'" >'.$row['usuario_nombre'].' '.$row['usuario_apellido'].'</option>';
                        			}
                    			}
                    			$recursos=null;
                		?>
            		</select>
        	</div>
		
		<div class="column">
			<div class="control">
				<!-- Ubicación del aula -->
				<label>Ubicación</label>
				<input class="input" type="text" name="departamento_ubicacion" pattern="E[0-4]-P[0-3]" maxlength="5" placeholder="Ee-Pp, siendo e={1,2,3,4} y p={1,2,3}" title="EePp, siendo e={1,2,3,4} y p={1,2,3}"/>
			</div>
		</div>

		<div class="column">
			<div class="control">
				<!-- Descripción del departamento -->
				<label>Descripción</label>								
				<input class="input" type="text" name="dpto_descripcion" pattern="[A-Z][a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,24}" maxlength="25" placeholder="[A-Z][a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,24}" title="Cadena de entre 5 y 24 letras o dígitos. empieza por mayúscula"/>
			</div>
		</div>
	</div>

	<p class="has-text-centered">
		<button class="button is-info is-rounded has-text-centered" type="submit">Guardar</button>
	</p>

</form>
</div>
