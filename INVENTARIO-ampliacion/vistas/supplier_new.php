<!--
	* Nombre del fichero: supplier_new.php
	* Descripción: Formulario para la creación de un nuevo usuario
	*
	* Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
	* Fecha: Marzo 2025
	*
	* Parámetros de entrada: Ninguno
	* Salida: Ninguno
-->

<div class="container is-fluid mb-6">
	<h1 class="title">Proveedores</h1>
	<h2 class="subtitle">Nuevo proveedor</h2>
</div>

<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/provedor_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
			<div class="column">
				<div class="control">
					<!-- Nombre del proveedor -->
					<label>Nombre</label>
					<input class="input" type="text" name="proveedor_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ ]{3,40}" maxlength="40" placeholder="Cadena de entre 3 y 40 letras con tilde" title="Cadena de entre 3 y 40 letras, acentos, ñ, Ñ, ü y Ü" required />
				</div>
			</div>
			<div class="column">
				<div class="control">
					<!-- Telefono del proveedor -->
					<label>Telefono</label>
                    <input class="input" type="tel" name="telefono_proveedor" pattern="^\+?\d{7,15}$" maxlength="15" placeholder="cadena de numero para teléfono" title="Número de telefono de 7 a 15 dígitos, opcionalmente comenzando con +" required />
				</div>
			</div>
		</div>
			<div class="column">
				<div class="control">
					<!-- Email del proveedor -->
					<label>Email</label>
					<input class="input" type="email" name="proveedor_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}"  maxlength="70"  placeholder="Correo electrónico válido" title="Ingrese un correo electrónico válido" required />
				</div>
			</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>