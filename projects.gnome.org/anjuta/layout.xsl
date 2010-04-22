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
	<title>Anjuta DevStudio: Integrated Development Environment</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta content="programming, best, ide, free, user friendly, gnome, linux, anjuta, c, c++, php, versatile, gtk, website" name="keywords"/>
        <link rel="stylesheet" type="text/css" href="http://www.gnome.org/css/layout.css" />
        <link rel="stylesheet" type="text/css" href="http://www.gnome.org/css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/anjuta.css" />
        <link rel="stylesheet" type="text/css" href="css/blog.css" />
        <link rel="icon" type="image/png" href="images/favicon.png" />
      </head>

      <body>

        <div id="hdr">
          <div id="page">
	    <ul id="general">
	      <li id="siteaction-gnome_home" class="home">
		<a href="http://anjuta.org/" title="Home">Home</a>
	      </li>
	      <li id="siteaction-gnome_news">
		<a href="http://blogs.gnome.org/anjuta" title="News">News</a>
		
	      </li>
	      <li id="siteaction-gnome_projects">
		<a href="http://sourceforge.net/projects/anjuta"
		   title="Project Site">Project Site</a>
	      </li>
	      <li id="siteaction-gnome_art">
		<a href="http://download.gnome.org/sources/anjuta/"
		   title="Releases">Releases</a>
		
	      </li>
	      
	      <li id="siteaction-gnome_support">
		<a href="http://sourceforge.net/mail/?group_id=14222"
		   title="Mailing lists">Mailing lists</a>
	      </li>
	      <li id="siteaction-gnome_development">
		<a href="http://sourceforge.net/forum/?group_id=14222"
		   title="Forums">Forums</a>
	      </li>
	    </ul>
            <div id="header" style="text-align:left;">
	      <div id="header-wrap">
	      <h1>Anjuta DevStudio: GNOME Integrated Development Environment</h1>
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
                  <xsl:call-template name="navitem">
                    <xsl:with-param name="target">projects.html</xsl:with-param>
                    <xsl:with-param name="name">Projects</xsl:with-param>
                  </xsl:call-template>
                  <xsl:call-template name="navitem">
                    <xsl:with-param name="target">team.html</xsl:with-param>
                    <xsl:with-param name="name">Meet the team</xsl:with-param>
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
	  <div class="download-button">
	    <center>
	      <a href="{$release/anjuta/stable/download}/anjuta-{$release/anjuta/stable/version}.tar.gz"><strong>Download Now!</strong>
	      </a><br/>
	      Anjuta <xsl:value-of select="$release/anjuta/stable/version"/>
	    </center>
	  </div>
          <p class="section">Documentations</p>
          <ul>
            <li><a href="http://library.gnome.org/devel/anjuta-manual/stable">Anjuta Manual</a> is a book on how to use Anjuta.<br/><br/></li>
            <li><a href="http://library.gnome.org/devel/anjuta-faqs/stable">Anjuta FAQ</a> answers some common questions.<br/><br/></li>
            <li><a href="http://library.gnome.org/users/anjuta-build-tutorial/2.26">Project Build Tutorial</a> describes how project management in Anjuta works.<br/><br/></li> 
            <li><a href="http://library.gnome.org/devel/libanjuta/stable">Anjuta API docs</a> is developers documentation for core Anjuta and interfaces.<br/><br/></li>
            <li><a href="http://library.gnome.org/devel/libanjuta/stable/anjuta-architecture.html">Anjuta Architecture</a> gives an overview of Anjuta architecture.<br/><br/></li>
            <li><a href="http://library.gnome.org/devel/libanjuta/stable/project-wizard-format.html">Creating project templates</a> is a tutorial on adding new project templates.<br/><br/></li>
            <li><a href="http://library.gnome.org/devel/libanjuta/stable/writing-plugins.html">Creating plugins</a> is a tutorial on how to write Anjuta plugins.<br/><br/></li>
          </ul>
          <p class="section">Project Tools</p>
          <ul>
            <li><a href="http://blogs.gnome.org/anjuta">Anjuta News Blog</a> talks about latest stuffs in Anjuta releases.<br/><br/></li>
            <li><a href="http://live.gnome.org/Anjuta">Anjuta wiki</a> is a place to scribble new ideas.<br/><br/></li>
            <li><a href="http://git.gnome.org/browse/anjuta">Anjuta git web</a> to browser source code online.<br/><br/></li>
            <li><a href="http://bugzilla.gnome.org/browse.cgi?product=anjuta">Anjuta Bugzilla</a> is the place to track bugs, obviously.<br/><br/></li>
            <li><a href="https://bugzilla.gnome.org/page.cgi?id=patchreport.html&amp;product=anjuta&amp;patch-status=none">Pending Patches</a> are currently under review.<br/><br/></li>
            <li><a href="http://bugzilla.gnome.org/enter_bug.cgi?product=anjuta">Submit a bug</a>, if you encounter one.<br/><br/></li>
          </ul>
          <p><!--
            <A href="http://sourceforge.net">
	      <img src="http://sourceforge.net/sflogo.php?group_id=14222&amp;type=5"
		   width="210" height="62" border="0" alt="SourceForge.net Logo"/></A>-->
          </p>
	</div> <!-- sidebar -->

        <div id="copyright">
          Last modified: <xsl:value-of select="$date"/><br/>
          Copyright <xsl:text disable-output-escaping="yes">&amp;copy;</xsl:text> 2009,
          The Anjuta Project
          <br />
          <a href="http://validator.w3.org/check/referer">Optimized</a>
          for <a href="http://www.w3.org/">standards</a>.
        </div> 


        <!-- Piwik -->
        <script type="text/javascript">
          var pkBaseURL = (("https:" == document.location.protocol) ? "https://webstats.gnome.org/" : "http://webstats.gnome.org/");
          document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
        </script><script type="text/javascript">
          try {
            var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 4);
            piwikTracker.trackPageView();
            piwikTracker.enableLinkTracking();
          } catch( err ) {}
        </script><noscript><p><img src="http://webstats.gnome.org/piwik.php?idsite=4" style="border:0" alt=""/></p></noscript>
        <!-- End Piwik Tag -->

      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>
