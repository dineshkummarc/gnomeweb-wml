<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

require "pre.php";    
session_require(array('isloggedin'=>1));

db_query("UPDATE users SET "
	. "show_email=" . ($form_show_email ? "1" : "0") . " "
	. "WHERE user_id=" . user_getid());

session_redirect("/account/");

?>
