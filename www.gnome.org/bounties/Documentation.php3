<?php

include ("./util.php");

?>

<?php write_page_header ("Documentation Bounties"); ?>
<?php write_table_header ("no"); ?>
<?php taskrow ("Outlook-Evolution dictionary", "hidden", "300", "127544", ""); ?>
<?php taskrow ("Quick reference card", "hidden", "300", "127545", ""); ?>
<?php write_table_footer (); ?>
<?php box_start ("Outlook-Evolution dictionary", "Documentation", "300", "127544", "127544", ""); ?>



<p> 
  To help people switching from Outlook to Evolution, assemble a list of
<img border=0 src="readme.png" align=right alt="">
  equivalent tasks for mail, calendar, and addressbook functionality,
  for the Evolution user's guide.  Ask yourself this question: "In
  Outlook, I did something by clicking here or selecting there. In
  Evolution, what do I do?"  
</p>

<?php box_sec ("Pointers"); ?>
 

<p>
 To get started, visit the
 irc.gnome.org channel #docs, or read up on the GNOME docs process at
 the <a href="http://developer.gnome.org/projects/gdp">GNOME
 Documentation Project</a> home page and the <a
 href="http://www.docbook.org/tdg/en/html/docbook.html">official
DocBook manual</a>.  The primary contact for this task will be <a href="mailto:aaron@ximian.com">Aaron Weber</a>.
</p>
<p> 
 Your work should reflect the Evolution 2.0 user interface; you may
 wish to wait until the GNOME 2.6 UI freeze to begin. 
 </p>

<?php box_sec ("Additional Requirements"); ?>

<p> 

 Please submit a single valid DocBook XML file, consisting of one
 &lt;chapter&gt; or &lt;appendix&gt;.
 You will probably want to format your work using the &lt;table&gt; or
 &lt;variablelist&gt; tags.  It may also help to include images
 of equivalent menus, dialogs, or windows. If you do include Evolution
 screenshots, use the same style as the existing Evolution user's
 guide screenshots. Screenshots should not display any actual personal
 information; if necessary, we can provide "dummy" mail folders,
 address books, and calendars.
  </p>

<p>
 You do not need to submit copyright assignment for this
 change; your work will be included in the Evolution User's Guide and
 distributed in accordance with the GNU Free Documentation License.
</p>


<?php box_end (); ?>
<?php box_start ("Quick reference card", "Documentation", "300", "127545", "127545", ""); ?>


<p>
  Evolution has a quick reference section in the manual, but it's not
  obvious and it's not printable. It should have a link from the Help
  menu and it should be easy to print out on a single page and tape to
  the wall.
</p>

<?php box_sec ("How"); ?>
<p>
  The simplest approach to this will be to take the
  content from the "menuref.xml" help file in Evolution, and format it
  nicely as a card using any open-format desktop publishing tool (TeX,
  OpenOffice.org, etc.)  Convert the output to
  Postscript or PDF format, and create a link to it from the Help menu
  in Evolution.  Be sure to check that the content is up to date, and
  matches the Evolution development branch. Provide both the original
  and the PDF formatted version of your file.
 </p>

<p>
  Then, add a menu item in the Help menu. Make sure when you do so
  that it calls the appropriate application to display your choice of
  file format, and that this is based on the user's MIME database,
  rather than being hardcoded.
 </p>

<p>
  If that sounds too easy, you could work with the <a
  href="http://www.gnome.org/~shaunm/yelp/">Yelp help browser</a> team
  to add print support to the help browser, so that the reference
  section can be printed out directly.  However, this approach is much
  more difficult.  
</p>

<?php box_sec ("Modules Affected"); ?>
 

<p>
  This will change <? bonsai ("evolution"); ?>. If you wish, you can
  work with <?  bonsai ("yelp"); ?>. You may need to have, or obtain,
  some knowledge of <? bonsai ("gnome-print"); ?> as well.  
</p>

<?php box_sec ("Pointers"); ?>
 
<p>
For information on the DocBook XML format, check <a
href="http://www.docbook.org/tdg/en/html/docbook.html">DocBook: The
Definitive Guide</a>. To talk to GNOME documentation team members,
visit the #docs channel in irc.gnome.org.  For information on the
GNOME printing architecture, visit <a
href="http://www.gnome.org/projects/gnome-print/">the GNOME-print
page</a>.  Before you begin any work on the help browser, be sure to
<a href="http://www.gnome.org/~shaunm/yelp/">check with the
maintainers.</a> The primary contact for this task will be <a href="mailto:aaron@ximian.com">Aaron Weber</a>. </p>

<?php box_end (); ?>
<?php write_page_footer (); ?>

</center>
</body>
</html>
