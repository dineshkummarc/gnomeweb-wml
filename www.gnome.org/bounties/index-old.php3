<?php

include ("./util.php"); ?>

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <script src="dhtml-table.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Integrated Collaborative Desktop Bounty Hunt</title>
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

<body bgcolor="#ffffff" text="#000000" onLoad="defaultSort()">

<center>This is an internal, unlaunched contest.  Go away.</center><p>
<p>
<center>
<b><font size="+2">Integrated Collaborative Desktop Bounty Hunt</font></b><br><br>
</center>

<?php box_start ("Summary"); ?>

Welcome to the first-ever open source desktop bounty hunt!  <p>

The goal of this contest is to help improve the level of integration
between the core components of a Linux desktop: <a
href="http://www.gnome.org/">GNOME</a>, Evolution, <a
href="http://www.openoffice.org/">OpenOffice.org</a> and <a
href="http://www.mozilla.org/">Mozilla</a>.

<p>

Our specific aim is to improve the <i>experience of collaboration</i>
in the desktop environment.  We believe that communicating and working
with other people is not simply a function of a single application
that sits in a rectangular window on your screen &mdash; Evolution or
Outlook, for example &mdash; but one of the primary functions of a
computer.  Therefore, collaboration should be a first-class element of
the user experience. 

<p>

Below you will find a set of concrete tasks all of which are designed
to improve collaboration in the open source desktop.  Each task has a
bounty associated with it.  Blah blah blah.  Blah blah blah.
	
<?php box_end (); ?>

<?php box_start ("Contest Rules"); ?>

<ol>

<li>All submissions must be free software, without any known
intellectual property encumbrances that might stop the submission
from being distributed as free software.</li><br>

<li>Patch acceptance by module maintainers into the main development
branch of the affected modules is a prerequisite for bounty payment.
For example, for Evolution, this means that your patch must be
reviewed (through <a href="">evolution-patches</a>), accepted and
checked into the 2.0 development branch before you qualify to receive
a bounty.</li><br>


<li>Eligible entries must be submitted and accepted by all the
applicable module maintainers before the <a
href="http://www.gnome.org/start/2.5/#UI_Freeze">GNOME 2.6 UI
freeze</a>, scheduled for January 12th, 2004.</li><br>

<li>Your patch has to work, and it has to work <i>nicely</i>. <p> "I
just got it working," or "it works most of the time," or "it works but
the UI is just a placeholder," or "what &mdash; I have to add UI?"
don't cut it.  (Some of the bounties below include UI mockups, but
these may not necessarily be the best possible solutions.)
<p> See rule #5 below for further incentive to do a
good job.</li><br>

<li>In the case of multiple submissions for the same bounty, the
judging panel will do its best to choose the highest-quality
submission and award a bounty to the submitter responsible for
it.</li><br>

<li>Submissions by a group are not allowed.  If you want to work on
these tasks as a team, appoint one person you trust to be the official
submitter, and he or she can divide the bounty up after it is
awarded.</li><br>

<li>Novell employees in the Ximian division are not eligible to
participate.</li><br>

<li>And, sorry to have to do it, but the catch-all: The awarding of
bounties is at the sole discretion of the judging panel, and we may
refuse to award a bounty to anyone for any reason at any time.  <p>
But we're good people, so as long as you play nice, we will too.</li>

</ol>

<?php box_end (); ?>

<?php box_start ("Helpful Hints"); ?>

<p>
Before you begin, check with developers to learn about
their individual patch acceptance policies. In the case of Evolution,
that means reading the <a
href="http://developer.ximian.com/projects/evolution/contributing.html">developer
contributions page</a> and <a
href="http://developer.ximian.com/projects/evolution/patch_guidelines.html">patch
guidelines</a>.
</p>

<p> Some of the projects in this contest require a lot of work in
multiple modules, and may be difficult for one person to complete.
You might want to hang out on the IRC channels for the various
affected projects and find other people to team up with for some of
the particularly arduous bounties.  Working as a team can offer you a
big advantage.  Then, appoint one person from your team to apply for
and collect the bounty.  That person can distribute the prize to
everyone else on your team, as you see fit.
</p>

<?php box_end (); ?>

