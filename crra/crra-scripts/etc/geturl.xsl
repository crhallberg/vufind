<?xml version="1.0" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

  <xsl:output method='text' />
  <xsl:template match='/ead'>
  
	<xsl:value-of select='./eadheader/eadid/@url' />
	
  </xsl:template>
</xsl:stylesheet>
