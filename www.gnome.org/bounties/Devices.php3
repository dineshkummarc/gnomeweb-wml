<?php

include ("./util.php");

?>

<?php write_page_header ("Devices Bounties"); ?>
<?php write_table_header ("no"); ?>
<?php taskrow ("Evolution/iPod synchronization", "hidden", "0", "1138100848"); ?>
<?php write_table_footer (); ?>
<?php box_start ("Evolution/iPod synchronization", "Devices", "0", "1138100848", "0"); ?>

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
<li><a href="http://multisync.sourceforge.net/">MultiSync</a></li>
<li><a href="http://gtkpod.sourceforge.net/">GTKPod</a>, a GUI iPod management system</li>
<li><a  href="http://sourceforge.net/projects/ipod-on-linux/">ipod-on-linux</a>, a conglomeration of other iPod and Linux work</li>
<li><a href="http://www.gnu.org/software/gnupod/">GNUPod</a>, Perl scripts for manipulating iPods</li>
</ul>

<?php box_end (); ?>


</center>
</body>
</html>
