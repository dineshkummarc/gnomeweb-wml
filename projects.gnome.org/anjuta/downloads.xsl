<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  version="1.0">

<xsl:output
    encoding="UTF-8"
    method="xml"
    indent="yes" 
/>

<!-- Load release data from current-release.xml -->
<xsl:variable name="release" select="document('current-release.xml')/release"/>

<xsl:template match="/">
<page name="Downloads">
  <div class="release-block">
    <h2>Anjuta Core release</h2>
    <p>
      Anjuta Core contains main anjuta application, plugins development framework
      and core plugins essential for main development. Plugins like project
      manager, editor, build system, wizards, file manager, debugger,
      git version control system etc. are part of core anjuta.
      See <a href="features.html#core">full features list</a>.
    </p>
    <p>
      See <a href="{$release/anjuta/stable/download}/anjuta-{$release/anjuta/stable/version}.news">news file</a> for changes present in this release.
    </p>
    <h3>Stable core release</h3>
    <div class="download-button">
      <center>
	<a href="{$release/anjuta/stable/download}/anjuta-{$release/anjuta/stable/version}.tar.gz"><strong>Download Stable</strong>
	</a><br/>
	Anjuta <xsl:value-of select="$release/anjuta/stable/version"/>
      </center>
    </div>
    <h3>Latest Unstable core release</h3>
    <div class="download-button">
      <center>
	<a href="{$release/anjuta/unstable/download}/anjuta-{$release/anjuta/unstable/version}.tar.gz"><strong>Download Unstable</strong>
	</a><br/>
	Anjuta <xsl:value-of select="$release/anjuta/unstable/version"/>
      </center>
    </div>
  </div>
  <div class="release-block">
    <h2>Anjuta Extras release</h2>
    <p>
      Anjuta Extras contains additional plugins that provide less-essential but
      nevertheless useful. Plugins such as class inheritance diagram, profiler, 
      scintilla editor, scratchbox, valgrind etc. are present in extras. Extras
      plugins are released less often.
      See <a href="features.html#extras">full extras features list</a>.
    </p>
    <p>
      See <a href="{$release/anjuta-extras/stable/download}/anjuta-extras-{$release/anjuta-extras/stable/version}.news">news file</a> for changes present
	in this release.
    </p>
    <h3>Statble extras release</h3>
    <div class="download-button">
      <center>
	<a href="{$release/anjuta-extras/stable/download}/anjuta-extras-{$release/anjuta-extras/stable/version}.tar.gz"><strong>Download Stable</strong>
	</a><br/>
	Anjuta Extras <xsl:value-of select="$release/anjuta-extras/stable/version"/>
      </center>
    </div>
    <h3>Latest unstable extras release</h3>
    <div class="download-button">
      <center>
	<a href="{$release/anjuta-extras/unstable/download}/anjuta-extras-{$release/anjuta-extras/unstable/version}.tar.gz"><strong>Download Unstable</strong>
	</a><br/>
	Anjuta Extras <xsl:value-of select="$release/anjuta-extras/unstable/version"/>
      </center>
    </div>
  </div>
  
  <p class="clear-me">
    Anjuta follows GNOME
    <a href="http://live.gnome.org/TwoPointTwentyseven">release planning</a>
    and version numbering scheme. Unstable
    versions have a odd minor version number while stable version
    have a even minor version number.
    We encourage to use it and help us with
    <a href="http://bugzilla.gnome.org/enter_bug.cgi?product=anjuta">bug reports</a>.
    Some more information can be found at
    <a href="http://live.gnome.org/Anjuta">Anjuta wiki</a>.
  </p>
  
  <p class="clear-me">
    Older releases are available
    <a href="http://ftp.gnome.org/pub/GNOME/sources/anjuta/">here</a>
  </p>
  
  <h2>Ubuntu prebuild binary packages</h2>
  <p>
    Ubuntu prebuilt binary packages for the latest stable version
    are available at this
    <a href="https://launchpad.net/~jhs.schmid/+archive/ppa">PPA</a>.
    Follow the instructions to add the repository and you will get
    regular updates. For other distrubutions, you will have to wait
    until packages are available in their repositories.
  </p>

  <a name="anjuta-dependencies"></a>
  <h2>Anjuta Dependencies</h2>
  <p> You must have these to install Anjuta 2.x. In case, you are installing binary package,
    please also install corresponding devel package as well.
  </p>
  <p>
    <table border="1" cellspacing="1" cellpadding="4" width="100%">
      <tr><td nowrap=""><a href="http://ftp.gnome.org/pub/GNOME/sources/gdl/">gdl</a></td>
        <td nowrap="">2.28 or later</td>
        <td>GNOME development library</td></tr>
      
      <tr><td nowrap=""><a href="http://ftp.gnome.org/pub/GNOME/sources/libgda/3.99/">libgda</a></td>
        <td nowrap="">4.0 or later</td>
        <td>GNOME DB library</td></tr>
      
      <tr><td nowrap=""><a href="http://sourceforge.net/project/showfiles.php?group_id=3593">libopts</a></td>
        <td nowrap="">23.0.0 or later</td>
        <td>Command options processing (required by autogen)</td></tr>
      
      <tr><td nowrap=""><a href="ftp://ftp.gnu.org/gnu/guile/">guile</a></td>
        <td nowrap="">1.6.7 or later</td>
        <td>Scripting engine (required by autogen)</td></tr>
      
      <tr><td nowrap=""><a href="http://sourceforge.net/project/showfiles.php?group_id=3593">autogen</a></td>
        <td nowrap="">5.6.5 or later</td>
        <td>Template processing engine</td></tr>
    </table>
  </p>	
  <p>
    You can optionally have these to build these very essential plugins.
  </p>
  <p>
    <table border="1" cellspacing="1" cellpadding="4">
      <tr><td nowrap=""><a href="http://ftp.gnome.org/pub/GNOME/sources/glade3/">glade3</a></td>
        <td nowrap="">3.1.3 or later</td>
        <td>Next generation glade UI designer.
	  GTK/GNOME Graphical User Interface Editor.
	  You need this for developing GTK/GNOME applications in Anjuta</td></tr>
      
      <tr><td nowrap=""><a href="http://ftp.gnome.org/pub/GNOME/sources/devhelp/">devhelp</a></td>
        <td nowrap="">0.22 or later</td>
        <td>Developer's help system. Required for context sensitive API help and search.</td></tr>
      
      <tr><td nowrap=""><a href="http://www.graphviz.org/Download.php">graphviz</a></td>
        <td nowrap="">2.6.0 or later</td>
        <td>Graph processing library (required for class inheritance diagram plugin)</td></tr>
      
      <tr><td nowrap=""><a href="http://subversion.tigris.org/project_packages.html">subversion</a></td>
        <td nowrap="">1.5.0 or later</td>
        <td>Subversion version control (required for subversion plugin)</td></tr>
    </table>
  </p>
    
  <h2>Application development requirements</h2>
  <p>
    These are required if you
    intend to do additional development (as mentioned alongside the
    packages). Anjuta does not have any restriction on versions of these
    packages, so choose the versions which your application require. Make sure
    to install their corresponding *-devel packages also.
  </p>
  <p>
    <table border="1" cellspacing="1" cellpadding="4">
      <tr><td><a href="http://gtkmm.sourceforge.net/">gtkmm</a></td>
	<td>C++ wrapper for GTK. You need this for developing C++ GTK applications.</td></tr>
      <tr><td><a href="http://www.wxwindows.org">WxWindows</a></td>
	<td>Cross platform GUI toolkit. It uses
	  GTK+ for GNU/Linux systems. You need this for developing WxWindows based
	  applications.</td></tr>
      <tr><td><a href="http://www.libsdl.org/">SDL</a></td>
	<td>Simple DirectMedia Layer graphics library. Required for
	  developing SDL (graphics) applications.</td></tr>
    </table>
  </p>
</page>
</xsl:template>

</xsl:stylesheet>
