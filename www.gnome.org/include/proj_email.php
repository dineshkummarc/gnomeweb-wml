<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

function send_new_project_email($group_id) {

	$res_grp = db_query("SELECT * FROM groups WHERE group_id='$group_id'");

	if (db_numrows($res_grp) < 1) {
		echo ("Group [ $group_id ] does not exist. Shame on you, sysadmin.");
	}

	$row_grp = db_fetch_array($res_grp);

	$res_admins = db_query("SELECT users.user_name,users.email FROM users,user_group WHERE "
		. "users.user_id=user_group.user_id AND user_group.group_id='$group_id' AND "
		. "user_group.admin_flags='A'");

	if (db_numrows($res_admins) < 1) {
		echo ("Group [ $group_id ] does not seem to have any administrators.");
	}

	// send one email per admin
while ($row_admins = db_fetch_array($res_admins)) {
	$message = 
'Your project registration for the GNOME Software Map has been approved. 

Project Full Name     :  '.$row_grp['group_name'].'
Project Unix Name     :  '.$row_grp['unix_group_name'].'
Project Administration:  'http://'.$GLOBALS['sys_default_domain'].'/project/admin/?group_id='
.$row_grp['group_id'].'

We highly suggest that you now create a public description for your project. 
This can be done by visiting your project administration page.

Your project will also not appear in the Trove software map until
you categorize it in the project administration screens. So that
people can find your project, you should do this now.

Enjoy the system.

 -- the Gnome.org web monkies';
	
	mail($row_admins['email'],"GNOME Project Approved",$message,"From: webmaster@gnome.org");

}

}

/*
 * This function sends out a rejection message to a user who
 * registers a project
 */
function send_project_rejection($group_id, $response_id, $message="zxcv")
{
	// Get the email addr of the user who wants to register the project.
	$email = db_result(db_query("SELECT u.email AS email FROM users u, user_group ug WHERE ug.group_id='$group_id' AND u.user_id=ug.user_id;"),0,"email");
	
	// Check to see if they want to send a custom rejection response
	if( $response_id == 0 ) {
		$response = $message;
	} else {
		$response = db_result(db_query("SELECT response_text FROM canned_responses WHERE response_id='$response_id'"),0,"response_text");
	}

	mail($email, "GNOME Project Denied", $response, "From: webmaster@gnome.org");

	return true;
}

?>
