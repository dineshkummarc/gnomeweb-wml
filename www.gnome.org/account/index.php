<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

require ('pre.php');    

session_require(array('isloggedin'=>'1'));

site_user_header(array('title'=>"Account Maintenance"));

// get global users vars
$res_user = db_query("SELECT * FROM users WHERE user_id=" . user_getid());
$row_user = db_fetch_array($res_user);

$HTML->box1_top("Account Maintenance: " . user_getname()); ?>

<p>Welcome, <b><?php print user_getname(); ?></b>. 
<p>You can view/change all of your account features from here. You may also wish
to view your developer/consultant profiles and ratings.

<UL>
<LI><A href="/users/<?php print strtolower($row_user['user_name']); ?>/"><B>View My Developer Profile</B></A>
</UL>
<?php $HTML->box1_bottom(); ?>

<TABLE width="100%" border="0">

<TR>
<TD colspan="4">&nbsp;</TD>
<TD align="center">Photograph:</TD>
</TR>

<TR>
<TD style="padding-right: 5px;">Login Name:</TD>
<TD style="padding-right: 5px;"><B><?php print strtolower($row_user['user_name']); ?></B></TD>
<TD nowrap><A href="change_pw.php">[Change Password]</A></TD>
<TD width="100%" rowspan="4">&nbsp;</TD>
<TD nowrap align="center" rowspan="5"><IMG SRC="<?php
if ($row_user['photo'] != NULL)
{
	$GLOBALS['user_photo'] = $row_user['photo'];
	print "/images/user_photo.png";
}
else
{
	print "/images/nophoto.jpg";
}
?>">
<!--<BR><A href="change_photo.php">[Change Photograph]</A>-->
</TD> 
</TR>

<TR>
<TD style="padding-right: 5px;">Timezone/Language:</TD>
<TD style="padding-right: 5px;"><B><?php print $row_user['timezone']; ?></B> / <B><?php echo $Language->getLanguageName($row_user['language']); ?></B></TD>
<TD nowrap><A href="change_timezone.php">[Change]</A></TD>
</TR>

<TR>
<TD style="padding-right: 5px;">Real Name:</TD>
<TD style="padding-right: 5px;"><B><?php print $row_user['realname']; ?></B></TD>
<TD nowrap><A href="change_realname.php">[Change Real Name]</A></TD>
</TR>

<TR>
<TD style="padding-right: 5px;">Email Address:</TD>
<TD style="padding-right: 5px;"><B><?php print $row_user['email']; ?></B></TD>
<TD nowrap><A href="change_email.php">[Change Email]</A></TD>
</TR>

<TR>
<TD colspan="4"><BR><BR></TD>
</TR>

</TABLE>

<BR>

<TABLE width="100%" border="0">

<TR>
<TD>
<?php 
// ############################# Preferences
$HTML->box1_top("Preferences"); ?>
<FORM action="updateprefs.php" method="post">

<P><INPUT type="checkbox"  name="form_show_email" value="1"<?php
	if ($sf_user_hash) print " checked"; ?>> Show "spam-proofed" email address.


<P align=center><CENTER><INPUT type="submit" name="Update" value="Update"></CENTER>
</FORM>
<?
$HTML->box1_bottom();
?>

</TD>
</TR>

</TABLE>

<?php
site_user_footer(array());
?>
