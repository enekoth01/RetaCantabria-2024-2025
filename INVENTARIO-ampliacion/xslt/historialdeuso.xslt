<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" indent="yes" encoding="UTF-8"/>

  <xsl:template match="/historialdeusos">
    <html>
      <head>
        <title>Lista de Historial de Uso</title>
        <link rel="stylesheet" type="text/css" href="../../css/estilos.css"/>
                <meta charset="UTF-8"/>
      </head>
      <body>
        <h1>Lista de Historial de Uso</h1>
        <table border="1" class="tabla-historialdeuso">
          <tr>
            <th>ID</th>
            <th>recurso_id</th>
            <th>usuario_id</th>
            <th>uso_fecha_inicio</th>
            <th>uso_fecha_fin</th>
          </tr>
          <xsl:for-each select="historialdeuso">
            <tr>
              <td><xsl:value-of select="uso_id"/></td>
              <td><xsl:value-of select="recurso_id"/></td>
              <td><xsl:value-of select="usuario_id"/></td>
              <td><xsl:value-of select="uso_fecha_inicio"/></td>
              <td><xsl:value-of select="uso_fecha_fin"/></td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>