<?php

include ("./util.php");

?>

<?php write_page_header ("Nautilus Bounties"); ?>
<?php write_table_header ("no"); ?>
<?php taskrow ("Improve Nautilus &quot;Send to...&quot; feature", "hidden", "300", "1982646862"); ?>
<?php taskrow ("Drag and drop printing in Nautilus printers: view", "hidden", "0", "2090428571"); ?>
<?php write_table_footer (); ?>
<?php box_start ("Improve Nautilus &quot;Send to...&quot; feature", "Nautilus", "300", "1982646862", "0"); ?>


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

<? bonsai ("nautilus"); ?>, <? bonsai ("evolution"); ?>, <? bonsai ("gaim"); ?> and <? bonsai ("file-roller"); ?>.  See our general note about <a href="gaim.php">gaim extension</a>.

<?php box_sec ("Pointers"); ?>

Check the <a
href="http://lists.gnome.org/mailman/listinfo/nautilus-list">Nautilus</a>
mailing list, as well as <a
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">Evolution
Hackers</a>, and visit <a
href="http://gaim.sf.net">the Gaim home page</a>.

<?php box_end (); ?>
<?php box_start ("Drag and drop printing in Nautilus printers: view", "Nautilus", "0", "2090428571", "0"); ?>

also context menu print in nautilus
<?php box_end (); ?>


</center>
</body>
</html>
