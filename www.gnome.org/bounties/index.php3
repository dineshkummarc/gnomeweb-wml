<?php

include ("./util.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
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

<body bgcolor="#ffffff" text="#000000" onLoad="defaultSort()">

<p>
<center>
<b><font size="+2">Desktop Integration Bounty Hunt</font></b><br><br>
</center>

<?php box_start ("Summary"); ?>

Welcome to the first-ever open source desktop bounty hunt!  <p>

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
work, fill out the <a href="claim.php3">claim form</a>, and collect the
bounty.

<p>

<?php box_end (); ?>

<?php box_start ("Contest Rules"); ?>

<ol>

<li>All submissions must be open source, without any known
intellectual property encumbrances that might stop the submission from
being distributed as free software.</li><br>

<li>Patch acceptance by module maintainers into the main development
branch of the affected modules is a prerequisite for bounty payment.
For example, for <a
href="http://www.gnome.org/projects/evolution">Evolution</a>, this
means that your patch must be reviewed (through <a
href="">evolution-patches</a>), accepted and checked into the 2.0
development branch before you qualify to receive a bounty.</li><br>

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

<li>At the top of each bounty item, in the little header, there's a
link to a bug in bugzilla.gnome.org.  If you intend to work on a
bounty, please add a comment to this bug registering your intent to
work on it.  That way, if multiple people want to work on the same
task, they can more easily find each other and collaborate.  Please do
not close this bug; it will be marked <tt>FIXED</tt> by the contest
organizers when the prize is claimed.</li><br>

<li>In the case of multiple submissions for the same bounty, the
judging panel will do its best to choose the highest-quality
submission and award a bounty to the submitter responsible for
it.</li><br>

<li>Submissions by a group are not allowed.  If you want to work on
these tasks as a team, appoint one person you trust to be the official
submitter, and he or she can divide the bounty up after it is
awarded.</li><br>

<li>And, sorry to have to do it, but the catch-all: The awarding of
bounties is at the sole discretion of the judging panel, and we may
refuse to award a bounty to anyone for any reason at any time.  <p>
But we're good people, so as long as you play nice, we will too.</li>

</ol>

<?php box_end (); ?>

<?php box_start ("Helpful Hints"); ?>

<p>Before you begin, visit the web pages of the modules you need to
modify and do your best to learn how they work on your own.  Good
hackers are good learners; if you're not familiar with the way the
code you're hacking works, read through any available documentation,
check out the mailing list archives, and browse the code.  Do this
<i>before</i> you start asking questions of the individual developers.
This contest is going to attract a lot of attention and we don't want
to overrun the hackers with newbie questions.</p>

<p>Once you've done this, go ahead and check with developers to learn
about their individual patch acceptance policies. In the case of
Evolution, that means reading the <a
href="http://developer.ximian.com/projects/evolution/contributing.html">developer
contributions page</a> and <a
href="http://developer.ximian.com/projects/evolution/patch_guidelines.html">patch
guidelines</a>.  </p> <p> To build / hack on OpenOffice.org, see <a
href="http://ooo.ximian.com/"> ooo.ximian.com</a> for instructions on
getting started, patch generation / submission and IRC in the
hackers-guide.  </p>

<p> Some of the projects in this contest require a lot of work in
multiple modules, and may be difficult for one person to complete.
You might want to hang out on the IRC channels for the various
affected projects and find other people to team up with for some of
the particularly arduous bounties.  Working as a team can offer you a
big advantage.  Then, appoint one person to apply for and collect the
bounty. It is important that it is only one person- we will not deal
with multiple people and the responsibility of dividing up a bounty.
That person can distribute the prize to everyone else on your team, as
you see fit.  </p>

<p>There will be an IRC channel on <b>irc.gimp.org</b> for the bounty
hunt; you can hang out with us there on <b>#bounties</b>.  This will
be a good place to ask questions about the contest and to find other
people to work with.  For specific technical questions about a given
module, you should use that module's mailing lists and IRC
channels.</p>

<?php box_end (); ?>

<a name="categories">
<?php box_start ("Bounty Categories"); ?>
<table width="100%" cellpadding=12>
	  <tr>
	    <td align="center">
	      <a href="Addressbook.php3"><img src="addressbook-icon.png" 
					alt="" border=0><br>
		    <b>Addressbook</b></a>
	    </td>
	    <td align="center">
	      <a href="Calendar.php3"><img src="calendar-icon.png" 
						  alt="" border=0><br>
		    <b>Calendar</b></a>
	    </td>
	    <td align="center">
	      <a href="Documentation.php3"><img src="documentation-icon.png" 
						  alt="" border=0><br>
		    <b>Documentation</b></a>
	    </td>
	    <td align="center">
	      <a href="IM.php3"><img src="im-icon.png" 
						       alt="" border=0><br>
		    <b>IM</b></a>
	    </td>
	    <td align="center">
	      <a href="Mailer.php3"><img src="mailer-icon.png" 
						       alt="" border=0><br>
		    <b>Mailer</b></a>
	    </td>
	    <td align="center">
	      <a href="Miscellaneous.php3"><img src="miscellaneous-icon.png" 
						       alt="" border=0><br>
		    <b>Misc.</b></a>
	    </td>
	  </tr>
	  <tr>
	    <td align="center">
	      <a href="OpenOffice.org.php3"><img src="openoffice-icon.png" 
						       alt="" border=0><br>
		    <b>OpenOffice.org</b></a>
	    </td>
	    <td align="center">
	      <a href="Tasks.php3"><img src="tasks-icon.png" 
						       alt="" border=0><br>
		    <b>Tasks</b></a>
	    </td>
	  </tr>
</table>
</center>
<?php box_end (); ?><a name="table">
<?php write_table_header ("yes"); ?>
<?php taskrow ("National, religious, event calendars", "Calendar", "15", "127528"); ?>
<?php taskrow ("Panel clock/calendar integration", "Calendar", "1000", "127532"); ?>
<?php taskrow ("Birthday and anniversary calendar backend", "Calendar", "500", "127535"); ?>
<?php taskrow ("Gaim/addressbook identity integration", "Addressbook", "2500", "127513"); ?>
<?php taskrow ("Gaim/Evolution presence integration", "IM", "2000", "127546"); ?>
<?php taskrow ("Improve Nautilus &quot;Send to...&quot; feature", "Miscellaneous", "1500", "127551"); ?>
<?php taskrow ("Addressbook/videoconferencing integration", "Addressbook", "500", "127515"); ?>
<?php taskrow ("&quot;Me&quot;", "Addressbook", "300", "127517"); ?>
<?php taskrow ("Planner (formerly MrProject) integration", "Addressbook", "300", "127520"); ?>
<?php taskrow ("Set wallpaper from mailer", "Mailer", "100", "127514"); ?>
<?php taskrow ("Implement a panel notification applet for new mail", "Mailer", "400", "127516"); ?>
<?php taskrow ("Mailing list actions", "Mailer", "500", "127518"); ?>
<?php taskrow ("Finish NNTP support in Evolution", "Mailer", "750", "127519"); ?>
<?php taskrow ("Inline PGP support for evolution", "Mailer", "250", "127521"); ?>
<?php taskrow ("Custom mail headers display", "Mailer", "200", "127523"); ?>
<?php taskrow ("Contact search applet", "Addressbook", "750", "127522"); ?>
<?php taskrow ("Support export of tasks or other items to Excel (CSV)", "Tasks", "300", "127557"); ?>
<?php taskrow ("Choice of database for contacts back-end", "Addressbook", "250", "127524"); ?>
<?php taskrow ("Evolution/iPod synchronization", "Miscellaneous", "500", "127552"); ?>
<?php taskrow ("Bugzilla tasks backend", "Tasks", "500", "127558"); ?>
<?php taskrow ("Weather calendar backend", "Calendar", "750", "127537"); ?>
<?php taskrow ("Advanced LDAP Configuration", "Addressbook", "250", "127525"); ?>
<?php taskrow ("Outlook-Evolution dictionary", "Documentation", "300", "127544"); ?>
<?php taskrow ("Publish your calendar", "Calendar", "1000", "127538"); ?>
<?php taskrow ("Quick reference card", "Documentation", "300", "127545"); ?>
<?php taskrow ("Ask user to make Evolution default mail app", "Mailer", "100", "127526"); ?>
<?php taskrow ("Drag-n-drop task creation", "Tasks", "300", "127559"); ?>
<?php taskrow ("OO.o slide view performance", "OpenOffice.org", "500", "127554"); ?>
<?php taskrow ("OO.o slides side-pane", "OpenOffice.org", "1500", "127555"); ?>
<?php taskrow ("OO.o Image Save", "OpenOffice.org", "300", "127556"); ?>
<?php taskrow ("OO.o Calc - function precision", "OpenOffice.org", "500", "127771"); ?>
<?php taskrow ("Publish free/busy information", "Calendar", "500", "127539"); ?>
<?php taskrow ("Default free/busy URI", "Calendar", "300", "127541"); ?>
<?php taskrow ("Calendar attachments", "Calendar", "750", "127543"); ?>
<?php taskrow ("Attachment bar and drag-and-drop in the composer", "Mailer", "500", "127527"); ?>
<?php taskrow ("Templates for new messages and replies", "Mailer", "500", "127529"); ?>
<?php taskrow ("Language selection in composer", "Mailer", "400", "127530"); ?>
<?php taskrow ("Better smiley substitution in the composer", "Mailer", "200", "127533"); ?>
<?php taskrow ("Drag and Drop between Gnome and Mozilla", "Miscellaneous", "300", "127553"); ?>
<?php taskrow ("Make Evolution Use the
gnome-icon-theme", "Miscellaneous", "500", "645366955"); ?>
<?php taskrow ("Gaim drag and drop file transfer", "IM", "400", "127547"); ?>
<?php taskrow ("Gaim drag and drop of links", "IM", "250", "127548"); ?>
<?php taskrow ("Handle <tt>aim:</tt> links in Epiphany", "IM", "100", "127549"); ?>
<?php taskrow ("Message receipts", "Mailer", "500", "127534"); ?>
<?php taskrow ("Link URLs in the status bar", "Mailer", "200", "127536"); ?>
<?php write_table_footer (); ?>
<br>
<br>
<center>
<i>These pages were <a href="build.cs">autogenerated</a> using <a href="http://www.go-mono.com/">Mono</a>.</i>
</center>
</body>
</html>

