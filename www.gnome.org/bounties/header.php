<?php

include ("./util.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <link rel="stylesheet" media="screen" href="styles.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="http://www.gnome.org/default.css">
    <link rel="icon" type="image/png" href="http://www.gnome.org/img/logo/foot-16.png">
    <meta name="cvsdate" content="$Date$">

    <script src="dhtml-table.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Desktop Integration Bounty Hunt</title>
</head>

<script>
<!--
function defaultSort ()
{
    var cat = document.getElementById ("column-category");
    tableSort (cat, 'Text');
}
-->
-->
</script>

<body bgcolor="#ffffff" text="#000000" onLoad="defaultSort()"><div id="body">

<p>
<center>
<b><font size="+2">Desktop Integration Bounty Hunt</font></b><br><br>
</center>

<?php box_start ("Summary"); ?>

Welcome to the first-ever open source desktop bounty hunt!  <p>

The goal of this contest is to improve the quality and functionality
of the Linux desktop.  <p>

This contest is sponsored by Novell, and the
bounties herein are mainly chosen by Novell employees.  If you'd like
to create a bounty of your own, and are willing to fund it yourself,
you might get in touch with <a href="mailto:nat@nat.org">Nat
Friedman</a>.  Some day I'd like there to be a <a
href="http://nat.org/2005/january/#bountysystem">general bounty
system</a> that anyone can use. <p>

Each task listed below has a bounty associated with it.  Your job is
simple: choose a task, do the work, fill out the claim form, and
collect the bounty.

<p>

<?php box_end (); ?>

<a STYLE="text-decoration:none" name="categories">
<?php box_start ("Bounty Categories"); ?>
<table width="100%" cellpadding=12>
	  <tr>
	    <td align="center">
	      <a STYLE="text-decoration:none" href="Addressbook.html"><img src="addressbook-icon.png" 
					alt="" border=0><br>
		    <b>Addressbook</b></a>
	    </td>
	    <td align="center">
	      <a STYLE="text-decoration:none" href="Calendar.html"><img src="calendar-icon.png" 
						  alt="" border=0><br>
		    <b>Calendar</b></a>
	    </td>
	    <td align="center">
	      <a STYLE="text-decoration:none" href="Documentation.html"><img src="documentation-icon.png" 
						  alt="" border=0><br>
		    <b>Documentation</b></a>
	    </td>
	    <td align="center">
	      <a STYLE="text-decoration:none" href="IM.html"><img src="im-icon.png" 
						       alt="" border=0><br>
		    <b>IM</b></a>
	    </td>
	    <td align="center">
	      <a STYLE="text-decoration:none" href="Mailer.html"><img src="mailer-icon.png" 
						       alt="" border=0><br>
		    <b>Mailer</b></a>
	    </td>
	    <td align="center">
	      <a STYLE="text-decoration:none" href="Miscellaneous.html"><img src="miscellaneous-icon.png" 
						       alt="" border=0><br>
		    <b>Misc.</b></a>
	    </td>
	  </tr>
	  <tr>
	    <td align="center">
	      <a STYLE="text-decoration:none" href="OpenOffice.org.html"><img src="openoffice-icon.png" 
						       alt="" border=0><br>
		    <b>OpenOffice.org</b></a>
	    </td>
	    <td align="center">
	      <a STYLE="text-decoration:none" href="Tasks.html"><img src="tasks-icon.png" 
						       alt="" border=0><br>
		    <b>Tasks</b></a>
	    </td>
	    
	    <td align="center">
	      <a STYLE="text-decoration:none" href="Memory.html"><img src="memory.png" 
						       alt="" border=0><br>
		    <b>Memory</b></a>
	    </td>
	  </tr>
</table>
</center>
<?php box_end (); ?>
