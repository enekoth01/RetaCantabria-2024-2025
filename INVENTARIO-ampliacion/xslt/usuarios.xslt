<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 
  <xsl:output method="html" indent="yes" encoding="UTF-8"/>
 
  <xsl:template match="/usuarios">
    <html>
      <head>
        <title>Lista de usuarios</title>
        <link rel="stylesheet" type="text/css" href="../../css/estilos.css"/>
                <meta charset="UTF-8"/>
      </head>
      <body>
        <table border="1" class="tabla-usuarios">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Usuario</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
            <xsl:for-each select="usuario">
              <tr>
                <td><xsl:value-of select="usuario_id"/></td>               
                <td><xsl:value-of select="usuario_nombre"/></td>
                <td><xsl:value-of select="usuario_apellido"/></td>
                <td><xsl:value-of select="usuario_usuario"/></td>
                <td><xsl:value-of select="usuario_email"/></td>
              </tr>
            </xsl:for-each>
          </tbody>
        </table>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>