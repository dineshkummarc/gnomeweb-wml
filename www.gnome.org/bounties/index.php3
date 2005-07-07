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

This contest is sponsored by various entities, and the
bounties herein are chosen by the GNOME foundation and by employees of those entities.  If you'd like to create a bounty of your own, and are willing to fund it
yourself, you might get in touch with <a href="mailto:nat@nat.org">Nat
Friedman</a>.  Some day I'd like there to be a <a
href="http://nat.org/2005/january/#bountysystem">general bounty
system</a> that anyone can use. <p>

Each task listed below has a bounty associated with it.  Your job is
simple: choose a task, do the work, fill out the claim form, and
collect the bounty.

<p>
<? box_end (); ?>
<a STYLE="text-decoration:none" name="table">
<a name="unclaimed"></a><h2>Unclaimed Bounties</h2>
<?php write_table_header ("yes", "yes"); ?>
<?php taskrow ("Gaim/Evolution presence integration", "IM", "Novell", "2000", "127546", ""); ?>
<?php taskrow ("Planner (formerly MrProject) integration", "Addressbook", "Novell", "300", "127520", ""); ?>
<?php taskrow ("Bugzilla tasks backend", "Tasks", "Novell", "500", "127558", ""); ?>
<?php taskrow ("Advanced LDAP Configuration", "Addressbook", "Novell", "250", "127525", ""); ?>
<?php taskrow ("Outlook-Evolution dictionary", "Documentation", "Novell", "300", "127544", ""); ?>
<?php taskrow ("Publish your calendar", "Calendar", "Novell", "2000", "127538", ""); ?>
<?php taskrow ("Templates for new messages and replies", "Mailer", "Novell", "500", "127529", ""); ?>
<?php taskrow ("Language selection in composer", "Mailer", "Novell", "400", "127530", ""); ?>
<?php taskrow ("Drag and Drop between Gnome and Firefox", "Miscellaneous", "Novell", "300", "127553", ""); ?>
<?php taskrow ("Add image data to the icon cache", "Optimization", "Novell", "100", "169344", ""); ?>
<?php taskrow ("Create a test suite for browsing in Nautilus", "Optimization", "Novell", "200", "169346", ""); ?>
<?php taskrow ("Improve login time", "Optimization", "Google", "4500", "306042", ""); ?>
<?php taskrow ("Reduce Evolution memory usage", "Optimization", "Google", "4500", "306043", ""); ?>
<?php taskrow ("Global memory analysis tool", "Optimization", "Google", "4500", "306044", ""); ?>
<?php taskrow ("Use a mmap'able cache for
fontconfig", "Optimization", "Google", "4500", "169345", ""); ?>
<?php taskrow ("Live documentation editing", "Documentation", "Google", "4500", "306308", ""); ?>
<?php taskrow ("library.gnome.org", "Documentation", "Google", "4500", "306311", ""); ?>
<?php taskrow ("Most unprecedented application", "Features", "Google", "4500", "306312", ""); ?>
<?php taskrow ("Panel applet bundle system", "Features", "Google", "4500", "306314", ""); ?>
<?php taskrow ("Group mails by conversations in Evolution", "Features", "Google", "4500", "306315", ""); ?>
<?php taskrow ("Paste by example", "Features", "Google", "4500", "306316", ""); ?>
<?php taskrow ("Search party", "Features", "Google", "4500", "306179", ""); ?>
<?php taskrow ("Shared music spaces", "Features", "Google", "4500", "306317", ""); ?>
<?php taskrow ("The GIMP resource distribution system", "GIMP", "Google", "4500", "306713", ""); ?>
<?php taskrow ("The GIMP vector based shapes tool", "GIMP", "Google", "4500", "65197", ""); ?>
<?php write_table_footer (); ?>
<a name="claimed"></a><h2>Already Claimed Bounties</h2>
<?php write_table_header ("yes", "yes"); ?>
<?php taskrow ("Panel clock/calendar integration", "Calendar", "Novell", "1000", "127532", "http://www.gnome.org/~markmc/clock-evo-integration.diff"); ?>
<?php taskrow ("Birthday and anniversary calendar backend", "Calendar", "Novell", "500", "127535", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004082.html"); ?>
<?php taskrow ("Gaim/addressbook identity integration", "Addressbook", "Novell", "2500", "127513", "http://www.chipx86.com/gevolution/"); ?>
<?php taskrow ("Improve Nautilus &quot;Send to...&quot; feature", "Miscellaneous", "Novell", "1500", "127551", "www.es.gnome.org/~telemaco/nautilus-sendto-0.1-1.tar.gz"); ?>
<?php taskrow ("Addressbook/GnomeMeeting integration", "Addressbook", "Novell", "500", "127515", "http://cvs.gnome.org/viewcvs/gnomemeeting/src"); ?>
<?php taskrow ("Set wallpaper from mailer", "Mailer", "Novell", "100", "127514", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=22642"); ?>
<?php taskrow ("Implement a panel notification applet for new mail", "Mailer", "Novell", "400", "127516", "http://cvs.gnome.org/viewcvs/evolution/plugins/new-mail-notify/"); ?>
<?php taskrow ("Mailing list actions", "Mailer", "Novell", "500", "127518", "http://cvs.gnome.org/viewcvs/evolution/plugins/mailing-list-actions/"); ?>
<?php taskrow ("Finish NNTP support in Evolution", "Mailer", "Novell", "750", "127519", "http://home.wanadoo.nl/meilof/evolution-nntp-patch-17"); ?>
<?php taskrow ("Inline PGP support for evolution", "Mailer", "Novell", "250", "127521", "http://www.mattb.net.nz/patches/evolution/"); ?>
<?php taskrow ("Custom mail headers display", "Mailer", "Novell", "200", "127523", "http://lists.ximian.com/archives/public/evolution-patches/2003-December/003697.html"); ?>
<?php taskrow ("Contact search applet", "Addressbook", "Novell", "750", "127522", "http://www.burtonini.com/computing/contact-lookup-applet-0.4.tar.gz"); ?>
<?php taskrow ("Support export of tasks to CSV spreadsheet
files", "Tasks", "Novell", "300", "127557", "http://bugzilla.gnome.org/attachment.cgi?id=34391"); ?>
<?php taskrow ("Evolution/iPod synchronization", "Miscellaneous", "Novell", "500", "127552", "http://members.iinet.net.au/~wakes/evolution-ipod-sync-0.2.tar.bz2"); ?>
<?php taskrow ("Weather calendar backend", "Calendar", "Novell", "750", "127537", "http://cvs.gnome.org/viewcvs/evolution-data-server/calendar/backends/weather/"); ?>
<?php taskrow ("Quick reference card", "Documentation", "Novell", "300", "127545", "http://cvs.gnome.org/viewcvs/evolution/help/quickref/"); ?>
<?php taskrow ("Ask user to make Evolution default mail app", "Mailer", "Novell", "100", "127526", "http://cvs.gnome.org/viewcvs/evolution"); ?>
<?php taskrow ("OO.o Image Save", "OpenOffice.org", "Novell", "300", "127556", "http://ooo.ximian.com/ooo-build/patches/OOO_1_1/sd-save-image-context-menu.diff"); ?>
<?php taskrow ("OO.o Calc - function precision", "OpenOffice.org", "Novell", "500", "127771", "http://ooo.ximian.com/ooo-build/patches/OOO_1_1/"); ?>
<?php taskrow ("Publish free/busy information", "Calendar", "Novell", "500", "127539", "http://cvs.gnome.org/bonsai/cvslog.cgi?file=evolution%2Fcalendar/ChangeLog&rev=1.2066&root=/cvs/gnome#1.2066"); ?>
<?php taskrow ("Default free/busy URI", "Calendar", "Novell", "300", "127541", "http://bugzilla.gnome.org/attachment.cgi?id=34969&action=view"); ?>
<?php taskrow ("Attachment bar and drag-and-drop in the composer", "Mailer", "Novell", "500", "127527", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004052.html"); ?>
<?php taskrow ("Better smiley substitution in the composer", "Mailer", "Novell", "200", "127533", "http://bugzilla.gnome.org/attachment.cgi?id=21716&action=view"); ?>
<?php taskrow ("Make Evolution Use the gnome-icon-theme", "Miscellaneous", "Novell", "500", "127812", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=22699"); ?>
<?php taskrow ("Gaim drag and drop file transfer", "IM", "Novell", "400", "127547", "http://sourceforge.net/tracker/index.php?func=detail&aid=1062630&group_id=235&atid=300235"); ?>
<?php taskrow ("Gaim drag and drop of links", "IM", "Novell", "250", "127548", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=23279"); ?>
<?php taskrow ("Handle <tt>aim:</tt> links in Firefox", "IM", "Novell", "100", "127549", "http://bugzilla.gnome.org/attachment.cgi?id=30442"); ?>
<?php taskrow ("Message receipts", "Mailer", "Novell", "500", "127534", "http://lists.ximian.com/archives/public/evolution-patches/2005-April/010399.html"); ?>
<?php taskrow ("Link URLs in the status bar", "Mailer", "Novell", "200", "127536", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/003949.html"); ?>
<?php taskrow ("Remove duplication of desktop backgrounds", "Optimization", "Novell", "200", "169347", "http://bugzilla.gnome.org/attachment.cgi?id=38926"); ?>
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

