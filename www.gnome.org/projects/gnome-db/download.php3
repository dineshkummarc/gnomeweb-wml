<?php

require('include/html.php3');

html_begin_doc('Download');

?>
<CENTER><h2>Download</h2></CENTER>
<p>
  There are several ways for downloading GNOME-DB, depending on which 
  use you want to make out of it. If you just want to install the
  application for using it, you should download the 
  <B><a href="#StableVersion">latest stable release</a></B>, which 
  is available in different formats.
</p>
<p>
  If you are a programmer and want to contribute to the development of
  GNOME-DB, you should get the <B><a href="#DevelopmentVersion">latest
  development version</a></B>, which is available from the 
  <B><a href="http://cvs.gnome.org/">anonymous GNOME CVS server</a></B>.
</p>
<p>
  In either case, you will need, of course, the GNOME libraries installed
  on your system. At a minimum, you'll need:
</p>
<ul>
  <li>glib, glib-devel</li>
  <li>gtk+, gtk+-devel</li>
  <li>imlib, imlib-devel</li>
  <li>ORBit, ORBit-devel</li>
  <li>libxml, libxml-devel</li>
  <li>gnome-libs, gnome-libs-devel</li>
  <li>gnome-print, gnome-print-devel</li>
  <li>bonobo</a>, bonobo-devel</a></li>
  <li><b>Optional</b> - libraries and header files for building the
      native <a href="current_servers.php3">database servers</a></li>
</ul>
<p>
  Check the <B><a href="http://www.gnome.org/">GNOME site</a></B> to find
  where you can download these packages from. You can get all these
  packages in different formats (RPMs, DEBs, tarballs,...).
</p>
<p>
  You can also <B><a href="http://cvs.gnome.org/lxr/source/gnome-db/">browse the
  code</a></B> online, by visiting the <B><a href="http://cvs.gnome.org/">GNOME
  CVS server</a></B>.
</p>
<hr width="80%">
<a name="StableVersion"><h3>Stable Versions</a></h3>
<table border=0>
<tr>
  <td colspan=2>Stable versions are releases which have been thoroughly
      tested, which does not mean that they are free of bugs, but that 
      they are more or less stables.<p>
      They are available in different formats:
      <ul>
        <li><B><a href="ftp://ftp.gnome.org/pub/GNOME/stable/sources/gnome-db/">Source Tarballs</a></B></li>
        <li><B><a href="ftp://ftp.gnome.org/pub/GNOME/stable/redhat/i386/gnome-db/">RPM Packages</a></B></li>
        <li><B><a href="ftp://ftp.gnome.org/pub/GNOME/stable/redhat/SRPMS/gnome-db/">SRPM Packages</a></B></li>
      </ul>
  </td>
</tr>
</table>
<hr width="80%">
<a name="DevelopmentVersion"><h3>Development Versions</h3></a>
<table border=0>
<tr>
  <td colspan=2>You can always get the latest development version by
      accessing the <B><a href="http://cvs.gnome.org/">GNOME anonymous 
      CVS server</a></B>. This is done in two easy steps:
      <ul>
        <li>first time, log into the CVS server:<br><br>
<code>cvs -d :pserver:anonymous@anoncvs.gnome.org:/cvs/gnome login</code><br><br>
           pressing <code>ENTER</code> when asked for the password<p></li>
        <li>then, get the latest version by typing:<br><br>
<code>cvs -d :pserver:anonymous@anoncvs.gnome.org:/cvs/gnome checkout gnome-db</code><br><br>
        </li>
      </ul>
      <p>
        The fist step is only needed the first time, since it will create a
        file called <code>.cvspass</code> in your home directory where it
        stores the password for future reference.
      </p>
      <p>
        CVS snapshots are built on a daily basis to help you
        on checking out the sources from CVS. You can find the
        latest snapshot <B><a href="download/gnome-db-cvs.tar.gz">here</a></B>.
      </p>
  </td>
</tr>
</table>

<?php

html_end_doc();
?>