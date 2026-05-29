<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" indent="yes"/>

  <xsl:template match="/departamentos">
    <html>
      <head>
        <title>Lista de Departamentos</title>
        <link rel="stylesheet" type="text/css" href="../../css/estilos.css"/>
        <meta charset="UTF-8"/>
      </head>
      <body>
        <h1>Lista de Departamentos</h1>
        <table border="1" class="tabla-departamentos">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ubicación</th>
            <th>Responsable</th>
          </tr>
          <xsl:for-each select="departamento">
            <tr>
              <td><xsl:value-of select="departamento_id"/></td>
              <td><xsl:value-of select="departamento_nombre"/></td>
              <td><xsl:value-of select="departamento_ubicacion"/></td>
              <td><xsl:value-of select="usuario_nombre"/></td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>