<?php

include ("./util.php");

?>

<?php write_page_header ("Bounty Winners"); ?>
<?php write_table_header ("yes"); ?>
<?php taskrow ("Panel clock/calendar integration", "Calendar", "1000", "127532", "http://www.gnome.org/~markmc/clock-evo-integration.diff"); ?>
<?php taskrow ("Birthday and anniversary calendar backend", "Calendar", "500", "127535", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004082.html"); ?>
<?php taskrow ("Gaim/addressbook identity integration", "Addressbook", "2500", "127513", "http://www.chipx86.com/gevolution/"); ?>
<?php taskrow ("Set wallpaper from mailer", "Mailer", "100", "127514", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=22642"); ?>
<?php taskrow ("Finish NNTP support in Evolution", "Mailer", "750", "127519", "http://home.wanadoo.nl/meilof/evolution-nntp-patch-17"); ?>
<?php taskrow ("Custom mail headers display", "Mailer", "200", "127523", "http://lists.ximian.com/archives/public/evolution-patches/2003-December/003697.html"); ?>
<?php taskrow ("Contact search applet", "Addressbook", "750", "127522", "http://www.burtonini.com/computing/contact-lookup-applet-0.4.tar.gz"); ?>
<?php taskrow ("Publish free/busy information", "Calendar", "500", "127539", "http://cvs.gnome.org/bonsai/cvslog.cgi?file=evolution%2Fcalendar/ChangeLog&rev=1.2066&root=/cvs/gnome#1.2066"); ?>
<?php taskrow ("Attachment bar and drag-and-drop in the composer", "Mailer", "500", "127527", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004052.html"); ?>
<?php taskrow ("Gaim drag and drop of links", "IM", "250", "127548", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=23279"); ?>
<?php taskrow ("Link URLs in the status bar", "Mailer", "200", "127536", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/003949.html"); ?>
<?php write_table_footer (); ?>
<?php box_start ("Panel clock/calendar integration", "Calendar", "1000", "127532", "127532", "http://www.gnome.org/~markmc/clock-evo-integration.diff"); ?>

<p>When you click on the clock on the GNOME panel, a little calendar
descends.  A proper integration patch for this calendar would do the
following:</p>
<img border=0 align=right src="panel-calendar.png" alt="">

<ul> 
<li>Highlight in bold the days which have appointments.</li><br>
<li>Below the calendar, show a small summary of the appointments on the selected day.</li><br>
<li>Double clicking on a day opens the Evolution calendar to that day.</li><br>
<li>Aggregate multiple calendars, with a configuration dialog to select which calendars to aggregate.</li><br>
<li>Redo the QuickAlarm frame <a href="http://patches.ximian.com/download.cgi?object=gnome-panel-clock.patch-3">patch</a> to take up less space.</li>
</ul>

<?php box_sec ("How"); ?>

There is code in gnome-cal.c and tag-calendar.c which is in <? bonsai
("evolution/calendar/gui/"); ?> to tag the mini calendar in Evolution,
which should serve as a useful starting point.  Essentially you will
need to create an ECalView (see <?php bonsai
("evolution-data-server/calendar/libecal"); ?>, and monitor it to
track the changes.  You can create a different ECalView for the
current day to get the list of events for the day and monitor them if
there are changes.

 <?php box_sec ("Affected Modules"); ?>
 
The clock applet is part of the <? bonsai ("gnome-panel"); ?> 
module. You will need to make use of the new calendar APIs in <?
bonsai ("evolution-data-server/calendar/libecal"); ?>.

<?php box_sec ("Pointers"); ?>

You may find this <a href="clock-calendar.tar.bz2">glade mockup</a> useful.

<?php box_end (); ?>
<?php box_start ("Birthday and anniversary calendar backend", "Calendar", "500", "127535", "127535", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004082.html"); ?>


<p>Evolution's contact editor allows you to annotate a contact with
the dates of their birthday and anniversary.  However, these dates <a
href="contact-bday.png"><img border=0 align=right
src="contact-bday-thumb.png" alt=""></a> don't automatically copy themselves
into your calendar.  Unless you explicitly add the dates to your
calendar, you won't see them when you glance through your schedule,
and an alarm won't fire to warn you of a friend's upcoming
birthday.</p>

<p>Clearly, this is a travesty.</p>

<p>The right solution is to create a special calendar backend which
reads birthdays and anniversaries out of the user's addressbook.
Using Evolution 2.0's calendar aggregation feature, the user can then
overlay a friend's important life events into the calendar view by
clicking a single checkbox.</p>

<?php box_sec ("Affected Modules"); ?>

The only module affected will be <? bonsai ("evolution"); ?>.

<?php box_sec ("Pointers"); ?>

Start by joining the <a
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">Evolution
Hackers</a> mailing list.

<?php box_end (); ?>
<?php box_start ("Gaim/addressbook identity integration", "Addressbook", "2500", "127513", "127513", "http://www.chipx86.com/gevolution/"); ?>



<p>Gaim should be able to synchronize its buddy lists with the
Evolution addressbook. You will need to decide the details of this
work and discuss them with the other Gaim and Evolution
developers. Some beginning features:</p>

<ul>
<li>Auto-add buddies to your buddy list if their IM fields exist in  Evolution.</li>
<li>Auto-add buddies to your addressbook when you add them to your buddy list in Gaim. 
<li>Allow a user to select an addressbook entry that corresponds to a
buddy, which will fill the IM field of that addressbook entry. This
might work better if you can use the minicard widget and display a
list of minicards.</li>
<li>For extra credit: Allow the user to drag and drop buddies and
contacts between Gaim and Evolution.</li>
</ul>

<p>When the user clicks on the "Add Buddy" button in Gaim, or selects
the "Add a buddy" menu item, a dialog should appear allowing him to
select someone from his addressbook:</p>

<center>
<img src="IM-addbuddy1.png"><br>
</center>

<p>A separate entry should appear for each IM account a contact has,
so that the user can choose to add someone's AIM account to the buddy
list, for example, but not his Yahoo account.</p>

<p>If the user clicks on the "New Person" button, he gets prompted to
add a new contact and buddy at the same time:</p>

<center>
<img src="IM-addbuddy2.png"><br>
</center>

<p>Entering the contact's IM account information is required.
Entering his contact information is optional.</p>

<p>This same dialog will pop up if the user hits "Select Buddy" for a
contact whose IM information is not available in the Evolution
addressbook.  The user will have the opportunity to fill in the IM
information for that person, which will then be added to the Evolution
addressbook and the buddy list at the same time.</p>

<center>
<img src="IM-addbuddy3.png"><br>
</center>

<p>When "Add Buddy" is clicked, the person's IM account name is added to
the buddy list, and a new contact is added to the Evolution
addressbook.</p>

<?php box_sec ("Affected Modules"); ?>

Both <? bonsai ("evolution"); ?> and <a href="http://gaim.sf.net/">gaim</a> are affected.

<?php box_sec ("Pointers"); ?>

For Evolution information, join the <a
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">Evolution
Hackers</a> mailing list.  You'll find Gaim resources at <a
href="http://gaim.sf.net">the Gaim home page</a>.

<?php box_end (); ?>
<?php box_start ("Set wallpaper from mailer", "Mailer", "100", "127514", "127514", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=22642"); ?>


<p>
It would be handy to be able to set the desktop background picture
directly from images displayed in Evolution.
</p>

<p align="center"><img src="set-as-wallpaper.png" alt="" /></p>

<?php box_sec ("How"); ?>

<p>
In em-popup.c there is already a hook for this, but unimplemented (see
emp_part_popup_set_background).  The menu item will automatically be
added to any image or image attachment referenced from a context menu.
The guts merely needs to be implemented.
</p>
<ul>
<li>You have access to the message part in the EMPopupTarget of type EM_POPUP_TARGET_PART of the popup target.
<li>There are message saving routines in em-utils.[ch], although you may need to add a new api
to save to a specific file, if GNOME wont copy a temporary file
<li>You then need to notify the GNOME Desktop of the new backdrop file (how?)
</ul>

<?php box_sec ("Affected Modules"); ?>

<? bonsai ("evolution/mail") ?>

<?php box_sec ("Pointers"); ?>

<p>
You should subscribe to the <a
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list.
<p>
GNOME Desktop programming and mailing list information is available on
<a href="http://developer.gnome.org/">developer.gnome.org</a>
</p>

<?php box_end (); ?>
<?php box_start ("Finish NNTP support in Evolution", "Mailer", "750", "127519", "127519", "http://home.wanadoo.nl/meilof/evolution-nntp-patch-17"); ?>


<p>
Evolution has some initial NNTP (NEWS, or NNRP) support, but it is incomplete.
This task is to fill out the NNTP implementation and provide a
suitable user-interface for managing NNTP sessions.
<p>
This would help us get more adoption of Evolution inside the
OpenOffice team, since they use news for all their internal
discussions.
</p>

<?php box_sec ("Affected Modules"); ?>

<ul>
<li><? bonsai ("evolution/camel/providers/nntp"); ?>, is the existing
NNTP implementation, which should be extended/completed, rather than
being rewritten.
<li><? bonsai ("evolution/mail"); ?>, may need work for handling NNTP addressing.
<li><? bonsai ("evolution/composer"); ?>, similarly.
</ul>

<?php box_sec ("How"); ?>

<p>
The first aim should be to complete the CamelStore and CamelFolder
implementation of the NNTP provider.
<p>
For CamelNNTPStore, the folder list should be stored in a
CamelStoreSummary, which will require writing a CamelNNTPStoreSummary in
the same vein as CamelImapStoresummary.  It should support two modes,
one for a flat '.' separated list of folders, and another implementing
a hierarchy of folders canonicalized into '/' separated paths.
Once complete, offline operation, and the subscription interface can be implemented.
<tt>get_folder_info</tt> must also be finished, currently it doesn't
honor the path or mode arguments.
<p>
CamelNNTPFolder needs to have the append() method
implemented, which will be used to POST messages to the NNTP store.
<p>
The composer already has support for posting to folders, but it may
need additional support for NNTP addressing and cross-posting to NNTP
folders and email addresses.
</p>

<?php box_sec ("Extended functionality"); ?>

<p>CamelNNTPStoreSummary could also interact and cache standard NNTP
folder information into ~/.newsrc, to work with legacy news readers.
</p>

<?php box_sec ("Pointers"); ?>

<p>
The NNTP protocol is described in <?php rfc(977); ?>.  An
additional information RFC, <?php rfc(2980); ?> provides an
overview of commonly implemented NNTP extensions.
<p>
You should subscribe to the <a
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list.
</p>

<?php box_end (); ?>
<?php box_start ("Custom mail headers display", "Mailer", "200", "127523", "127523", "http://lists.ximian.com/archives/public/evolution-patches/2003-December/003697.html"); ?>


<p>As in <?php bug(1186); ?>, it would be nice to configure the header
display to show different default headers, merely as a convenience to
users.</p>

<p align="center">
<img border=0 src="mail-custom-header.png" alt="">
</p>

<?php box_sec ("Affected Modules"); ?>

<p>
Various files in <? bonsai ("evolution/mail"); ?>.
</p>

<?php box_sec ("How"); ?>

<p>
EMFormat already has api for setting which headers are displayed
by default, so most of the backend work is already done.  What is
required is a GUI for configuring the options, and glue to store the
options.
<p>
The configuration GUI should be a new tab on the Mailer Settings page.
A new tab should be created in the glade file
<? bonsai ("evolution/mail/mail-config.glade"); ?>, and hooked into
<? bonsai ("evolution/mail/em-mailer-prefs.c"); ?>, and it should store
the options in a gconf key under &quot;/apps/evolution/mail/display&quot;, for
example <b>&quot;headers&quot;</b>.  The key should be a simple string
array.
<p>
<? bonsai ("evolution/mail/em-folder-view.c"); ?> is used to listen to
configuration changes used by EMFormat, <tt>emfv_setting_notify</tt> needs to
be extended to include the new gconf key to manage the header list.
<p>
A FIXME in
<? bonsai ("evolution/mail/em-format.c"); ?><tt>:emf_format_clone</tt>
needs to be finished to complete the task so the headers displayed are
properly honored for printing and redisplays.
</p>

<?php box_sec ("Extended functionality"); ?>

<p>EMFormat (and EMFormatHTML) also defines properties for each
header (e.g. <b>BOLD LABEL</b>).  These could be added to the
configuration page and configuration key, and even extended.
</p>

<?php box_sec ("Pointers"); ?>

<p>
You should subscribe to the <a
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list.
</p>

<?php box_end (); ?>
<?php box_start ("Contact search applet", "Addressbook", "750", "127522", "127522", "http://www.burtonini.com/computing/contact-lookup-applet-0.4.tar.gz"); ?>


<p>
A panel applet where you can type in a search term and get matching contact cards. The
applet should reside in its own package, not in Evolution proper.
</p>

<img src="address-applet-anim.gif">

<p>
Once the wanted person is found in the list, one can click on it and the following
popup window is shown with the address card and some relevant action buttons.
</p>

<img src="address-applet-popup.png">

<p>
If the user is not online, one should just display the label as <b>"GFlash is not online."</b>
</p>

<?php box_sec ("How"); ?>

Most of this task revolves around writing a panel applet and GUI. The rest involves contacting
<? bonsai ("evolution-data-server"); ?>, and getting contact information from that. A useful starting point
is <? bonsai ("evolution-data-server/addressbook/libebook"); ?>, and the interfaces you'll find there.

<?php box_end (); ?>
<?php box_start ("Publish free/busy information", "Calendar", "500", "127539", "127539", "http://cvs.gnome.org/bonsai/cvslog.cgi?file=evolution%2Fcalendar/ChangeLog&rev=1.2066&root=/cvs/gnome#1.2066"); ?>


<p><?php rfc(2445); ?> describes a method of describing free/busy
information (VFREEBUSY components).  Evolution currently
can only publish free/busy information via email attachments.
</p>

<p> Evolution should support publishing free/busy information to an
http:// type URL, as discussed in <?php bug(16567); ?>.</p>

<?php box_sec ("How"); ?> <p>

<p>
There should be a configuration control (see cal-prefs-dialog in <?php
bonsai ("evolution/calendar/gui/dialogs"); ?> for an example) that
allows the user to setup the URLs to publish to and which calendars to
use for creating the free/busy information.  There should be a
configuration option for the user to detail when they want their
calendar published, ie "Every Day", and Evolution should endeavor to
do this.  There should also be a menu option added to the calendar to
allow the user to publish the information whenever desired.
</p>

<p>
  To actually obtain the free/busy information, you simply need to call
e_cal_get_free_busy in <?php bonsai("evolution-data-server/calendar/libecal"); ?>, 
see calendar-commands.c in  <?php bonsai ("evolution/calendar/gui/"); ?> for an example of this.

<?php box_sec ("Pointers"); ?>

<p>
You should subscribe to the <a
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  JP Rosevear &lt;<a
href="mailto:jpr@ximian.com">jpr@ximian.com</a>&gt; and Hans Petter Jansson 
&lt;<a href="mailto:hpj@ximian.com">hpj@ximian.com</a>&gt;
will be the primary contacts on the list for the Calendar.
</p>

<?php box_end (); ?>
<?php box_start ("Attachment bar and drag-and-drop in the composer", "Mailer", "500", "127527", "127527", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004052.html"); ?>

<p>
Currently, to drag and drop a file into an Evolution message, you
must drop it outside the message body. To make it easier to
attach files via drag and drop, we would like to make the attachments
bar more visible.
</p>

<?php box_sec ("How"); ?>

<p>
<img alt="attachments bar mockup" src="composer-attachments.gif" />
</p>

<p>
First you will need to add an arrow widget with a label saying
&quot;Show/Hide Attachments Bar (drop attachments here)&quot;. When
the arrow is pressed it should show/hide the attachment bar as shown
in the animation.
</p>

<p>
When you drag a file over that arrow or label, the attachment bar
should be shown. Note that an <u>A</u> accelerator (M-a) should toggle
the attachment bar visibility. The direction of the arrow widget
should change depending on the attachment bar visibility.
</p>

<p>
Once there are files attached, it will be indicated on the right side
by an attachment icon and a label saying: &quot;%d File(s)
Attached&quot;, where %d will be substituted by the number of attached
files to that message (as shown in the animation).
</p>

<?php box_sec ("Affected Modules"); ?>
<p>
This will require work in Evolution's composer (<?php
bonsai("evolution/composer");?>), which is part of the Mailer
component. You will need an understanding of Gtk+ and especially of
Gtk's drag-and-drop API.
</p>

<?php box_sec ("Pointers"); ?>

<p>
You should subscribe to the <a
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list for the Mailer. Larry Ewing
&lt;<a href="mailto:lewing@ximian.com">lewing@ximian.com</a>&gt; and
Radek Doulik &lt;<a
href="mailto:rodo@ximian.com">rodo@ximian.com</a>&gt; might help you
with composer knowledge as well.
</p>

<?php box_end (); ?>
<?php box_start ("Gaim drag and drop of links", "IM", "250", "127548", "127548", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=23279"); ?>


<p>This one is pretty straightforward: Make it so that dragging a URL
from the browser or the desktop onto a Gaim conversation window copies
the URL into the text of the conversation.</p>

<?php box_end (); ?>
<?php box_start ("Link URLs in the status bar", "Mailer", "200", "127536", "127536", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/003949.html"); ?>


<p>Evolution should make URLs embedded in emails visible to the user.
When the user tabs to, or hovers the mouse over a link in an email,
Evolution should show the selected URL in the status bar.

<p>The URLs should be displayed in a friendly way to the user.  For
example, "mailto:foo@bar.com" should display: "Click to send mail to
foo@bar.com".  Other URLs, like "http://www.foobar.com/", should
display the message: "Click to open http://www.foobar.com/".

<p>The URL could be shown in the status bar.  However, the message
window does not yet have an associated status bar.  The message window
would need a status bar in order to work correctly.

<p align="center">

<img alt="" src="evo-tooltip.png" />

</p>

<?php box_sec ("Affected Modules"); ?>

<p>This bounty requires changes to the mailer and shell.</p>

<?php box_sec ("Pointers"); ?>

<p>The GtkHTML widget emits an <tt>on_url</tt> signal when the user
mouses over a URL. <?php bug(3383); ?> has some more discussion of
this bug (though some of it may be specific to APIs that are changing
in 2.0).</p>

<?php box_end (); ?>
<?php write_page_footer (); ?>

</center>
</body>
</html>
