<?php

// Get config variables
require "/home/admin/applist/config.php";

if (($HTTP_HOST != $GLOBALS['sys_default_domain']) && ($HTTP_HOST != $GLOBALS['sys_fallback_domain']) && ($HTTP_HOST != 'localhost') && ($HTTP_HOST != $GLOBALS['sys_default_domain'].':80')) {
	if ($SERVER_PORT == '443') {
		header ("Location: https://".$GLOBALS['sys_default_domain']."$REQUEST_URI");
	} else {
		header ("Location: http://".$GLOBALS['sys_default_domain']."$REQUEST_URI");
	}
	exit;
}

//library to determine browser settings
require('browser.php');

//base error library for new objects
require('Error.class');

// make it work with current site template
require "current_template.php";

$HTML = new HTML();
// Theme system
//require "theme.class";

// Create theme object
//$HTML = new Theme();

//various html utilities
require('utils.php');

// Get database functions
require "database.php";

//user functions like get_name, logged_in, etc
require('User.class');

//group functions like get_name, etc
require('Group.class');

//Project extends Group and includes preference accessors
require('Project.class');

// Security library
require "session.php";

// ldap library
require "ldap.php";

// Help system
require "help.php";

//exit_error library
require('exit.php');

//various html libs like button bar, themable
require('html.php');

$sys_datefmt = "Y-M-d";

// Open database connection
db_connect();

if (!$conn) {
	print "$sys_name Could Not Connect to Database: ".db_error();
	exit;
}

//determine if they're logged in
session_set();

//insert this page view into the database
//require('logger.php');

/*

	Timezone must come after logger to prevent messups


*/

if (user_isloggedin()) {
	//set up the user's timezone if they are logged in
	putenv('TZ='.user_get_timezone());
} else {
	//just use pacific time as always
}

/*

	Now figure out what language file to instantiate

*/

require ('BaseLanguage.class');

if (user_isloggedin()) {
	$user=&user_get_object(user_getid());
	$res=$user->getData();
	$classfile=db_result($res,0,'filename');
	if ($classfile) {
		include ("languages/$classfile");
		$classname=db_result($res,0,'classname');
		$Language=new $classname();
	} else {
		include ('languages/English.class');
	        $Language=new English();
	}
} else {
	//if you aren't logged in, check your browser settings 
	//and see if we support that language
	//if we don't support it, just use English as default
	$res = language_code_to_result ($HTTP_ACCEPT_LANGUAGE);
	$classfile=db_result($res,0,'filename');
	if (!$classfile) $classfile="English.class";
	include ("languages/$classfile");
	$classname=db_result($res,0,'classname');
	if (!$classname) $classname="English";
	$Language=new $classname();
}

?>
