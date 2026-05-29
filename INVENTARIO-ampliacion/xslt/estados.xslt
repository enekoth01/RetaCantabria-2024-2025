<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" indent="yes"/>

  <xsl:template match="/estados">
    <html>
      <head>
        <title>Lista de Estados</title>
      </head>
      <body>
        <h2>Lista de Estados</h2>
        <table>
          <tr>
            <th>ID</th>
            <th>Descripcion</th>
          </tr>
          <xsl:for-each select="estado">
            <tr>
              <td><xsl:value-of select="estado_id"/></td>
              <td><xsl:value-of select="estado_descripcion"/></td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>