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

  <!-- our page layout -->
  <xsl:template match="/">
    <html>
      <head>
        <title>gedit</title>
        <link rel="stylesheet" type="text/css" href="http://www.gnome.org/default.css" />
        <link rel="stylesheet" type="text/css" href="gedit.css" />
        <link rel="icon" type="image/png" href="images/favicon.png" />
      </head>

      <body>

        <div id="hdr">
          <a href="http://www.gnome.org/"><img id="logo" src="http://gnome.org/img/logo/text-64" alt="Gnome" /></a>
          <div id="hdrNav">
            <a href="index.html"><b>Home</b></a>
            <xsl:text disable-output-escaping="yes"> &amp;middot; </xsl:text>
            <a href="plugins.html">Plugins</a>
            <xsl:text disable-output-escaping="yes"> &amp;middot; </xsl:text>
            <a href="screenshots.html">Screenshots</a>
            <xsl:text disable-output-escaping="yes"> &amp;middot; </xsl:text>
            <a href="developers.html">Developers</a>
            <xsl:text disable-output-escaping="yes"> &amp;middot; </xsl:text>
            <a href="http://live.gnome.org/Gedit">Wiki</a>
          </div>
        </div>

        <div id="body">
          <xsl:copy-of select="page/*" />
        </div>

        <div id="sidebar">
          <p class="section">Downloads</p>
          <p>The latest release can always be found at the <a href="http://ftp.gnome.org/pub/GNOME/sources/gedit">GNOME ftp site</a>.</p>
          <p>The latest stable release is <a href="{$release/download}"><xsl:value-of select="$release/version"/></a>
          (<a href="{$release/mail}">release notes</a>).</p>

          <p class="section">Feedback</p>
          <p>Bugs should be reported to the <a href="http://bugzilla.gnome.org">GNOME Bug Tracking System</a>.</p>
          <p>You can get in touch with developers and other users by <a href="mailto:gedit-list@gnome.org">sending a mail</a>
             to the gedit <a href="http://mail.gnome.org/mailman/listinfo/gedit-list">mailing list</a> [<a href="http://mail.gnome.org/archives/gedit-list">Archives</a>] 
             or by joining the #gedit channel on irc.gnome.org.</p>
          <br />
        </div>

        <div id="copyright">
          Last modified: <xsl:value-of select="$date"/><br/>
          Copyright <xsl:text disable-output-escaping="yes">&amp;copy;</xsl:text> 2007,
          <a href="http://www.gnome.org/">The GNOME Project</a>
          <br />
          <a href="http://validator.w3.org/check/referer">Optimized</a>
          for <a href="http://www.w3.org/">standards</a>.
        </div>

      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>

