<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
  xmlns:purl="http://purl.org/rss/1.0/"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  exclude-result-prefixes="dc purl rdf">
<xsl:output method="html" encoding="UTF-8" indent="yes" />

<!-- Create a key assigning an item's topic to each item -->
<xsl:key name="topics" match="purl:item" use="dc:subject" />

<xsl:template match="rdf:RDF">

    <!-- Generate DTD -->
    <xsl:text disable-output-escaping="yes"><![CDATA[<!DOCTYPE NETSCAPE-Bookmark-file-1>]]>
</xsl:text>

    <!-- Page header and title -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Bookmarks</title>
    <h1>Bookmarks</h1>
    <dl>

    <!-- Items with Topics assigned will be processed first -->
    <xsl:for-each select="purl:item[count(. | key('topics', dc:subject)[1]) = 1]">
        <xsl:sort select="dc:subject" />

        <!-- Test if a topic is assigned -->
        <xsl:if test="dc:subject">

            <dt><h3><xsl:value-of select="dc:subject" /></h3><dl>
            <xsl:for-each select="key('topics', dc:subject)">
                <xsl:sort select="purl:title" />
                <dt><a href="{./purl:link}"><xsl:value-of select="./purl:title" /></a></dt>
            </xsl:for-each>

            <!-- Force a linebreak; otherwise thinks will break for Topics with only 1 item -->
            <xsl:text>
            </xsl:text>
            </dl></dt>
        </xsl:if>
    </xsl:for-each>

    <!-- Now Bookmarks without topics will be added at the bottom of the output file -->
    <xsl:for-each select="purl:item">
        <xsl:sort select="./purl:title" />
        <xsl:if test="not(dc:subject)">
            <dt><a href="{./purl:link}"><xsl:value-of select="./purl:title" /></a></dt>
        </xsl:if>
    </xsl:for-each>

    <!-- Closing tag of outer dl -->
    </dl>

</xsl:template>

</xsl:stylesheet>
