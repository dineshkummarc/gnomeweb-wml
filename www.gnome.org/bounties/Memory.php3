<?php

include ("./util.php");

?>

<?php write_page_header ("Memory Bounties"); ?>
<?php write_table_header ("no"); ?>
<?php taskrow ("Add image data to the icon cache", "hidden", "100", "169344", ""); ?>
<?php taskrow ("Use a mmap'able cache for fontconfig", "hidden", "200", "169345", ""); ?>
<?php taskrow ("Create a test suite for browsing in Nautilus", "hidden", "200", "169346", ""); ?>
<?php taskrow ("Remove duplication of desktop backgrounds", "hidden", "200", "169347", ""); ?>
<?php write_table_footer (); ?>
<?php box_start ("Add image data to the icon cache", "Memory", "100", "169344", "169344", ""); ?>

<p>For the GTK 2.6 release, a memory mappable icon cache was developed.
This allows us to avoid scanning lots of directories on the startup
of every application. However, one thing it does not do is to store
the actual icon data in a shared file. This means that common images
(consider the "x" on a close button) are duplicated many times.</p>

<p>The image cache should be modified to store the actual bytes of images
inside the cache. There is already a field for this offset; all that
needs to happen is for the generation program to be modified. A few
challenges present themselves:</p>

	<ul><li>Various byte ordering (ARGB, RBGA) are used in various
	  places. Which format should be used in the file. This
	  should be chosen as so to minimize the amount of modification
	  needed to render.</li></ul>
<p>
A solution to this problem will:
</p>
<ul>
	<li>Modify gtk-update-icon-cache to include the image data</li>
	<li>Modify the theme loading code to get the image data from
	    the file</li>
	<li>Document extensions to the icon specification to freedesktop.org.</li>
</ul>
<?php box_end (); ?>
<?php box_start ("Use a mmap'able cache for fontconfig", "Memory", "200", "169345", "169345", ""); ?>

<p>On the startup of every program, fontconfig allocates about 100 kb of data.
This data should be read from a memory mappable cache on disk. This way,
the data is shared between processes. Also, it allows more expensive
techniques to optimize the data storage.</p>

<p>A solution to this bounty will:</p>

	<ul>
		<li>Create a program that generates an on-disk cache.</li>
		<li>Modify fontconfig to read from this file, allowing
		  a fallback path with the existing code.</li>

	</ul>
<?php box_end (); ?>
<?php box_start ("Create a test suite for browsing in Nautilus", "Memory", "200", "169346", "169346", ""); ?>

<p>A test case is needed for Nautilus doing a long session of browsing. This
test case can be used to detect leaks, using tools such as valgrind. The
test case should use the LDTP project. It should do the following:</p>
<ul>
	<li>Put Nautilus in the root directory (/)</li>
	<li>Spider around across different folders</li>
	<li>Use various views (browser, spatial, as icons, as a list)</li>
	<li>Be able to account for the fact that under valgrind, things
	  will not happen fast (so it must wait)</li>
</ul>
<?php box_end (); ?>
<?php box_start ("Remove duplication of desktop backgrounds", "Memory", "200", "169347", "169347", ""); ?>

<p>
Right now, the background image is stored in three places:
</p>
<ul>
	<li>In gnome-settings-daemon</li>
	<li>In nautilus</li>
	<li>In the X server (stored there by nautilus)</li>
</ul>
<p>
The background must be stored in one and only one location.
</p>
<p>
A solution to this bounty will:
</p>
<ul>
	<li>Use only (screen height) * (screen width) * sizeof (int) bytes
	  of memory for a background image.</li>
	<li>Still keep reasonable performance for icons on the desktop,
	  rubberbanding, etc.</li>
</ul>
<?php box_end (); ?>
<?php write_page_footer (); ?>

</center>
</body>
</html>
