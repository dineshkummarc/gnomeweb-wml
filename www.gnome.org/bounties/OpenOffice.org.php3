<?php

include ("./util.php");

?>

<?php write_page_header ("OpenOffice.org Bounties"); ?>
<?php write_table_header ("no"); ?>
<?php taskrow ("OO.o slide view performance", "hidden", "500", "127554", ""); ?>
<?php taskrow ("OO.o Image Save", "hidden", "300", "127556", "http://ooo.ximian.com/ooo-build/patches/OOO_1_1/sd-save-image-context-menu.diff"); ?>
<?php taskrow ("OO.o Calc - function precision", "hidden", "500", "127771", "http://ooo.ximian.com/ooo-build/patches/OOO_1_1/"); ?>
<?php write_table_footer (); ?>
<?php box_start ("OO.o slide view performance", "OpenOffice.org", "500", "127554", "127554", ""); ?>

<p>The slides view in impress suffers some from seriously slow,
un-cached slide thumbnailing, this makes scrolling the slide
list unacceptably slow.</p>

<?php box_sec ("How"); ?>
<p>Either profile and accelerate the thumbnail rendering to an
acceptable level, or render slides to a bitmap that can be
rendered more quickly subsequently.</p>

<?php box_sec ("Acceptance Criteria"); ?>
<p>The solution providing the greatest speedup, and ergonomic 
improvement in this area wins</p>
<?php box_end (); ?>
<?php box_start ("OO.o Image Save", "OpenOffice.org", "300", "127556", "127556", "http://ooo.ximian.com/ooo-build/patches/OOO_1_1/sd-save-image-context-menu.diff"); ?>
 
<p> 
 After inserting an image into a document or presentation, you may
 wish to save it as a separate file.  However, it is not currently
 easy to do so.
</p>

<?php box_sec ("How"); ?>
<p>
  Add a 'Save As' item to the right-click context menu for images in
  documents or presentations. The menu item should open up a dialog
  allowing the image to be saved to disk as an individual file.
</p> <?php box_end (); ?>
<?php box_start ("OO.o Calc - function precision", "OpenOffice.org", "500", "127771", "127771", "http://ooo.ximian.com/ooo-build/patches/OOO_1_1/"); ?>

<p>oocalc's numeric precision is pretty awful for a load of common
functions. This should be substantially improved, in-line with
gnumeric. Functions VAR, LINEST, SKEW, PRODUCT, GEOMEAN, POWER\
at a minumum should be improved.</p>

<?php box_sec ("How"); ?>
<p>For example, check out the VAR algorithm; <a STYLE="text-decoration:none" 
href="http://ooo.ximian.com/lxr/source/cvsup/sc/sc/source/core/tool/interpr1.cxx#2387">
here</a> and in fn. (ScVar). It should not discard precision in big handfulls.
To see an example of it's bad behavior enter A1: 30000 B1: 0.001 C1: =VAR(A1;A1+B1)
(format the cells with scientific notation).
</p>

<?php box_sec ("Acceptance Criteria"); ?>
The functions should behave more correctly, preferably as well as
gnumeric. There should also be a spreadsheet containing these corner
cases for future smoke regression testing.
<?php box_end (); ?>
<?php write_page_footer (); ?>

</center>
</body>
</html>
