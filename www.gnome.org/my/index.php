<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

require ('pre.php');
//require ('vote_function.php');

global $G_SESSION;

if (user_isloggedin() || $gnome_user_hash) {

	/*
	 *  If user has valid "remember-me" hash, instantiate not-logged in
	 *  session for one.
	 */
	if (!user_isloggedin()) {
			list($user_id,$hash)=explode('_',$gnome_user_hash);
			$sql="SELECT * 
			FROM users 
			WHERE user_id='".$user_id."' AND user_pw LIKE '".$hash."%'";

		$result=db_query($sql);
		$rows=db_numrows($result);
		if (!$result || $rows != 1) {
			exit_not_logged_in();
		}
		$user_id=db_result($result,0,'user_id');
		$G_SESSION=user_get_object($user_id,$result);
	}

	echo site_user_header(array('title'=>'My Personal Page'));
	?>

	<H3>Personal Page for: <?php print $G_SESSION->getUnixName(); ?></H3>
	<P>
	Your personal page contains lists of bugs and tasks that 
	you are assigned, plus a list of groups that you are a member of.
	<P>
	<TABLE width="100%" border="0">
	<TR><TD VALIGN="TOP" WIDTH="50%">
	<?php
	echo $HTML->box1_top('My Projects',false,false,false);
	// Include both groups and foundries; developers should be similarly
	// aware of membership in either.
	$result = db_query("SELECT groups.group_name,"
		. "groups.group_id,"
		. "groups.unix_group_name,"
		. "groups.status,"
		. "user_group.admin_flags "
		. "FROM groups,user_group "
		. "WHERE groups.group_id=user_group.group_id "
		. "AND user_group.user_id='". user_getid() ."' "
		. "AND groups.status='A' AND groups.is_public=1");
	$rows=db_numrows($result);
	if (!$result || $rows < 1) {
		echo "<TR><TD COLSPAN=\"2\"><B>You're not a member of any public projects</B></TD></TR>";
		echo db_error();
	} else {
		for ($i=0; $i<$rows; $i++) {
			echo '
			<TR BGCOLOR="'. html_get_alt_row_color($i) .'"><TD ALIGN="MIDDLE">
			<A href="rmproject.php?group_id='. db_result($result,$i,'group_id') .'"><IMG SRC="/images/trash.png" ALT="DELETE" HEIGHT="16" WIDTH="16" BORDER="0"></A></TD>
			<TD><A href="/softwaremap/projects/'. db_result($result,$i,'unix_group_name') .'/">'. db_result($result,$i,'group_name') .'</A> (<A HREF="/project/admin/?group_id='.db_result($result,$i,'group_id').'">Admin</A>)</TD></TR>';
		}
	}
	echo $HTML->box1_bottom();


//second column of "my" page

	?>
	</TD><TD VALIGN="TOP" WIDTH="50%">
	<?php

	/*
		   Personal bookmarks
	*/
	/*
	echo $HTML->box1_middle('My Bookmarks',false,false);

	$result = db_query("SELECT bookmark_url, bookmark_title, bookmark_id from user_bookmarks where ".
		"user_id='". user_getid() ."' ORDER BY bookmark_title");
	$rows=db_numrows($result);
	if (!$result || $rows < 1) {
		echo '
		<TR><TD COLSPAN="2"><B>You currently do not have any bookmarks saved</B></TD></TR>';
		echo db_error();
	} else {
		for ($i=0; $i<$rows; $i++) {
			echo '
			<TR BGCOLOR="'. html_get_alt_row_color($i) .'"><TD ALIGN="MIDDLE">
			<A HREF="/my/bookmark_delete.php?bookmark_id='. db_result($result,$i,'bookmark_id') .'">
			<IMG SRC="/images/trash.png" HEIGHT="16" WIDTH="16" BORDER="0"></A></TD>
			<TD><B><A HREF="'. db_result($result,$i,'bookmark_url') .'">'.
			db_result($result,$i,'bookmark_title') .'</A></B> &nbsp;
			<SMALL><A HREF="/my/bookmark_edit.php?bookmark_id='. db_result($result,$i,'bookmark_id') .'">[Edit]</A></SMALL></TD</TR>';
		}
	}
	*/

	/*
		PROJECT LIST
	*/

	echo $HTML->box1_top("This space for rent",false,false,false);

	echo $HTML->box1_bottom();

	echo '</TD></TR>';

	// Bottom Row

	echo '
	</TABLE>';

	echo site_user_footer(array());

} else {

	exit_not_logged_in();

}

?>
