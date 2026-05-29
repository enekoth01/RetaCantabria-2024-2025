<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" encoding="UTF-8" indent="yes"/>

  <xsl:template match="/aulas">
    <html>
      <head>
        <title>Lista de Aulas</title>
        <link rel="stylesheet" type="text/css" href="../../css/estilos.css"/>
                <meta charset="UTF-8"/>
      </head>
      <body>
        <h1>Lista de Aulas</h1>
        <table border="1" class="tabla-mantenimientos">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ubicación</th>
            <th>Descripción</th>
          </tr>
          <xsl:for-each select="aula">
            <tr>
              <td><xsl:value-of select="aula_id"/></td>
              <td><xsl:value-of select="aula_nombre"/></td>
              <td><xsl:value-of select="aula_ubicacion"/></td>
              <td><xsl:value-of select="aula_descripcion"/></td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>