<?php

require('include/html.php3');
require('include/news.php3');

html_begin_doc('Main');
?>

<CENTER><H2>GNOME-DB Home Page</H2></CENTER>
<P>
  <B>GNOME DB</B> is a framework for creating database applications. It
  provides a common API with pluggable back ends to different database sources
  as well as various specialized widgets for handling many database
  tasks. The backends, in the typical GNOME tradition, are based on CORBA.
  Apart from this development framework, a whole set of applications,
  utilities and tools are included in the distribution, which makes
  it a complete suite for database-related tasks.
</P>
<P>
  <B>GNOME-DB</B> is free software, and you can redistribute it under the terms of
  the GNU Public License. As one of the main purposes of <B>GNOME-DB</B> is to be
  a development platform, different licenses are applied for executables and
  libraries. Thus, the provided executables are released under the GPL license,
  which means that any work derived from them should also be released under
  the same license. On the other hand, libraries are released under the
  LGPL license, which allows for commercial products to be linked against them.
  This means that you can develop commercial solutions based on <B>GNOME-DB</B>.
</P>
<P>
  All this also means that you can contribute to the project if you want. There
  are too many things that can fit into <B>GNOME-DB</B>, so help is always
  welcomed. If you want to do so, please have a look at the
  <B><A HREF="TODO.php3">TODO list</A></B> to see (or suggest) the way you can help.
</P>
<P>
  <B>GNOME-DB</B> is composed of three separated, independent 
  layers. The lower one is composed by the database providers, which are
  CORBA servers that map the database-specific APIs to
  the GDA (GNOME Data Access) model. The middle-layer is the GDA client library, which 
  sits on top of the CORBA interface to allow an easier access
  to client applications, along with the GDA
  UI library, which provides a way of easily accessing the client 
  library from GNOME applications. The upper-level layer is composed
  by the applications making use of the middle-level layer, such as, for example, the rolodex 
  application and the SQL Front End.
</P>
<P>
  This architecture model provides the way to distribute your applications in several
  machines if needed (it will work perfectly in one machine also). This is achieved
  thanks to the network-transparency of the middleware used (CORBA).
</P>
<center>
<table border=0>
<tr>
  <td><img src="images/list_item.gif" border=0></td>
  <td><a href="download.php3">Download latest release</a></td>
</tr>
<tr>
  <td><img src="images/list_item.gif" border=0></td>
  <td><a href="doc/index.php3">View available documentation</a></td>
</tr>
<tr>
  <td><img src="images/list_item.gif" border=0></td>
  <td><a href="current_servers.php3">View list of currently available servers</a></td>
</tr>
<tr>
  <td><img src="images/list_item.gif" border=0></td>
  <td><a href="screenshots.php3">See GNOME-DB in action!</a></td>
</tr>
<tr>
  <td><img src="images/list_item.gif" border=0></td>
  <td><a href="download/gnome-db-www.tar.gz">Download the entire web site!</a></td>
</tr>
<tr>
  <td><img src="images/list_item.gif" border=0></td>
  <td><a href="apps.php3">List of applications using GNOME-DB</a></td>
</tr>
</table>
</center>

<?php
news_show_latest(10);
html_end_doc();

?>