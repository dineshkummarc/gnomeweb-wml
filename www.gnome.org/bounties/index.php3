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

Welcome to Round Two of the first-ever open source desktop bounty hunt!  <p>

The goal of this contest is to help improve the level of integration
between some of the core components of the Linux desktop.

<p>

Our specific aim is to improve the <i>experience of collaboration</i>
in the desktop environment.  We believe that communicating and working
with other people is not simply a function of a single application
that sits in a rectangular window on your screen &mdash; Evolution or
Outlook, for example &mdash; but one of the primary functions of a
computer.  Therefore, collaboration should be a first-class element of
the user experience. In other words, it should be really easy for a
GNOME user to talk to, share with, and work with their friends.

<p>

Below you will find a set of concrete tasks all of which are designed
to improve collaboration in the open source desktop.  Each task has a
bounty associated with it.  Your job is simple: choose a task, do the
work, fill out the claim form, and collect the
bounty.

<p>

<?php box_end (); ?>


<a name="categories">
<?php box_start ("Bounty Categories"); ?>
<table width="100%" cellpadding=12>
	  <tr>
	    <td align="center">
	      <a href="Addressbook.html"><img src="addressbook-icon.png" 
					alt="" border=0><br>
		    <b>Addressbook</b></a>
	    </td>
	    <td align="center">
	      <a href="Calendar.html"><img src="calendar-icon.png" 
						  alt="" border=0><br>
		    <b>Calendar</b></a>
	    </td>
	    <td align="center">
	      <a href="Documentation.html"><img src="documentation-icon.png" 
						  alt="" border=0><br>
		    <b>Documentation</b></a>
	    </td>
	    <td align="center">
	      <a href="IM.html"><img src="im-icon.png" 
						       alt="" border=0><br>
		    <b>IM</b></a>
	    </td>
	    <td align="center">
	      <a href="Mailer.html"><img src="mailer-icon.png" 
						       alt="" border=0><br>
		    <b>Mailer</b></a>
	    </td>
	    <td align="center">
	      <a href="Miscellaneous.html"><img src="miscellaneous-icon.png" 
						       alt="" border=0><br>
		    <b>Misc.</b></a>
	    </td>
	  </tr>
	  <tr>
	    <td align="center">
	      <a href="OpenOffice.org.html"><img src="openoffice-icon.png" 
						       alt="" border=0><br>
		    <b>OpenOffice.org</b></a>
	    </td>
	    <td align="center">
	      <a href="Tasks.html"><img src="tasks-icon.png" 
						       alt="" border=0><br>
		    <b>Tasks</b></a>
	    </td>
	  </tr>
</table>
</center>
<?php box_end (); ?>
<a name="table">
<?php write_table_header ("yes"); ?>
<?php taskrow ("National, religious, event calendars", "Calendar", "15", "127528", ""); ?>
<?php taskrow ("Gaim/Evolution presence integration", "IM", "2000", "127546", ""); ?>
<?php taskrow ("Improve Nautilus &quot;Send to...&quot; feature", "Miscellaneous", "1500", "127551", ""); ?>
<?php taskrow ("Addressbook/videoconferencing integration", "Addressbook", "500", "127515", ""); ?>
<?php taskrow ("&quot;Me&quot;", "Addressbook", "300", "127517", ""); ?>
<?php taskrow ("Planner (formerly MrProject) integration", "Addressbook", "300", "127520", ""); ?>
<?php taskrow ("Implement a panel notification applet for new mail", "Mailer", "400", "127516", ""); ?>
<?php taskrow ("Mailing list actions", "Mailer", "500", "127518", ""); ?>
<?php taskrow ("Inline PGP support for evolution", "Mailer", "250", "127521", ""); ?>
<?php taskrow ("Support export of tasks or other items to Excel (CSV)", "Tasks", "300", "127557", ""); ?>
<?php taskrow ("Choice of database for contacts back-end", "Addressbook", "250", "127524", ""); ?>
<?php taskrow ("Evolution/iPod synchronization", "Miscellaneous", "500", "127552", ""); ?>
<?php taskrow ("Bugzilla tasks backend", "Tasks", "500", "127558", ""); ?>
<?php taskrow ("Weather calendar backend", "Calendar", "750", "127537", ""); ?>
<?php taskrow ("Advanced LDAP Configuration", "Addressbook", "250", "127525", ""); ?>
<?php taskrow ("Outlook-Evolution dictionary", "Documentation", "300", "127544", ""); ?>
<?php taskrow ("Publish your calendar", "Calendar", "1000", "127538", ""); ?>
<?php taskrow ("Quick reference card", "Documentation", "300", "127545", ""); ?>
<?php taskrow ("Ask user to make Evolution default mail app", "Mailer", "100", "127526", ""); ?>
<?php taskrow ("Drag-n-drop task creation", "Tasks", "300", "127559", ""); ?>
<?php taskrow ("OO.o slide view performance", "OpenOffice.org", "500", "127554", ""); ?>
<?php taskrow ("OO.o slides side-pane", "OpenOffice.org", "1500", "127555", ""); ?>
<?php taskrow ("OO.o Image Save", "OpenOffice.org", "300", "127556", ""); ?>
<?php taskrow ("OO.o Calc - function precision", "OpenOffice.org", "500", "127771", ""); ?>
<?php taskrow ("Default free/busy URI", "Calendar", "300", "127541", ""); ?>
<?php taskrow ("Calendar attachments", "Calendar", "750", "127543", ""); ?>
<?php taskrow ("Templates for new messages and replies", "Mailer", "500", "127529", ""); ?>
<?php taskrow ("Language selection in composer", "Mailer", "400", "127530", ""); ?>
<?php taskrow ("Better smiley substitution in the composer", "Mailer", "200", "127533", ""); ?>
<?php taskrow ("Drag and Drop between Gnome and Mozilla", "Miscellaneous", "300", "127553", ""); ?>
<?php taskrow ("Make Evolution Use the gnome-icon-theme", "Miscellaneous", "500", "127812", ""); ?>
<?php taskrow ("Gaim drag and drop file transfer", "IM", "400", "127547", ""); ?>
<?php taskrow ("Handle <tt>aim:</tt> links in Epiphany", "IM", "100", "127549", ""); ?>
<?php taskrow ("Message receipts", "Mailer", "500", "127534", ""); ?>
<?php write_table_footer (); ?>
</div>

<div id="sidebar">
<p class="section">More Information</p>
<ul>
<li><a href="rules.html">Contest Rules</a></li>
<li><a href="hints.html">Helpful Hints</a></li>
<li><a href="discuss.html">Bounties Discussion</a></li>
<li><a href="Winners.html">Claimed Bounties</a></li>
</ul>
</div>

<div id="hdr">
<div id="logo"><a href="http://www.gnome.org/"><img src="http://www.gnome.org/img/spacer" alt="Home"></a></div>
<div id="banner"><img src="http://www.gnome.org/img/spacer" alt=""></div>
<p class="none"></p>
<div id="hdrNav">
<a href="http://www.gnome.org/about/">About GNOME</a> &middot;
<a href="http://www.gnome.org/start/2.4/">Download</a> &middot;
<a href="http://www.gnome.org/">Users</a> &middot;
<a href="http://developer.gnome.org/">Developers</a> &middot;
<a href="http://foundation.gnome.org/">Foundation</a> &middot;
<a href="http://www.gnome.org/contact/">Contact</a>
</div>
</div>

<br>
<br>
<center>
<i>These pages were <a href="build.cs">autogenerated</a> using <a href="http://www.go-mono.com/">Mono</a>.</i>
</center>
</body>
</html>

