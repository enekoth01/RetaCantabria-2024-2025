<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
      xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 
  <xsl:output method="html" encoding="UTF-8" indent="yes"/>
 
  <xsl:template match="/recursos">
    <html>
      <head>
        <title>Lista de Recursos</title>
        <link rel="stylesheet" type="text/css" href="../../css/estilos.css"/>
        <meta charset="UTF-8"/>
      </head>
      <body>
        <h1>Lista de Recursos</h1>
        <table border="1" class="tabla-recursos">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Ubicación</th>
          </tr>
          <xsl:for-each select="recurso">
            <tr>
              <td><xsl:value-of select="recurso_id"/></td>
              <td><xsl:value-of select="recurso_nombre"/></td>
              <td><xsl:value-of select="recurso_precio"/></td>
              <td><xsl:value-of select="recurso_estado"/></td>
              <td><xsl:value-of select="recurso_ubicacion"/></td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>