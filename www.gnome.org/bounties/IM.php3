<?php

include ("./util.php");

?>

<?php write_page_header ("IM Bounties"); ?>
<?php write_table_header ("no"); ?>
<?php taskrow ("Gaim/Evolution presence integration", "hidden", "2000", "127546", ""); ?>
<?php taskrow ("Gaim drag and drop file transfer", "hidden", "400", "127547", ""); ?>
<?php taskrow ("Gaim drag and drop of links", "hidden", "250", "127548", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=23279"); ?>
<?php taskrow ("Handle <tt>aim:</tt> links in Epiphany", "hidden", "100", "127549", ""); ?>
<?php write_table_footer (); ?>
<?php box_start ("Gaim/Evolution presence integration", "IM", "2000", "127546", "127546", ""); ?>


<p>We want the notion of &quot;presence&quot; to be integrated into
the entire desktop, wherever the user encounters a person or a
reference to a person.</p>

<p>Providing a simple integrated presence concept in the mailer and
addressbook user interfaces is a step in this direction.</p>

<p>Post-2.0, Evolution will begin to integrate presence functionality
into the backend addressbook APIs.  That means that given a contact,
you'll be able to programmatically ask the addressbook questions like:
&quot;Is this user online?&quot; and &quot;How can I send him a
file?&quot;</p>

<p>That is our eventual goal.  This task is focused on more surface,
frontend integration.</p>

<p>This item has several subtasks, all of which involve displaying an
icon somewhere in Evolution to indicate whether a person is online or
not, and to allow the user to click on this icon to open an IM
conversation window with the person concerned.</p>

<p>And so, the first challenge is to have a simple, general mechanism
for displaying <b>presence icons</b>.</p>

<table border=1 align=right>
<tr>
<td width="33%"><center><img border=0 src="buddy-online.png" alt="Online icon"><br><tt>online</tt></center></td>
<td width="33%"><center><img border=0 src="buddy-offline.png" alt="Offline icon"><br><tt>offline</tt></center></td>
<td width="33%"><center><img border=0 src="buddy-away.png" alt="Away icon"><br><tt>away</tt></center></td>
</tr>
<tr>
<td colspan=3><i><font size=-4>You don't have to use exactly these icons or exactly these meanings. This is just to give a general idea, and an example of what to use in case the user doesn't have a buddy icon set. We can design better suitable icons if needed.</font></i></td>
</tr>
</table>

<p>The presence icon could be the "Buddy Icon" from Gaim. It
represents the other person well since everyone can control and update
their own buddy-icon.  We can show online/offline/away status with a
text label below the icon, plus for "away" we can desaturate the icon
and make it 50% transparent.  Examples are below.</p>

<p align=center><img src="online-offline-evo.png" alt=""></p>

<p>The Presence Icon can be used to invoke the appropriate gaim-remote
mechanisms to pop up an IM window with the user.</p>

<p>Evolution 2.0's addressbook allows the user to set a custom picture
for an addressbook entry.  This custom image should override the buddy
icon if it is set.</p>

Here are the places where a presence icon should be added to
Evolution:

<ol>

<li>In the message view (the window or pane displaying the contents of
a single mail message), display a full-size presence icon next to the
sender's name.<br>

<p align="center"><img src="imstatus-mailmessage.png" alt=""></p></li>

<li>Put a small presence icon next to names in the To:, Cc: and Bcc:
fields in the message composer window.  Buddy icons should also appear
for the relevant names in the recipient picker dialog, message
summaries, and preview panes.  Anywhere that currently displays "Foo
Bar &lt;foo@bar.com&gt;" could be extended to display "[ ] Foo Bar
&lt;foo@bar.com&gt;".  And again, clicking on these icons should pop
up a small floating dialog (like you get when right clicking an email
address in evolution) - and it lists you actions for sending IM messages
and such.<br>

<p align="center"><img src="imstatus-mailcomposer.gif" alt=""></p></li>

<li> Add a presence status field to the address book, so that the user
knows when a contact is online via IM, and can click to send an
instant message.  This field should be viewable in the minicard view
as the contact's buddy icon, in the list view as a separate column,
and in the contact editor dialog.</li>

</ol>

<?php box_sec ("Affected Modules"); ?>

Both <? bonsai ("evolution"); ?> and <? bonsai ("gaim"); ?> are affected.

<?php box_sec ("How"); ?>

<p> 

First you will need to allow Evolution to determine if someone is
online. You may wish to work with <a STYLE="text-decoration:none" 
href="http://cvs.sourceforge.net/viewcvs.py/gaim/gaim/src/gaim-remote.c?view=markup"><tt>gaim-remote</tt></a>,
a command-line tool which communicates with a running gaim process
over a local Unix domain socket.  </p>

<p>You will want to extend the <tt>gaim-remote</tt> protocol to
support the &quot;<tt>ison</tt>&quot; mechanism.  You may also want to
separate <tt>gaim-remote</tt> into a library, maybe called
<tt>libgaimremote</tt> and a front-end command line tool.  Evolution
and <tt>gaim-remote</tt> will both use <tt>libgaimremote</tt>, which
should expose a non-blocking API.</p>

<p>On top of this library, you will want to build a widget which
handles all the rendering and interaction associated with a presence
icon.  This widget could probably exist inside Evolution at first,
though eventually it would be ideal if it were available to the entire
desktop.</p>

<p>Then you need to use this API to add the icons to various places where
addresses are displayed and formatted, including:
<p>
<dl>

<dt><?php bonsai ("evolution/addressbook/gui/component/select-names"); ?></dt>

<dd>This is used by the mail composer for the to/cc/bcc entry
widgets.  This will need to be extended to include the presence widget
for each name entered.
</dd>

<dt><?php bonsai ("evolution/mail/e-format-html-display.c"); ?></dt>
<dd>This formats messages for display.  You will have to output a tag
for a custom object, and in the object return handler, setup the
presence widget.
<b>NOTE:</b> All formatting operations are
done from a separate thread so no non-formatting logic can be
performed there.
</dd>
</dl>

<?php box_sec ("Pointers"); ?>

For Evolution information, join the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">Evolution
Hackers</a> mailing list.  You'll find Gaim resources at <a STYLE="text-decoration:none" 
href="http://gaim.sf.net">the Gaim home page</a>.

Some fun presence-related links, for your amusement:

<ul>
<li><a STYLE="text-decoration:none" href="http://www.nwfusion.com/links/Encyclopedia/P/802.html">general information</a> </li>
<li><a STYLE="text-decoration:none" href="http://www.aiai.ed.ac.uk/project/akt/coakting/documents/2002/wace02-figs/presence-radar.jpg">presence radar</a></li>
<li><a STYLE="text-decoration:none" href="http://research.sun.com/research/netcomm/rhythmAwareness.html">rhythm awareness</a></li>
</ul>

<?php box_end (); ?>
<?php box_start ("Gaim drag and drop file transfer", "IM", "400", "127547", "127547", ""); ?>


<p>For those protocols that support it, Gaim allows you to send and
receive files with other IM users.  Currently, you have to right click
on the user in the Gaim buddy list and select the &quot;Send
file&quot; popup menu entry to send the user a file.</p>

<p>This task is to modify Gaim to support drag-and-drop as a means of
initiating a file transfer to a user.  Dragging a file from the file
manager or desktop and dropping it onto a Gaim conversation window
should initiate a transfer of that file to the user.</p>

<p>One subtlety is how <tt>.desktop</tt> files are handled.  The
contents of the <tt>.desktop</tt> file are probably not what the user
wants to send, so you'll have to figure out how to handle these.</p>

<?php box_end (); ?>
<?php box_start ("Gaim drag and drop of links", "IM", "250", "127548", "127548", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=23279"); ?>


<p>This one is pretty straightforward: Make it so that dragging a URL
from the browser or the desktop onto a Gaim conversation window copies
the URL into the text of the conversation.</p>

<?php box_end (); ?>
<?php box_start ("Handle <tt>aim:</tt> links in Epiphany", "IM", "100", "127549", "127549", ""); ?>


The <a STYLE="text-decoration:none" 
href="http://cvs.sourceforge.net/viewcvs.py/gaim/gaim/src/gaim-remote.c?view=markup"><tt>gaim-remote</tt></a>
command-line tool makes it easy to remotely open a conversation with a
buddy.  Your job is pretty easy: set the default protocol handler for
<tt>aim:</tt> to be <tt>gaim-remote</tt>.

<?php box_end (); ?>
<?php write_page_footer (); ?>

</center>
</body>
</html>
