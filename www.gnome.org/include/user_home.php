<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

/*

	Developer Info Page
	Written by dtype Oct 1999


	Assumes $user object for displayed user is present


*/

//require ('vote_function.php');

$HTML->header(array('title'=>'User Profile'));

?>

<H3>User Profile</H3>
<P>
<TABLE width=100% cellpadding=2 cellspacing=2 border=0><TR valign=top>
<TD>

<?php echo $HTML->box1_top("Personal Information",true,false,false); ?>

<TR valign=top>
	<TD>Login Name: </TD>
	<TD><B><?php print $user->getUnixName(); ?></B></TD>
</TR>

<TR valign=top>
	<TD>Real Name: </TD>
	<TD><B><?php print $user->getRealName(); ?></B></TD>
</TR>
<?php
/*
<TR valign=top>
	<TD>Email Addr: </TD>
	<TD>
	<B><A HREF="/sendmessage.php?touser=<?php print $user_id; 
		?>"><?php print $user->getUnixName(); ?> at <?php print $GLOBALS['sys_users_host']; ?></A></B>
	</TD>
</TR>
*/
?>

<TR><TD COLSPAN=2>
	<H4>Project Info</H4>
	<P>
<?php
	// now get listing of groups for that user
	$res_cat = db_query("SELECT groups.group_name, "
	. "groups.unix_group_name, "
	. "groups.group_id, "
	. "user_group.admin_flags "
	. "FROM groups,user_group WHERE user_group.user_id='$user_id' AND "
	// We don't need to block out foundries from displaying.
	//. "groups.group_id=user_group.group_id AND groups.is_public='1' AND groups.status='A' AND groups.type='1'");
	. "groups.group_id=user_group.group_id AND groups.is_public='1' AND groups.status='A'");

// see if there were any groups
if (db_numrows($res_cat) < 1) {
	?>
	<p>This person is not a member of any projects.
	<?php
} else { // endif no groups
	print "<p>This developer is a member of the following groups:<BR>&nbsp;";
	while ($row_cat = db_fetch_array($res_cat)) {
		print ("<BR>" . "<A href=\"/softwaremap/projects/$row_cat[unix_group_name]/\">$row_cat[group_name]</A>\n");
	}
	print "</ul>";
} // end if groups

$HTML->box1_bottom(); ?>

</TD>
<TD width="160">
<?php
$HTML->box1_top("Picture");
print $HTML->img("nophoto.jpg", "175", "150", "No photo submitted");
$HTML->box1_bottom();
?>
</TD>
</TR>
</TABLE>

<?php

$HTML->footer(array());

?>
