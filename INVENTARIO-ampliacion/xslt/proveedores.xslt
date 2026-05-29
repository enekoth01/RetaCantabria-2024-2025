<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" encoding="UTF-8" indent="yes"/>

  <xsl:template match="/proveedores">
    <html>
      <head>
        <title>Lista de Proveedores</title>
         <link rel="stylesheet" type="text/css" href="../../css/estilos.css"/>
                <meta charset="UTF-8"/>
      </head>
      <body>
        <h1>Lista de Proveedores</h1>
        <table border="1" class="tabla-proveedores">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
          </tr>
          <xsl:for-each select="proveedor">
            <tr>
              <td><xsl:value-of select="proveedor_id"/></td>
              <td><xsl:value-of select="proveedor_nombre"/></td>
              <td><xsl:value-of select="proveedor_telefono"/></td>
              <td><xsl:value-of select="proveedor_email"/></td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>