<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

require "pre.php";    // Initial db and session library, opens session
session_require(array(isloggedin=>1));
$HTML->header(array(title=>"Software Map Registration"));
?>

<H2>Software Map Registration</H2>

<p>
Gnome.org allows you to register your GNOME or GTK+ based application in our Software
Map. This allows people to find your software easier. When you post a new release, it will go in the Recently Updated boxes around the site.</p>

<p><B>The Process</B>

<P>Registering a project with Gnome.org is an easy process, but we do require some general project information and verification from the Software Map maintainers. The entire
process should take about 10 minutes or less. 

<p>&nbsp;
<BR><H3 align=center><a href="projectinfo.php">Step 1: Project Information</a></H3>
</p>

<?php
$HTML->footer(array());

?>

