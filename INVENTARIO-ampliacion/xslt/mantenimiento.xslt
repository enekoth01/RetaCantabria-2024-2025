<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 
    <xsl:output method="html" encoding="UTF-8" indent="yes"/>
 
    <xsl:template match="/mantenimientos">
        <html>
            <head>
                <title>Listado de Mantenimientos</title>
                <link rel="stylesheet" type="text/css" href="../../css/estilos.css"/>
                <meta charset="UTF-8"/>
            </head>
            <body>
                <h1>Listado de Proveedores</h1>
                <table border="1" class="tabla-mantenimientos">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Recurso</th>
                        <th>Fecha</th>
                        <th>Descripcion</th>
                    </tr>
                    <xsl:for-each select="mantenimiento">
                        <tr>
                            <td><xsl:value-of select="mantenimiento_id"/></td>
                            <td><xsl:value-of select="usuario_id"/></td>
                            <td><xsl:value-of select="recurso_id"/></td>
                            <td><xsl:value-of select="fecha"/></td>
                            <td><xsl:value-of select="descripcion"/></td>
                        </tr>
                    </xsl:for-each>
                </table>
               
            </body>
           
        </html>
    </xsl:template>
 
</xsl:stylesheet>
 