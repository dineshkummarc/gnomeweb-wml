<?php

include ("./util.php");

?>

<?php write_page_header ("Calendar Bounties"); ?>
<?php write_table_header ("no"); ?>
<?php taskrow ("National, religious, event calendars", "hidden", "15", "127528", ""); ?>
<?php taskrow ("Panel clock/calendar integration", "hidden", "1000", "127532", "http://www.gnome.org/~markmc/clock-evo-integration.diff"); ?>
<?php taskrow ("Birthday and anniversary calendar backend", "hidden", "500", "127535", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004082.html"); ?>
<?php taskrow ("Weather calendar backend", "hidden", "750", "127537", ""); ?>
<?php taskrow ("Publish your calendar", "hidden", "1000", "127538", ""); ?>
<?php taskrow ("Publish free/busy information", "hidden", "500", "127539", "http://cvs.gnome.org/bonsai/cvslog.cgi?file=evolution%2Fcalendar/ChangeLog&rev=1.2066&root=/cvs/gnome#1.2066"); ?>
<?php taskrow ("Default free/busy URI", "hidden", "300", "127541", ""); ?>
<?php write_table_footer (); ?>
<?php box_start ("National, religious, event calendars", "Calendar", "15", "127528", "127528", ""); ?>


<p>In Evolution 2.0, users can aggregate multiple simultaneous
calendar sources into a single view.  This means that you can overlay
group calendars and other people's calendars into your own calendar
view, which helps you keep others in mind while you schedule your
life.  The various backend calendars can even be color-coded in the
calendar view.</p>

<a STYLE="text-decoration:none" href="evo-webcal-1.png"><img align=right border=0 src="evo-webcal-1-small.png" alt=""></a>

<p>We would like Evolution to ship with a large number of calendars
containing the schedules for national holidays, religious holidays,
and other events of general interest.  For example, calendars of
sporting events or a Linux conference schedule would be neat.</p>

<p>Because Evolution 2.0 allows you to specify a URL to a calendar, it
is even possible for these to be hosted online and cached locally.
This might be useful for things like the GNOME release schedule.</p>

<?php box_sec ("Affected Modules"); ?>

This task probably won't involve patching any existing modules, though
we will include any accepted calendars in the <? bonsai ("evolution"); ?> module.

<?php box_sec ("How"); ?>

<p>Find and check the schedules for various types of events, and create a
calendar in the standard iCal format.  Submit the calendar file or
files, along with a short description, to <a STYLE="text-decoration:none" 
href="mailto:evolution-patches@ximian.com">evolution-patches@ximian.com</a>.</p>

<p>Until Evolution provides an 'Export' mechanism, the files should be
copied (if created in Evolution) from the Evolution2.0 tree, that is
<code>~/.evolution/calendar/local/OnThisComputer/"name"</code>, where
"name" is the name of the calendar you created.  If created in
Evolution 1.4, the file to copy is
<code>~/evolution/local/Calendar/subfolders/"name"</code>.</p>

<?php box_sec ("Pointers"); ?>

The following links might be helpful:

<ul>
<li><a STYLE="text-decoration:none" href="http://lists.ximian.com/mailman/listinfo/evolution">Evolution users list</a></li>
<li><a STYLE="text-decoration:none" href="http://www.icalshare.com/">Apple's iCalShare site</a></li>
<li><?php rfc(2445); ?>, the iCalendar specification</li>
<li>The <a STYLE="text-decoration:none" href="#28528410">calendar publication</a> task is obviously somewhat related.</li>
</ul>

Please note that downloading proprietary <tt>.ical</tt> files and
submitting them is <i>not acceptable</i>.  To collect this bounty, you
must provide an unencumbered, freely-licensed (X11) iCalendar file.

<?php box_sec ("Special Note"); ?>

The bounty for this task is per-calendar.  We will pay bounties for up
to 30 calendars.</p>

<?php box_end (); ?>
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
<li>Redo the QuickAlarm frame <a STYLE="text-decoration:none" href="http://patches.ximian.com/download.cgi?object=gnome-panel-clock.patch-3">patch</a> to take up less space.</li>
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

You may find this <a STYLE="text-decoration:none" href="clock-calendar.tar.bz2">glade mockup</a> useful.

<?php box_end (); ?>
<?php box_start ("Birthday and anniversary calendar backend", "Calendar", "500", "127535", "127535", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004082.html"); ?>


<p>Evolution's contact editor allows you to annotate a contact with
the dates of their birthday and anniversary.  However, these dates <a STYLE="text-decoration:none" 
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

Start by joining the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">Evolution
Hackers</a> mailing list.

<?php box_end (); ?>
<?php box_start ("Weather calendar backend", "Calendar", "750", "127537", "127537", ""); ?>


<img border=0 src="suncloud.png" align=right alt="">
Write a calendar backend that contacts some weather source and provides
weather forecast data for the upcoming week or so as all-day events, so
it shows up in your calendar. This information should be cached locally,
so you can view it when offline.

<p>A mockup on how it should be integrated on the calendar view is below.</p>
<img src="cal-weather.png" align="center">

<? box_sec ("How"); ?>

<p>The backend just has to get the weather forecast information from
some place (determining that place is part of the job for this bounty,
you might start by looking at where the weather applet gets its
information) and, using ECalBackendFile, create a local copy of that
information (an all day event for each day) in the local file managed
by ECalBackendFile. The backend should probably remove old weather
forecasts, and just keep the ones for the current day and future
days.</p>

<p>The only question remaining is how to allow users to add that backend
to the list of calendars configured. An option could be to create the 'Weather'
calendar on startup, so that it's always available to users. Although there
probably should be a way to add it back if a user ever removes it. In that
case, the 'New Calendar' dialog, new-calendar.c in (<? bonsai ("evolution/calendar/gui/dialogs"); ?>)
could be extended to support the addition of local, remote and any special
kind of calendar backends (weather, birthdays, etc).</p>

<p>Another solution could be to have a config control page for the weather backend,
so that it can ask users all the required information.</p>

<p>Also, a way to use the different weather icons is needed. The best way could be
to use the categories stuff, which unfortunately is hard coded (a fixed set of categories
and icons for those categories is available), so there is the need to have a way for the
backend to register those new categories (Sunny, Rainy, etc) and the icons
associated with it.</p>

<?php box_sec ("Affected Modules"); ?>

<ul>
<li><? bonsai ("evolution-data-server/calendar/backends"); ?> is where
your new backend should reside.
<li><? bonsai ("evolution-data-server/src"); ?> server needs to register
the method (e.g. weather://) that maps to the backend.
</ul>

<?php box_sec ("Tips"); ?>

Use one of the existing backends, probably the http backend, as a
starting point. Grep sources for &quot;webcal&quot; and see how
it's hooked in. The old summary code used to pull weather data,
so that should provide some clues too.

<?php box_end (); ?>
<?php box_start ("Publish your calendar", "Calendar", "1000", "127538", "127538", ""); ?>


<p>
   Apple's iCal has made "calendar sharing" popular. It's a nice feature where any user can create a calendar
   of events and then publish it on a website, to share it with other users. Others can then "subscribe" their
   calendar application to that calendar file, and updates are automatically synced to their imported calendar
   whenever the master file changes. This makes it easy and convenient to share conference schedules, meeting
   times, club events, moving dates and times and so on.
</p>

<p>
   Implement this calendar publishing feature in Evolution. There are two things: first, it needs to just upload
   the .ics file to a remote location, using gnome-vfs facilities (give the user a few common choices like
   ssh://, FTP, WebDav and saving to a file. Then automatically push updates to the exported file whenever new
   events are added or things are being changed. A GUI mockup for exporting is provided below:
</p>

<center>
<img src="publish_calendar.png" border=0>
</center>

<p>
   We should give a possibility to export to a simple HTML page as well for those visitors who don't use a
   calendar program that supports webcal:// (webcal is just a URI scheme that should invoke Evolution's
   "Calendar Import" dialog that does the same as this one but reverse).
</p>

<!--
<p>
   Also, you can use <a STYLE="text-decoration:none" href="http://phpicalendar.sf.net">PhpICalendar</a> to make a dynamic web page for users
   that have PHP support on their server. Evolution could contain a working, stable snapshot of phpical in the
   distribution and you could upload it and set it up for the user's website (proper error checking should
   naturally be carried out, including checking for an existing installation of phpical).
</p>
-->

<?php box_sec("Affected Modules"); ?>

<p>
   Both <? bonsai("evolution"); ?> and <? bonsai("evolution-data-server"); ?> will be affected.
</p>

<?php box_sec("How"); ?>

<p>
   Augment the calendar's http backend with the necessary export capabilities. The backend resides in
   <? bonsai ("evolution-data-server/calendar/backends/http"); ?>, and uses the file backend to operate on
   locally cached calendars. The backend could also handle the HTML generation, exporting it to one or more
   files alongside the ICS file. New named options need to be added to the backend's ESource - e.g.
   user, password, and a flag indicating whether to generate HTML. Additional GUI elements need to be
   added to <? bonsai ("evolution/calendar/gui"); ?> and <? bonsai ("evolution/calendar/gui/dialogs"); ?>.
</p>

<p>
   When implementing the HTML generator, you may want to look at HTML
  output from existing web calendars such as <a STYLE="text-decoration:none" 
  href="http://phpicalendar.sf.net/">PhpICalendar</a>.
</p>

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
You should subscribe to the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  JP Rosevear &lt;<a STYLE="text-decoration:none" 
href="mailto:jpr@ximian.com">jpr@ximian.com</a>&gt; and Hans Petter Jansson 
&lt;<a STYLE="text-decoration:none" href="mailto:hpj@ximian.com">hpj@ximian.com</a>&gt;
will be the primary contacts on the list for the Calendar.
</p>

<?php box_end (); ?>
<?php box_start ("Default free/busy URI", "Calendar", "300", "127541", "127541", ""); ?>


<p><?php rfc(2445); ?> describes a method of describing free/busy
information (VFREEBUSY components).  Evolution currently will obtain
obtain free/busy information from the addressbook if the vCard or LDAP
property calFBURL (described in <?php rfc(2739); ?>) is set.
</p>

<p> Evolution should support a default free/busy uri for users that do
not have the calFBURL property set.
</p>

<?php box_sec ("How"); ?>

<p>Add a setting to cal-prefs-dialog.c in <?php bonsai("evolution/calendar/gui/dialogs"); ?> 
so the user can specify a template uri, for instance "http://freebusyserver.org/&lt;USERNAME&gt/freebusy.ifb".
</p>

<p>
When Evolution tries to obtain free/busy information for users, it
first requests the information from the calendar it will be saving the
data to.  If that fails, it tries to find an addressbook entry for the
username and look at the calFBURL property.  The code for these things
resides in e-meeting-model.h in <?php bonsai("evolution/calendar/gui/"); ?>.  
To accomplish this bounty,
there should be a third method of obtaining the free/busy information,
namely the use of the template uri with appropriate substitution. Most
of the code that loads the calFBURL can be used again to update the
attendee's information.
</p>

You should subscribe to the 
evolution-hackers mailing list, and discuss any technical issues
there.  JP Rosevear <jpr@ximian.com> and Hans Petter Jansson 
<hpj@ximian.com>
will be the primary contacts on the list for the Calendar.
<?php box_end (); ?>
<?php write_page_footer (); ?>

</center>
</body>
</html>
