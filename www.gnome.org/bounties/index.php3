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
<a STYLE="text-decoration:none" name="table">
<a name="unclaimed"></a><h2>Unclaimed Bounties</h2>
<?php write_table_header ("yes"); ?>
<?php taskrow ("Gaim/Evolution presence integration", "IM", "2000", "127546", ""); ?>
<?php taskrow ("Planner (formerly MrProject) integration", "Addressbook", "300", "127520", ""); ?>
<?php taskrow ("Implement a panel notification applet for new mail", "Mailer", "400", "127516", ""); ?>
<?php taskrow ("Inline PGP support for evolution", "Mailer", "250", "127521", ""); ?>
<?php taskrow ("Evolution/iPod synchronization", "Miscellaneous", "500", "127552", ""); ?>
<?php taskrow ("Bugzilla tasks backend", "Tasks", "500", "127558", ""); ?>
<?php taskrow ("Advanced LDAP Configuration", "Addressbook", "250", "127525", ""); ?>
<?php taskrow ("Outlook-Evolution dictionary", "Documentation", "300", "127544", ""); ?>
<?php taskrow ("Publish your calendar", "Calendar", "2000", "127538", ""); ?>
<?php taskrow ("Ask user to make Evolution default mail app", "Mailer", "100", "127526", ""); ?>
<?php taskrow ("OO.o slide view performance", "OpenOffice.org", "500", "127554", ""); ?>
<?php taskrow ("Templates for new messages and replies", "Mailer", "500", "127529", ""); ?>
<?php taskrow ("Language selection in composer", "Mailer", "400", "127530", ""); ?>
<?php taskrow ("Drag and Drop between Gnome and Firefox", "Miscellaneous", "300", "127553", ""); ?>
<?php taskrow ("Gaim drag and drop file transfer", "IM", "400", "127547", ""); ?>
<?php taskrow ("Message receipts", "Mailer", "500", "127534", ""); ?>
<?php taskrow ("Add image data to the icon cache", "Memory", "100", "169344", ""); ?>
<?php taskrow ("Use a mmap'able cache for fontconfig", "Memory", "200", "169345", ""); ?>
<?php taskrow ("Create a test suite for browsing in Nautilus", "Memory", "200", "169346", ""); ?>
<?php taskrow ("Remove duplication of desktop backgrounds", "Memory", "200", "169347", ""); ?>
<?php write_table_footer (); ?>
<a name="claimed"></a><h2>Already Claimed Bounties</h2>
<?php write_table_header ("yes"); ?>
<?php taskrow ("Panel clock/calendar integration", "Calendar", "1000", "127532", "http://www.gnome.org/~markmc/clock-evo-integration.diff"); ?>
<?php taskrow ("Birthday and anniversary calendar backend", "Calendar", "500", "127535", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004082.html"); ?>
<?php taskrow ("Gaim/addressbook identity integration", "Addressbook", "2500", "127513", "http://www.chipx86.com/gevolution/"); ?>
<?php taskrow ("Improve Nautilus &quot;Send to...&quot; feature", "Miscellaneous", "1500", "127551", "www.es.gnome.org/~telemaco/nautilus-sendto-0.1-1.tar.gz"); ?>
<?php taskrow ("Addressbook/GnomeMeeting integration", "Addressbook", "500", "127515", "http://cvs.gnome.org/viewcvs/gnomemeeting/src"); ?>
<?php taskrow ("Set wallpaper from mailer", "Mailer", "100", "127514", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=22642"); ?>
<?php taskrow ("Mailing list actions", "Mailer", "500", "127518", "http://cvs.gnome.org/viewcvs/evolution/plugins/mailing-list-actions/"); ?>
<?php taskrow ("Finish NNTP support in Evolution", "Mailer", "750", "127519", "http://home.wanadoo.nl/meilof/evolution-nntp-patch-17"); ?>
<?php taskrow ("Custom mail headers display", "Mailer", "200", "127523", "http://lists.ximian.com/archives/public/evolution-patches/2003-December/003697.html"); ?>
<?php taskrow ("Contact search applet", "Addressbook", "750", "127522", "http://www.burtonini.com/computing/contact-lookup-applet-0.4.tar.gz"); ?>
<?php taskrow ("Support export of tasks to CSV spreadsheet
files", "Tasks", "300", "127557", "http://bugzilla.gnome.org/attachment.cgi?id=34391"); ?>
<?php taskrow ("Weather calendar backend", "Calendar", "750", "127537", "http://cvs.gnome.org/viewcvs/evolution-data-server/calendar/backends/weather/"); ?>
<?php taskrow ("Quick reference card", "Documentation", "300", "127545", "http://cvs.gnome.org/viewcvs/evolution/help/quickref/"); ?>
<?php taskrow ("OO.o Image Save", "OpenOffice.org", "300", "127556", "http://ooo.ximian.com/ooo-build/patches/OOO_1_1/sd-save-image-context-menu.diff"); ?>
<?php taskrow ("OO.o Calc - function precision", "OpenOffice.org", "500", "127771", "http://ooo.ximian.com/ooo-build/patches/OOO_1_1/"); ?>
<?php taskrow ("Publish free/busy information", "Calendar", "500", "127539", "http://cvs.gnome.org/bonsai/cvslog.cgi?file=evolution%2Fcalendar/ChangeLog&rev=1.2066&root=/cvs/gnome#1.2066"); ?>
<?php taskrow ("Default free/busy URI", "Calendar", "300", "127541", "http://bugzilla.gnome.org/attachment.cgi?id=34969&action=view"); ?>
<?php taskrow ("Attachment bar and drag-and-drop in the composer", "Mailer", "500", "127527", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004052.html"); ?>
<?php taskrow ("Better smiley substitution in the composer", "Mailer", "200", "127533", "http://bugzilla.gnome.org/attachment.cgi?id=21716&action=view"); ?>
<?php taskrow ("Make Evolution Use the gnome-icon-theme", "Miscellaneous", "500", "127812", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=22699"); ?>
<?php taskrow ("Gaim drag and drop of links", "IM", "250", "127548", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=23279"); ?>
<?php taskrow ("Handle <tt>aim:</tt> links in Firefox", "IM", "100", "127549", "http://bugzilla.gnome.org/attachment.cgi?id=30442"); ?>
<?php taskrow ("Link URLs in the status bar", "Mailer", "200", "127536", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/003949.html"); ?>
<?php write_table_footer (); ?>
</div>

<div id="sidebar">
<p class="section">More Information</p>
<ul>
<li><a STYLE="text-decoration:none" href="rules.html">Contest Rules</a></li>
<li><a STYLE="text-decoration:none" href="hints.html">Helpful Hints</a></li>
<li><a STYLE="text-decoration:none" href="discuss.html">Bounties Discussion</a></li>
<li><a STYLE="text-decoration:none" href="Winners.html">Claimed Bounties</a></li>
</ul>
</div>

<div id="hdr">
<div id="logo"><a STYLE="text-decoration:none" href="http://www.gnome.org/"><img src="http://www.gnome.org/img/spacer" alt="Home"></a></div>
<div id="banner"><img src="http://www.gnome.org/img/spacer" alt=""></div>
<p class="none"></p>
<div id="hdrNav">
<a STYLE="text-decoration:none" href="http://www.gnome.org/about/">About GNOME</a> &middot;
<a STYLE="text-decoration:none" href="http://www.gnome.org/start/2.4/">Download</a> &middot;
<a STYLE="text-decoration:none" href="http://www.gnome.org/">Users</a> &middot;
<a STYLE="text-decoration:none" href="http://developer.gnome.org/">Developers</a> &middot;
<a STYLE="text-decoration:none" href="http://foundation.gnome.org/">Foundation</a> &middot;
<a STYLE="text-decoration:none" href="http://www.gnome.org/contact/">Contact</a>
</div>
</div>

<br>
<br>
<center>
<i>These pages were <a STYLE="text-decoration:none" href="build.cs">autogenerated</a> using <a STYLE="text-decoration:none" href="http://www.go-mono.com/">Mono</a>.</i>
</center>
</body>
</html>

