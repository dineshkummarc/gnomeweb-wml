<?php

require('include/html.php3');
require('include/news.php3');

html_begin_doc('Main');
?>

<CENTER><H2>GNOME-DB Home Page</H2></CENTER>
<P>
  <B>GNOME DB</B> is an attempt to provide universal access to different
  data sources, and is based entirely on CORBA. As part of the
  <B>GNOME-DB</B> project, we've created <code>libgda</code>, which is
  the responsible of all low-level database-related tasks, and is
  independant of GNOME, so it can be used in any non-GNOME application.
  The GNOME-dependant part of <B>GNOME-DB</B> is more than just a frontend
  to the <code>libgda</code> architecture. Through the use of the GNOME
  technologies, such as Bonobo, GConf, it adds extra functionality to
  the already powerful <code>libgda</code> model.
</P>
<P>
  <B>GNOME-DB</B> is free software, and you can redistribute it under the 
  terms of the GNU Public License. 
  This means that you can contribute to the project if you want. There
  are too many things that can fit into <B>GNOME-DB</B>, so help is always
  welcomed. If you want to do so, please have a look at the
  <B><A HREF="TODO.php3">TODO list</A></B> to see (or suggest) the way you 
  can help.
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
