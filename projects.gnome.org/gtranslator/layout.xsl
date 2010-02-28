<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  version="1.0">

  <xsl:output
    encoding="UTF-8"
    method="xml"
    indent="yes" 
    doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN"
    doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
  />

  <!-- Load release data from current-release.xml -->
  <xsl:variable name="release" select="document('current-release.xml')/release"/>

  <!-- current page name -->
  <xsl:variable name="pname" select="/page/@name"/>

  <!-- template to make navigation menu items -->
  <xsl:template name="navitem">
    <xsl:param name="target"/>
    <xsl:param name="name"/>
    <xsl:choose>
      <xsl:when test="$pname=$name">
        <li class="selected">
	  <a href="{$target}"><span><xsl:value-of select="$name"/></span></a>
	</li>
      </xsl:when>
      <xsl:otherwise>
        <li>
	  <a href="{$target}"><span><xsl:value-of select="$name"/></span></a>
	</li>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <!-- our page layout -->
  <xsl:template match="/">
    <html>
      <head>
	<title>Gtranslator: Translation file editor</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta content="programming, best, ide, free, user friendly, gnome, linux, gtranslator, c, php, versatile, gtk, website" name="keywords"/>
        <link rel="stylesheet" type="text/css" href="http://www.gnome.org/css/layout.css" />
        <link rel="stylesheet" type="text/css" href="http://www.gnome.org/css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/gtranslator.css" />
        <link rel="stylesheet" type="text/css" href="css/blog.css" />
        <link rel="icon" type="image/png" href="images/favicon.png" />
      </head>

      <body>

        <div id="hdr">
          <div id="page">
	    <ul id="general">
	      <li id="siteaction-gnome_home" class="home">
		<a href="http://projects.gnome.org/gtranslator" title="Home">Home</a>
	      </li>
	      <li id="siteaction-gnome_news">
		<a href="https://sourceforge.net/projects/gtranslator/forums/forum/940233" title="News">News</a>
		
	      </li>
	      <li id="siteaction-gnome_projects">
	      	<a href="http://live.gnome.org/gtranslator"
	      	   title="Project Site">Wiki</a>
	      </li>
	      <li id="siteaction-gnome_art">
		<a href="http://download.gnome.org/sources/gtranslator/"
		   title="Releases">Releases</a>
	      </li>
	      
	      <li id="siteaction-gnome_support">
		<a href="http://mail.gnome.org/mailman/listinfo/gtranslator-list"
		   title="Mailing lists">Mailing lists</a>
	      </li>
	      <!-- <li id="siteaction-gnome_development"> -->
	      <!-- 	<a href="http://sourceforge.net/forum/?group_id=14222" -->
	      <!-- 	   title="Forums">Forums</a> -->
	      <!-- </li> -->
	    </ul>
            <div id="header" style="text-align:left;">
	      <div id="header-wrap">
	      <h1>Gtranslator: Translation files editor</h1>
              <div id="tabs">
                <ul id="portal-globalnav">
                  <xsl:call-template name="navitem">
                    <xsl:with-param name="target">index.html</xsl:with-param>
                    <xsl:with-param name="name">Home</xsl:with-param>
                  </xsl:call-template>
                  <xsl:call-template name="navitem">
                    <xsl:with-param name="target">features.html</xsl:with-param>
                    <xsl:with-param name="name">Features</xsl:with-param>
                  </xsl:call-template>
                  <xsl:call-template name="navitem">
                    <xsl:with-param name="target">downloads.html</xsl:with-param>
                    <xsl:with-param name="name">Downloads</xsl:with-param>
                  </xsl:call-template>
                  <xsl:call-template name="navitem">
                    <xsl:with-param name="target">development.html</xsl:with-param>
                    <xsl:with-param name="name">Development</xsl:with-param>
                  </xsl:call-template>
                  <!-- <xsl:call-template name="navitem"> -->
                  <!--   <xsl:with-param name="target">projects.html</xsl:with-param> -->
                  <!--   <xsl:with-param name="name">Projects</xsl:with-param> -->
                  <!-- </xsl:call-template> -->
                  <xsl:call-template name="navitem">
                    <xsl:with-param name="target">authors.html</xsl:with-param>
                    <xsl:with-param name="name">Credits</xsl:with-param>
                  </xsl:call-template>
                </ul>
              </div>
              </div>
	    </div>
          </div>
        </div>

        <div id="body">
          <div id="content">
            <xsl:copy-of select="page/*" />
          </div>
        </div>

        <div id="sidebar">
          <p class="section">Downloads</p>
          <p>The latest release can always be found at the <a href="http://ftp.gnome.org/pub/GNOME/sources/gtranslator">GNOME ftp site</a>.</p>
          <p>The latest windows binary can be found from <a href="http://ftp.gnome.org/pub/GNOME/binaries/win32/gtranslator">gtranslator win32 binary</a>.</p>

          <p class="section">Feedback</p>
          <p>Bugs should be reported to the <a href="http://bugzilla.gnome.org">GNOME Bug Tracking System</a>.</p>
          <p>You can get in touch with developers and other users by <a href="mailto:gtranslator-list@gnome.org">sending a mail</a>
             to the gtranslator <a href="http://mail.gnome.org/mailman/listinfo/gtranslator-list">mailing list</a> [<a href="http://mail.gnome.org/arc\
hives/gedit-list">Archives</a>]
             or by joining the #gtranslator channel on irc.gnome.org.</p>                                                                        
          <br />
        </div>

	<div id="copyright">
          Last modified: <xsl:value-of select="$date"/><br/>
          Copyright <xsl:text disable-output-escaping="yes">&amp;copy;</xsl:text> 2010,
          <a href="http://www.gnome.org/">The Gtranslator Project</a>
          <br />
          <a href="http://validator.w3.org/check/referer">Optimized</a>
          for <a href="http://www.w3.org/">standards</a>.
        </div>

      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>
