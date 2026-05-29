<!--
	* Nombre del fichero: home.php
	* Descripción: Vista principal de la página de inicio
	* 
	* Autor: RetaCantabria - ASIR1 - Dpto. Informática - IES Alisal
	* Fecha: Marzo 2025
	* 
	* Parámetros de entrada: Ninguno
	* Salida: Ninguno
-->

<div class="container is-fluid">
  <div class="history-section">
    <div class="history-content">
      <h1 class="title">I.E.S. Alisal</h1>
      <h2 class="subtitle">¡Bienvenido <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?>!</h2>

      <div class="history-layout">
        <div class="image-box">
          <img src="./img/iesalisal.jpg" alt="Imagen del instituto">
        </div>
        <div class="text-box">
          <p>
            El IES Alisal es un instituto público ubicado en el barrio de El Alisal, en Santander, Cantabria. Desde su fundación en el año 1987, ha ofrecido enseñanzas de Educación Secundaria Obligatoria, Bachillerato y Formación Profesional, destacando especialmente en el ámbito de la informática. Ha sido reconocido por su compromiso con la innovación educativa y la participación activa en proyectos sociales y tecnológicos.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>


