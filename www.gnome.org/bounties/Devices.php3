<?php

include ("./util.php");

?>

<?php write_page_header ("Devices Bounties"); ?>
<?php write_table_header ("no"); ?>
<?php taskrow ("Additional Conduits", "hidden", "0", "5727758"); ?>
<?php taskrow ("Notes metaphor for pilot sync", "hidden", "0", "444402437"); ?>
<?php taskrow ("Evolution/iPod Synchronization", "hidden", "0", "2135118480"); ?>
<?php write_table_footer (); ?>
<?php box_start ("Additional Conduits", "Devices", "0", "5727758", "0"); ?>

<?php box_end (); ?>
<?php box_start ("Notes metaphor for pilot sync", "Devices", "0", "444402437", "0"); ?>


FIXME: What does this mean?

<?php box_end (); ?>
<?php box_start ("Evolution/iPod Synchronization", "Devices", "0", "2135118480", "0"); ?>

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

To learn more about how Linux works with the iPod, check out some of
the other iPod-related projects:
<ul>
<li><a href="http://gtkpod.sourceforge.net/">GTKPod</a>, a GUI iPod management system
<li><a  href="http://sourceforge.net/projects/ipod-on-linux/">ipod-on-linux</a>, a conglomeration of other iPod and Linux work
<li><a href="http://www.gnu.org/software/gnupod/">GNUPod</a>, Perl scripts for manipulating iPods
</ul>

<?php box_end (); ?>


</center>
</body>
</html>