(The table below is sortable.)
<?php write_table_header (); ?>
<?php taskrow ("National, religious, event calendars", "Calendar", "20", "1995098470"); ?>
<?php taskrow ("Panel Clock/Calendar Integration", "Calendar", "300", "1378911023"); ?>
<?php taskrow ("Birthday and anniversary calendar backend", "Calendar", "300", "1921809678"); ?>
<?php taskrow ("Gaim/addressbook identity integration", "Addressbook", "0", "1692883674"); ?>
<?php taskrow ("Gaim/Evolution presence integration", "IM", "1000", "1744611739"); ?>
<?php taskrow ("Improve Nautilus &quot;Send to...&quot; feature", "Nautilus", "300", "1982646862"); ?>
<?php taskrow ("Addressbook/GnomeMeeting integration", "Addressbook", "0", "1892429695"); ?>
<?php taskrow ("&quot;Me&quot;", "Addressbook", "0", "603979664"); ?>
<?php taskrow ("Planner (formerly MrProject) integration", "Addressbook", "0", "1881833329"); ?>
<?php taskrow ("Finish NNTP support in Evolution", "Mailer", "0", "1189026568"); ?>
<?php taskrow ("Set backdrop picture from email", "Mailer", "trivial", "1569321676"); ?>
<?php taskrow ("Inline PGP support for evolution", "Mailer", "medium", "1229423611"); ?>
<?php taskrow ("Implement a panel notification applet for new mail", "Mailer", "0", "1001351497"); ?>
<?php taskrow ("Personal Security Services", "Developer", "0", "1796750206"); ?>
<?php taskrow ("Custom mail headers display", "Mailer", "easy", "1473904366"); ?>
<?php taskrow ("Contact search applet", "Addressbook", "0", "526101938"); ?>
<?php taskrow ("Support export of tasks or other items to Excel (CSV)", "Tasks", "0", "1532575338"); ?>
<?php taskrow ("Allow custom task fields", "Tasks", "0", "1596198436"); ?>
<?php taskrow ("Additional Conduits", "Devices", "0", "5727758"); ?>
<?php taskrow ("Notes metaphor for pilot sync", "Devices", "0", "444402437"); ?>
<?php taskrow ("Choice of database for contacts back-end", "Addressbook", "0", "1377785968"); ?>
<?php taskrow ("Initial position of message list", "Mailer", "0", "2087315781"); ?>
<?php taskrow ("Evolution/iPod Synchronization", "Devices", "0", "2135118480"); ?>
<?php taskrow ("Bugzilla tasks backend", "Tasks", "300", "1004949216"); ?>
<?php taskrow ("Weather Calendar Backend", "Calendar", "300", "1165323902"); ?>
<?php taskrow ("Advanced LDAP Configuration", "Addressbook", "0", "1026773829"); ?>
<?php taskrow ("Outlook-Evolution dictionary", "Documentation", "0", "1608521083"); ?>
<?php taskrow ("Publish Calendar as 'webcal' and HTML", "Calendar", "0", "568000143"); ?>
<?php taskrow ("Quick Reference Card", "Documentation", "0", "310877768"); ?>
<?php taskrow ("Ask user to make Evolution default mail app", "Mailer", "0", "1907178199"); ?>
<?php taskrow ("Gerardo's from bugzilla", "Miscellaneous", "0", "1906422576"); ?>
<?php taskrow ("OO.o / Evo addressbook integration", "OpenOffice.org", "500", "1283999169"); ?>
<?php taskrow ("OO.o slide view performance", "OpenOffice.org", "50", "1265539869"); ?>
<?php taskrow ("OO.o slides side-pane", "OpenOffice.org", "100", "1282533697"); ?>
<?php taskrow ("OO.o Image Save", "OpenOffice.org", "0", "1503343361"); ?>
<?php taskrow ("OO.o / Evolution Cut and Paste", "OpenOffice.org", "0", "1199958537"); ?>
<?php taskrow ("Internet Free/Busy Support", "Calendar", "0", "409914292"); ?>
<?php taskrow ("Event Attachments", "Calendar", "0", "2027141866"); ?>
<?php taskrow ("Drag and drop printing in Nautilus printers: view", "Nautilus", "0", "2090428571"); ?>
<?php taskrow ("timezone clock support", "Miscellaneous", "0", "804953558"); ?>
<?php taskrow ("Attachment drag-and-drop to the composer", "Mailer", "0", "1862899925"); ?>
<?php taskrow ("Language selection in composer", "Mailer", "0", "1025809023"); ?>
<?php taskrow ("Better smiley substitution in the Composer", "Mailer", "0", "1434689862"); ?>
<?php taskrow ("Drag and Drop between Gnome and Mozilla", "Miscellaneous", "0", "349960467"); ?>
<?php taskrow ("Gaim remote online/offline commands", "IM", "0", "2005622967"); ?>
<?php taskrow ("Gaim drag and drop file transfer", "IM", "0", "2030952049"); ?>
<?php taskrow ("Gaim drag and drop of links", "IM", "0", "1605332622"); ?>
<?php taskrow ("handle aim: links in the browser", "IM", "0", "1441009400"); ?>
<?php taskrow ("Message Receipts", "Mailer", "???", "2003793268"); ?>
<?php write_table_footer (); ?>


</center>
</body>
</html>
