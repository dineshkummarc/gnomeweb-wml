<?php

include ("./util.php");

?>

<?php write_page_header ("Tasks Bounties"); ?>
<?php write_table_header ("no"); ?>
<?php taskrow ("Support export of tasks to CSV spreadsheet
files", "hidden", "300", "127557", ""); ?>
<?php taskrow ("Bugzilla tasks backend", "hidden", "500", "127558", ""); ?>
<?php write_table_footer (); ?>
<?php box_start ("Support export of tasks to CSV spreadsheet
files", "Tasks", "300", "127557", "127557", ""); ?>




<p>
Currently, Evolution does not have data export features for tasks.
Task list data is not easy to import into spreadsheets or project
management tools, and it should be.
</p>

<?php box_sec ("How"); ?>
 

<p>
The difficult part of this task will be altering the task storage
format to include a task ID field, which will match the WBS or "work
breakdown structure" code in a project management program. Once you
have that, the export to a CSV file should be relatively simple.
</p>

<?php box_sec ("Modules Affected"); ?>
 

Just <? bonsai ("evolution"); ?>.

<?php box_end (); ?>
<?php box_start ("Bugzilla tasks backend", "Tasks", "500", "127558", "127558", ""); ?>


<p>Evolution and the GNOME project as a whole both use Bugzilla to
track bugs. Since Evolution is used by many GNOME developers, it would
be useful to have some degree of integration with Bugzilla.
<img border=0 src="bug.png" align=right alt="">
</p>

<?php box_sec ("Affected Modules"); ?>

<p><? bonsai ("evolution-data-server"); ?> and <? bonsai ("evolution"); ?>

<?php box_sec ("How"); ?>

<p>You will need to add a way to add a bugzilla server to your list of
task sources. (The user will need to configure server name, username,
and optionally have it remember his password.)</p>

<p>Evolution will have to parse the output of Bugzilla's "query.cgi"
page, and extract the list of saved queries from the pop-up at the
bottom. Each saved query should show up as a folder on that server in
Evolution.</p>

<p>When the user opens the folder, Evolution will fetch the results of
that query and show a task item for each bug. The summary of the task
should be the summary of the bug, and the URL field of the task should
be a link to the relevant bugzilla entry. If the user opens the bug,
the "Description" field should show the rest of the information. The
backend will probably need to be read-only.</p>

<p>There are various extensions you can make to the basic idea. For
example, you could try to map bug priority to task priority, or have
some indication of which tasks are assigned to the user.</p>

<?php box_sec ("Pointers"); ?>

<ul>
<li><? bonsai ("evolution-data-server/calendar/backends"); ?> is where
your new backend should reside.
<li><? bonsai ("evolution-data-server/src"); ?> server needs to register
the method (e.g. bugzilla://) that maps to the backend.
<li><? bonsai ("evolution/calendar/gui/dialogs/new-calendar.c"); ?> and
its Glade file need to add a way for the user to specify the
username, server and saved query.  Multiple queries should be
supported.
</ul>

<?php box_end (); ?>
<?php write_page_footer (); ?>

</center>
</body>
</html>
