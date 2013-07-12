<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
	xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
	xmlns:ns0="http://www.w3.org/2000/01/rdf-schema#"
	xmlns:ns1="http://purl.org/dc/elements/1.1/">

<xsl:template match="rdf:RDF">
  <html>
  <body>
    <h2><xsl:value-of select="rdf:Description/ns0:label"/></h2>
    <table border="1">
      <tr bgcolor="#9acd32">
        <th>Name</th>
        <th>Description</th>
      </tr>
      <xsl:for-each select="rdf:Description">
        <tr>
          <td><xsl:value-of select="ns0:label"/></td>
          <td><xsl:value-of select="ns1:description"/></td>
        </tr>
      </xsl:for-each>
    </table>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>