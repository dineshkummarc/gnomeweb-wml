<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

require ('pre.php');    
require ($DOCUMENT_ROOT.'/project/admin/project_admin_utils.php');

/*
	Quick file release system , Darrell Brogdon, SourceForge, Aug, 2000

	With much code horked from editreleases.php
*/

session_require(array('group'=>$group_id,'admin_flags'=>'A'));
project_admin_header(array('title'=>'Release New Application Version','group'=>$group_id));

if( $submit )
{
	if (!$release_name)
	{
		$feedback .= ' Must must define a release name. ';
		echo db_error();
	}
	else
	{
		//create a new release of this package

		$res=db_query("INSERT INTO frs_release "
			. "(group_id,name,changes,status_id,release_date,released_by) "
			. "VALUES ('$group_id','$release_name','$release_changes'"
			. ",'$status_id','". time() ."','". user_getid() ."')");
		if (!$res)
		{
			$feedback .= ' | Adding Release Failed ';
			echo db_error();
			//insert failed - go back to definition screen
		}
		else 
		{
			//release added - now show the detail page for this new release
			$release_id=db_insertid($res,'frs_release','release_id');
			$feedback .= ' Added Release <BR>';
		}
	}
}
else 
{
?>

<FORM ENCTYPE="multipart/form-data" METHOD="POST" ACTION="<?php echo $PHP_SELF; ?>">
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="1000000">
	<TABLE BORDER="0" CELLPADDING="2" CELLSPACING="2">
	<TR>
		<TD>
			<H4>Release Name:</H4>
		</TD>
		<TD>
			<INPUT TYPE="TEXT" name="release_name">
		</TD>
	</TR>
	<TR>
		<TD>
			<H4>Release Date:</H4>
		</TD>
		<TD>
			<INPUT TYPE="TEXT" NAME="release_date" VALUE="<?php echo date('Y-m-d'); ?>" SIZE="10" MAXLENGTH="10">
		</TD>
	</TR>
	<TR>
		<TD>
			<H4>Status:</H4>
		</TD>
		<TD>
<?php print frs_show_status_popup ($name='status_id') . "<br>"; ?>
		</TD>
	</TR>
	<TR>
		<TD VALIGN="TOP">
			<H4>Change Log:</H4>
		</TD>
		<TD>
			<TEXTAREA NAME="release_changes" ROWS="7" COLS="50"></TEXTAREA>
		</TD>
	</TR>
	<TR>
		<TD COLSPAN="2" ALIGN="CENTER">
			<INPUT TYPE="HIDDEN" NAME="group_id" VALUE="<?php echo $group_id; ?>">
			<INPUT TYPE="SUBMIT" NAME="submit" VALUE="Submit">
		</TD>
	</TR>
	</TABLE>
</FORM>

<?php
}

project_admin_footer(array());
?>
