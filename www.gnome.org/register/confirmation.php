<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

require 'pre.php';    // Initial db and session library, opens session
require 'account.php';
session_require(array('isloggedin'=>'1'));
require 'vars.php';

if ($show_confirm) {

	/*
		check for valid group name
	*/
	$form_unix_name=strtolower($form_unix_name);

	if (!account_groupnamevalid($form_unix_name)) {
		exit_error("Invalid Group Name",$register_error);
	}
	/*
		See if it's taken already
	*/
	if (db_numrows(db_query("SELECT group_id FROM groups WHERE unix_group_name='$form_unix_name'")) > 0) {
		exit_error("Group Name Taken","That group name already exists.");
	}
	
	$HTML->header(array('title'=>'Preview Submitted Information'));

	echo '
	<H2>Preview Submitted Information</H2>
	<FORM action="'.$PHP_SELF.'" method="post">
	<TABLE cellpadding="2" cellspacing="2" border="0">
	<TR><TD><B>Full Name</B></TD><TD>:</TD><TD>'.$form_full_name.'</TD></TR>
	<TR><TD><B>UNIX Name</B></TD><TD><B>:</B></TD><TD>'.$form_unix_name.'</TD></TR>
	<TR><TD><B>Description</B></TD><TD><B>:</B></TD><TD>'.$form_description.'</TD></TR>
	<TR><TD><B>Mini Description</B></TD><TD><B>:</B></TD><TD>'.$form_minidesc.'</TD></TR>
	<TR><TD><B>GNOME Support</B></TD><TD><B>:</B></TD><TD>';
	echo ($form_gnome_support) ? ('Yes') : ('No, GTK+ Only');
	echo '
	</TD></TR>
	<TR><TD><B>Homepage</B></TD><TD><B>:</B></TD><TD>'.$form_homepage.'</TD></TR>
	<TR><TD><B>Screenshots</B></TD><TD><B>:</B></TD><TD>'.$form_screenshot.'</TD></TR>
	<TR><TD><B>Mailing List</B></TD><TD><B>:</B></TD><TD>'.$form_maillist.'</TD></TR>
	<TR><TD><B>CVS</B></TD><TD><B>:</B></TD><TD>'.$form_cvs.'</TD></TR>
	<TR><TD><B>Bug Tracker</B></TD><TD><B>:</B></TD><TD>'.$form_bugs.'</TD></TR>
	<TR><TD><B>License</B></TD><TD><B>:</B></TD><TD>'.$LICENSE[$form_license].'</TD></TR>
	</TABLE>';

	if ($form_license_other) {
		echo '
	<P><B>Other License:</B></P>
	<P>'.$form_license_other.'</P>';
	}

	echo '	
	<P>If everything looks good, click below and your project listing will be created.</P>
	<INPUT TYPE="HIDDEN" NAME="form_full_name" VALUE="'.$form_full_name.'">
	<INPUT TYPE="HIDDEN" NAME="form_unix_name" VALUE="'.$form_unix_name.'">
	<INPUT TYPE="HIDDEN" NAME="form_description" VALUE="'.addslashes(htmlspecialchars($form_description)).'">
	<INPUT TYPE="HIDDEN" NAME="form_minidesc" VALUE="'.addslashes(htmlspecialchars($form_minidesc)).'">
	<INPUT TYPE="HIDDEN" NAME="form_gnome_support" VALUE="'.$form_gnome_support.'">
	<INPUT TYPE="HIDDEN" NAME="form_homepage" VALUE="'.$form_homepage.'">
	<INPUT TYPE="HIDDEN" NAME="form_screenshot" VALUE="'.$form_screenshot.'">
	<INPUT TYPE="HIDDEN" NAME="form_maillist" VALUE="'.$form_maillist.'">
	<INPUT TYPE="HIDDEN" NAME="form_cvs" VALUE="'.$form_cvs.'">
	<INPUT TYPE="HIDDEN" NAME="form_bugs" VALUE="'.$form_bugs.'">
	<INPUT TYPE="HIDDEN" NAME="form_license" VALUE="'.$form_license.'">
	<INPUT TYPE="HIDDEN" NAME="form_license_other" VALUE="'.addslashes(htmlspecialchars($form_license_other)).'">
	<INPUT type=submit name="looks_good" value="Looks good to me">
	</FORM>';

	$HTML->footer(array());

} else if ($looks_good) {
	/*
		Finalize the db entries
	*/

	$query = "INSERT INTO groups (group_name, is_public, status, unix_group_name, short_description, mini_description,"
		. "gnome_support,url_homepage,url_cvs,url_mail,url_bugtracker,url_screenshot,"
		. "license,license_other,register_time) "
		. "values ("
		. "'".$form_full_name."',"
		. "'1',"
		. "'P',"
		. "'".$form_unix_name."',"
		. "'".htmlspecialchars($form_description)."',"
		. "'".htmlspecialchars($form_minidesc)."',"
		. "'".$form_gnome_support."',"
		. "'".$form_homepage."',"
		. "'".$form_cvs."',"
		. "'".$form_maillist."',"
		. "'".$form_bugs."',"
		. "'".$form_screenshot."',"
		. "'".$form_license."',"
		. "'".htmlspecialchars($form_license_other)."',"
		. "'".time()."'"
		. ")";
	
	$result = db_query($query);

	if (db_affected_rows($result) < 1) {
		exit_error('Error','UDPATING TO ACTIVE FAILED. <B>PLEASE</B> report to admin@'.$GLOBALS['sys_default_domain'].' '.db_error());
	}

	$group_id = db_insertid($result, 'groups', 'group_id');

	//
	// make the current user an admin
	//
	//	temporary insert until the project is approved
	//
	$query="INSERT INTO user_group "
		. "(user_id,group_id,admin_flags,release_flags) VALUES ("
		. user_getid() . ","
		. $group_id . ","
		. "'A'," // admin flags
		. "1)"; // release_flags	
	$result = db_query($query);
	if (!$result) {
		exit_error('Error','SETTING YOU AS OWNER FAILED. <B>PLEASE</B> report to webmaster@'.$GLOBALS['sys_default_domain'].' '.db_error());
	}

	$message = "A new project, ".$form_full_name.", was added to the Software Map.\n\n"
		. "An admin will need to approve the registration at:\n\n"
		. "http://".$sys_default_domain."/admin/\n\n";
	mail ("webmaster@gnome.org", "New project added to Software Map",
		$message, "From: webmaster@gnome.org");

	$HTML->header(array('title'=>'Registration Complete'));
	
	?>

	<H1>Registration Complete!</H1>
	<P>Your project has been submitted to the Gnome.org admininstrators. 
	Within 72 hours, you will receive decision notification and further 
	instructions.
	<P>
	Thank you for choosing GNOME.
	<P>

	<?php
	$HTML->footer(array());

} else {
	exit_error('Error','This is an invalid state. Some form variables were missing.
		If you are certain you entered everything, <B>PLEASE</B> report to admin@'.$GLOBALS['sys_default_domain'].' and include info on your browser and platform configuration');

}

?>

