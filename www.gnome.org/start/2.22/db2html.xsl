<?xml version='1.0' encoding='UTF-8'?><!-- -*- indent-tabs-mode: nil -*- -->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                version="1.0">

<xsl:import href="/usr/share/xml/gnome/xslt/docbook/html/db2html.xsl"/>

<xsl:param name="db.chunk.max_depth" select="false()"/>
<xsl:param name="db.chunk.info_chunk" select="false()"/>
<xsl:param name="db.chunk.basename" select="'index'"/>
<xsl:param name="db2html.navbar.top" select="false()"/>
<xsl:param name="db2html.navbar.bottom" select="false()"/>
<xsl:param name="theme.icon.admon.path" select="'./images/'"/>

<!-- Call db2html.autotoc with toc_depth set one higher than default,
     to get second-level sections in an article sidebar. -->
<xsl:template name="db2html.sidenav">
  <xsl:param name="node" select="."/>
  <xsl:param name="template"/>
  <div class="sidenav">
    <xsl:call-template name="db2html.autotoc">
      <xsl:with-param name="node" select="/"/>
      <xsl:with-param name="show_info" select="$db.chunk.info_chunk"/>
      <xsl:with-param name="is_info" select="$template = 'info'"/>
      <xsl:with-param name="selected" select="$node"/>
      <xsl:with-param name="divisions" select="/*"/>
      <xsl:with-param name="toc_depth" select="$db.chunk.max_depth + 2"/>
      <xsl:with-param name="labels" select="false()"/>
      <xsl:with-param name="titleabbrev" select="true()"/>
    </xsl:call-template>
  </div>
</xsl:template>

<!-- Call db2html.division.div with autotoc_depth=0 to suppress the
     top-level in-content TOC. -->
<xsl:template match="article">
  <xsl:param name="depth_in_chunk">
    <xsl:call-template name="db.chunk.depth-in-chunk"/>
  </xsl:param>
  <xsl:param name="depth_of_chunk">
    <xsl:call-template name="db.chunk.depth-of-chunk"/>
  </xsl:param>
  <xsl:call-template name="db2html.division.div">
    <xsl:with-param name="divisions" select="                                                 
                    appendix | bibliography | glossary | index      | lot |                   
                    refentry | sect1        | section  | simplesect | toc "/>
    <xsl:with-param name="info" select="articleinfo"/>
    <xsl:with-param name="depth_in_chunk" select="$depth_in_chunk"/>
    <xsl:with-param name="depth_of_chunk" select="$depth_of_chunk"/>
    <xsl:with-param name="autotoc_depth" select="0"/>
  </xsl:call-template>
</xsl:template>

<!-- Stick some extra stuff in the HTML <head> element. -->
<xsl:template name="db2html.division.head.extra">
  <link href="/css/layout.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="icon" type="image/png" href="http://www.gnome.org/img/logo/foot-16.png"/>
</xsl:template>

<!-- Put the GNOME header at the top of the page. -->
<xsl:template name="db2html.division.top">
  <!-- site header -->
  <div id="page">
    <ul id="general">
      <li id="siteaction-gnome_home" class="home">
        <a href="http://www.gnome.org/" title="Home">Home</a>
      </li>

      <li id="siteaction-gnome_news">
        <a href="http://news.gnome.org/" title="News">News</a>
      </li>
      <li id="siteaction-gnome_projects">
        <a href="http://www.gnome.org/projects/" title="Projects">Projects</a>
      </li>
      <li id="siteaction-gnome_art">
        <a href="http://art.gnome.org/" title="Art">Art</a>

      </li>
      <li id="siteaction-gnome_support">
        <a href="http://www.gnome.org/support/" title="Support">Support</a>
      </li>
      <li id="siteaction-gnome_development">
        <a href="http://developer.gnome.org/" title="Development">Development</a>
      </li>
      <li id="siteaction-gnome_community">

        <a href="http://www.gnome.org/community/" title="Community">Community</a>
      </li>
    </ul>
    <div id="header">
      <h1>GNOME: The Free Software Desktop Project</h1>
      <div id="tabs">
        <ul id="portal-globalnav">
<li class="selected"><a href="/about/"><span>About</span></a></li> <li><a href="/start/stable/"><span>Download</span></a></li> <li><a href="/support/"><span>Support</span></a></li> <li><a href="/community/"><span>Contribute</span></a></li> <li><a href="/contact/"><span>Contact</span></a></li>

        </ul>
      </div> <!-- end of #tabs -->
    </div> <!-- end of #header -->
  </div>
<!-- end site header -->
</xsl:template>

<!-- Suppress numbered labels for things. -->
<xsl:template name="db.label"/>

<!-- Strip the content border and allow for the header. -->
<xsl:template name="db2html.css.custom">
<xsl:text>
body {
  background-color: </xsl:text><xsl:value-of select="$theme.color.background"/><xsl:text>;
}
div.body {
  padding: 0;
  border: none;
  margin-top: 80px;
}
div.sidebar {
  margin-top: 80px;
}
</xsl:text>
</xsl:template>

</xsl:stylesheet>
