<?php

include ("./util.php");

?>

<?php write_page_header ("Miscellaneous Bounties"); ?>
<?php write_table_header ("no"); ?>
<?php taskrow ("Improve Nautilus &quot;Send to...&quot; feature", "hidden", "1500", "127551", "www.es.gnome.org/~telemaco/nautilus-sendto-0.1-1.tar.gz"); ?>
<?php taskrow ("Evolution/iPod synchronization", "hidden", "500", "127552", ""); ?>
<?php taskrow ("Drag and Drop between Gnome and Firefox", "hidden", "300", "127553", ""); ?>
<?php taskrow ("Make Evolution Use the gnome-icon-theme", "hidden", "500", "127812", ""); ?>
<?php write_table_footer (); ?>
<?php box_start ("Improve Nautilus &quot;Send to...&quot; feature", "Miscellaneous", "1500", "127551", "127551", "www.es.gnome.org/~telemaco/nautilus-sendto-0.1-1.tar.gz"); ?>


<p> The Nautilus file manager has a context menu item for "Send
to...", which opens the Evolution composer to mail a selected file to
someone.  This task involves implementing three major improvements to
this feature:

<ol>

<li>If you select multiple files, Nautilus should automatically prompt
you to create an archive (zip, tar, etc - user's choice) and mail that
instead.</li>

<li>Allow the user to send the files to another user over IM instead of
email. The user should be prompted to select an online buddy from the 
buddy list.  Be sure to only display the buddies can accept
file transfers.</li>

<li>Provide a recipient selection dialog that does name and address
completion.</li>

</ol>

Below is an animated mockup of a "Send to..." dialog that incorporates
all these improvements, and has a nice completion mechanism.

<p align=center><img border=0 src="send_file-anim-mockup.gif" alt=""></p>

<p>If the user has selected only one file and it is not a directory,
then we can present him with a simpler dialog including only the
recipient and the medium:</p>

<p align=center><img border=0 src="send_file_single.gif" alt=""></p>

<p>After the user clicks "Send" he gets either a IM "send file" dialog
or a mail composer window with the file(s) attached.</p>

<p>To implement this feature nicely, you may want to integrate with
file roller for the archive creation.  And you should in some way
indicate the total size of the compressed archive or file being sent
to the user.</p>

<?php box_sec ("Affected Modules"); ?>

<? bonsai ("nautilus"); ?>, <? bonsai ("evolution"); ?>, <? bonsai ("gaim"); ?> and <? bonsai ("file-roller"); ?>.  
<?php box_sec ("Pointers"); ?>

Check the <a STYLE="text-decoration:none" 
href="http://lists.gnome.org/mailman/listinfo/nautilus-list">Nautilus</a>
mailing list, as well as <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">Evolution
Hackers</a>, and visit <a STYLE="text-decoration:none" 
href="http://gaim.sf.net">the Gaim home page</a>.

<?php box_end (); ?>
<?php box_start ("Evolution/iPod synchronization", "Miscellaneous", "500", "127552", "127552", ""); ?>

<p>
Since the iPod supports calendars and addressbooks, it would be handy for
<img border=0 src="ipod.png" align=right alt="">

Evolution users to be able to automatically and easily synchronize

their personal data to their iPods.  Because the iPod is a read-only
device &mdash; the iPod cannot modify the data &mdash; the
&quot;synchronization&quot; is really just a one-way copy from
Evolution to the iPod.
</p>
<p>
Your solution must synchronize three kinds of data:
<ul>
<li>Contacts in the addressbook</li>
<li>Events in the calendar</li>
<li>Task list ("To Do" in the iPod)</li>
</ul>

<p>
The difficult part of this work will be to create a simple and
integrated user experience that doesn't require the user to do any
special setup or ever drop to a command line.  The winning entry will
offer an all-encompassing solution.
</p>

<?php box_sec ("Modules Affected"); ?>

You'll be working on <? bonsai ("evolution"); ?>.

<?php box_sec ("Pointers"); ?>

To learn more about how Linux works with the iPod and how to
synchronize a device with Evolution, check out some of the following
links:
<ul>
<li><a STYLE="text-decoration:none" href="http://multisync.sourceforge.net/">MultiSync</a></li>
<li><a STYLE="text-decoration:none" href="http://gtkpod.sourceforge.net/">GTKPod</a>, a GUI iPod management system</li>
<li><a STYLE="text-decoration:none" href="http://sourceforge.net/projects/ipod-on-linux/">ipod-on-linux</a>, a conglomeration of other iPod and Linux work</li>
<li><a STYLE="text-decoration:none" href="http://www.gnu.org/software/gnupod/">GNUPod</a>, Perl scripts for manipulating iPods</li>
</ul>

<?php box_end (); ?>
<?php box_start ("Drag and Drop between Gnome and Firefox", "Miscellaneous", "300", "127553", "127553", ""); ?>


<p></p>

<p>Currently dragging and dropping back and forth between nautilus and
firefox is very problematic.  Bookmarks and copying actions are easily
confused with surprising results.</p>

What happens now:
<ul>
<li>Drag an image (foo.gif) from a web page  to desktop. You get a "default" 
  icon with "foo.gif" as the name. 
<li>Drag a web page link to the desktop, it makes a similar .desktop
  file, which is  probably OK in this case ("make bookmark"). But dragging it back
  either does nothing, or makes the browser load the actual .desktop
  file as plaintext.
</ul>
What we'd like to see:
</ul>
<li>
  Dragging a bookmark .desktop file to Firefox should open the url the
  bookmark file contains, not the bookmark file itself.
</li>
<li>
  Dragging an http: uri from firefox to the desktop should ask you if you
  prefer to download the file or make a bookmark point to the location.  If a
  desktop bookmark is created the resulting .desktop file should specify a
  hyperlink icon (or possibly use the shortcut icon if the link points to an
  html page).
</li>
</ul>
<?php box_sec ("How"); ?>
  Add the behavior dialog and download options to Nautilus upon
  receipt drops containing http: uris.  Add code to firefox to recognize
  the difference between the various .desktop filetypes and take the
  appropriate action.
<?php box_sec ("Affected Modules"); ?>
  <? bonsai ("nautilus"); ?> is where the changes related to dropping
  on the desktop will live.  Firefox will also probably need changes to
  recognize .desktop files and take the appropriate action.
<?php box_sec ("Pointers"); ?>
  The <a STYLE="text-decoration:none" href="http://mail.gnome.org/archives/desktop-devel-list/">desktop-devel-list</a> and 
<a STYLE="text-decoration:none" href="http://mail.gnome.org/archives/nautilus-list/">nautilus-list</a> are a valuable place to discuss the nautilus changes. The <a STYLE="text-decoration:none" href="http://freedesktop.org/">freedesktop.org</a> site has addtional pointers to common <a STYLE="text-decoration:none" href="http://freedesktop.org/Main/Draganddropwarts">drag and drop warts</a> (but ignore the parts about using XDS).  Information about Firefox can be found at <a STYLE="text-decoration:none" href="http://mozilla.org/products/firefox">www.mozilla.org/products/firefox.</a>
<?php box_end (); ?>
<?php box_start ("Make Evolution Use the gnome-icon-theme", "Miscellaneous", "500", "127812", "127812", ""); ?>


<p>Currently Evolution's icons are not themeable and are a mixture
of RGBA PNGs and 1bit transparent XPMs. Evolution should use the
icon theme spec' defined method of looking up icons from
gnome-icon-theme. Most of the icons are already in place
(gnome-icon-theme CVS module).</p>

<?php box_sec ("Affected Modules"); ?>

<p>This bounty requires changes to the components and shell.</p>

<?php box_sec ("Pointers"); ?>

<p>The icon theme spec is available at <a STYLE="text-decoration:none" 
href="http://freedesktop.org/Standards/icon-theme-spec">freedesktop.org</a>,
particulary the <a STYLE="text-decoration:none" 
href="http://freedesktop.org/Standards/icon-theme-spec/0.7/ar01s05.html">icon
lookup section</a> may be handy.</p>

<?php box_end (); ?>
<?php write_page_footer (); ?>

</center>
</body>
</html>
