<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

require "pre.php";    // Initial db and session library, opens session
session_require(array('isloggedin'=>'1'));
require "vars.php";
require "account.php";

$HTML->header(array('title'=>'Project Information'));

?>

<H2>Step 1: Project Information</H2>

<P>We now need some basic technical information for your project.
There are two types of names that will be associated with this project.

<P>The "Full Name" is descriptive, has no real name restrictions (except
a 40 character limit), and can be changed. 
The "Unix Name" has several restrictions because it is used around the site. 
They are:

<UL>
<LI>Cannot match the Unix name of any other project</LI>
<LI>Must be between 3 and 15 characters in length</LI>
<LI>Can only contain characters, numbers, and dashes</LI>
<LI>Must be a valid Unix username</LI>
<LI>Unix name will never change for this project</LI>
</UL>

<P>Your Unix name will be used for many things, including:

<UL>
<LI>A project information page at http://<?php echo $GLOBALS['sys_default_domain']; ?>/softwaremap/projects/unixname.</LI>
<LI>Search engines throughout the site</LI>
</UL>

<P>Please make your selections.

<FORM action="confirmation.php" method="post">

<P><B>Project Information</B></P>
Full Name :<BR>
<INPUT size="40" maxlength="40" type=text name="form_full_name"><BR><BR>
Unix Name :<BR>
<INPUT type="text" maxlength="15" SIZE="15" name="form_unix_name"><BR><BR>
Short Description (255 chars or less) :<BR>
<INPUT type="text" maxlength="255" size="60" name="form_description"><BR><BR>
Mini Description (2 - 5 words; Used in GNOME Weekly Summary) :<BR>
<INPUT type="text" maxlength="40" name="form_minidesc"><BR><BR>
Gnome Support :<BR>
<SELECT name="form_gnome_support">
<OPTION value="1" selected>Yes
<OPTION value="0">No, GTK+ only
</SELECT><BR><BR>
Homepage :<BR>
http://<INPUT type="text" maxlength="255" size="60" name="form_homepage"><BR><BR>
Screenshots :<BR>
http://<INPUT type="text" maxlength="255" size="60" name="form_screenshot"><BR><BR>
Download (fully qualifed URL) :<BR>
<font color="#FFFFFF">http://</font><INPUT type="text" maxlength="255" size="60" name="form_download"><BR><BR>
Mailing List :<BR>
http://<INPUT type="text" maxlength="255" size="60" name="form_maillist"><BR><BR>
CVS (e.g. CVSWEB or ViewCVS) :<BR>
http://<INPUT type="text" maxlength="255" size="60" name="form_cvs"><BR><BR>
Bug Tracker :<BR>
http://<INPUT type="text" maxlength="255" size="60" name="form_bugs"><BR><BR>
License :<BR>
<?php
	echo '<SELECT NAME="form_license">';
	while (list($k,$v) = each($LICENSE)) {
		print "<OPTION value=\"$k\"";
		if ($k == "gpl") { print " selected"; }
		print ">$v\n";
	}
	echo '</SELECT>';
?>
<P>
If you selected "other", please provide an explanation along
with a description of your license. Realize that other licenses may
not be approved.</P>
<TEXTAREA name="form_license_other" wrap=virtual cols=60 rows=10></TEXTAREA>
<BR><BR>
<INPUT TYPE="HIDDEN" NAME="show_confirm" VALUE="y">
<INPUT type=submit name="Submit" value="Step 2: Confirmation">
</FORM>

<?php
$HTML->footer(array());

?>

