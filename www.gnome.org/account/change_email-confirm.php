<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

require "pre.php";    

$confirm_hash = substr(md5($session_hash . time()),0,16);

$res_user = db_query("SELECT * FROM users WHERE user_id=".user_getid());
if (db_numrows($res_user) < 1) exit_error("Invalid user","That user does not exist.");
$row_user = db_fetch_array($res_user);

db_query("UPDATE users SET confirm_hash='$confirm_hash',email_new='$form_newemail' "
	. "WHERE user_id=$row_user[user_id]");

$message = "You have requested a change of email address on Gnome.org.\n"
	. "Please visit the following URL to complete the email change:\n\n"
	. "http://$GLOBALS[HTTP_HOST]/account/change_email-complete.php?confirm_hash=$confirm_hash\n\n"
	. " -- the Gnome.org web monkeys\n";

mail ($form_newemail,"Gnome.org Verification",$message,"From: noreply@$GLOBALS[HTTP_HOST]");

site_user_header(array('title'=>"Email Change Confirmation"));
?>

<P><B>Confirmation mailed</B>

<P>An email has been sent to the new address. Follow
the instructions in the email to complete the email change.

<P><A href="/">[ Home ]</A>

<?php
site_user_footer(array());

?>
