<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

/* Updated rewrite of the File Release System to clean up the UI 
 * a little and incorporate FRS.class.		-Darrell
 */

require ('pre.php');    
require ('frs.class');
require ($DOCUMENT_ROOT.'/project/admin/project_admin_utils.php');
session_require(array('group'=>$group_id));
$project=&group_get_object($group_id);
if (!$project->userIsReleaseTechnician()) exit_permission_denied();

project_admin_header(array('title'=>'Release New Application Version','group'=>$group_id));

// Create a new FRS object
$frs = new FRS($group_id);

/*
 * Here's where we do the dirty work based on the step the user has chosen
 */

// Edit release info
if ($step1) {	
	$exec_changes = true;

	// Check for uplaoded change logs
	if (($uploaded_changes != "") && ($uploaded_changes != "none")) {
		$changes = addslashes(fread(fopen($HTTP_POST_FILES['uploaded_changes']['tmp_name'],'r'),
			filesize($HTTP_POST_FILES['uploaded_changes']['tmp_name'])));
		if ((strlen($changes) < 20) || (strlen($changes) > 256000)) {
			$feedback .= " Release Notes are either too small or too large ";
			$exec_changes = false;
		}
	} else {
		$changes = $release_changes;
	}

	// If we haven't encountered any problems so far then save the changes
	if ($exec_changes == true) {
		if ($frs->frsChangeRelease($release_date, $release_name, $preformatted, $announce,
			$status_id, htmlspecialchars ($changes), $group_id, $release_id)) {

			if ($announce == 1)
			{
				if ($result = session_getdata ($GLOBALS['session_hash']))
				{
					$from = "From: ".db_result($result,0,'realname')." <"
						. db_result($result,0,'email').">";
				}
				else
				{
					$from = "From: GNOME Software Map <webmaster@gnome.org>";
				}
	
				// Announce the release to gnome-announce
				mail ("gnome-announce-list@gnome.org",
					"ANNOUNCE: ".$project->getPublicName()." ".stripslashes ($release_name),
					wordwrap (stripslashes ($changes)),
					$from);
			}
			
			$feedback .= " Data Saved ";
		} else {
			$feedback .= $frs->getErrorMessage();
		}
	}
} 

if( !$release_id ) {
	$res=$frs->frsGetReleaseList($pkg_str);
	$rows=db_numrows($res);
	if (!$res || $rows < 1) {
		echo '<h4>You Have No Releases Defined</h4>';
		echo db_error();
	} else {
		/*
			Show a list of releases
			For this project
		*/
		$title_arr=array();
		$title_arr[]='Release Name';
		$title_arr[]='Status';
	
		echo html_build_list_table_top ($title_arr);

		for ($i=0; $i<$rows; $i++) {
?>

<tr bgcolor="<?php echo html_get_alt_row_color($i); ?>">
	<td>
		<font size="-1">
			<?php echo db_result($res,$i,'release_name'); ?>
			<a href="editreleases.php?release_id=<?php echo db_result($res,$i,'release_id'); ?>&group_id=<?php echo $group_id; ?>">[Edit This Release]</a>
		</font>
	</td>
	<td>
		<font size="-1"><?php echo db_result($res,$i,'status_name'); ?></font>
	</td>
</tr>
</form>

<?php
	}
}
	echo "</table>\n";
}

/*
 * Show the forms for each step
 */
if( $release_id ) {
?>

<h3>
Step 1:&nbsp;&nbsp;
Edit Existing Release
</h3>

<form enctype="multipart/form-data" method="post" action="<?php echo $PHP_SELF; ?>">
<input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
<input type="hidden" name="release_id" value="<?php echo $release_id; ?>">
<input type="hidden" name="step1" value="1">
<table border="0" cellpadding="1" cellspacing="1">
<?php
	if(!($result = $frs->frsGetRelease($release_id))) {
		$feedback .= $frs->getErrorMessage();
	}
?>
<tr>
	<td width="10%"><b>Release Date:<b></td>
	<td><input type="text" name="release_date" value="<?php echo date('Y-m-d',db_result($result,0,'release_date')) ?>" size="10" maxlength="10"></td>
</tr>
<tr>
	<td><b>Release Name:<b></td>
	<td><input type="text" name="release_name" value="<?php echo htmlspecialchars(db_result($result,0,'release_name')); ?>"></td>
</tr>
<tr>
	<td><b>Status:</b></td>
	<td>
		<?php 
			echo frs_show_status_popup('status_id',db_result($result,0,'status_id')); 
		?>
	</td>
</tr>
<tr>
	<td colspan="2">
		<br>
		Edit the release notes for this release.<br>
		You can either upload the release notes individually, or paste it in below.<br><br>
		Release notes should be text only.<br><br>
	</td>
</tr>
<tr>
	<td nowrap><b>Upload Release Notes:</b></td>
	<td><input type="file" name="uploaded_changes" size="30"></td>
</tr>
<TR>
	<td COLSPAN=2>
		<b>Paste the release notes in:</b><br>
		<textarea name="release_changes" rows="15" cols="80" wrap="soft"><?php 
		
		$changes = db_result($result,0,'changes');

		if ($changes != "")
		{
			print htmlspecialchars($changes);
		}
		else
		{
			print "Application\n===========\n\n".$project->getPublicName()." "
				. db_result($result,0,'release_name')."\n\n"
				. "Description\n===========\n\n".$project->getDescription()."\n\n"
				. "Enhancements\n============\n\n-\n-\n\n"
				. "Fixes\n=====\n\n-\n-\n\n"
				. "Download\n========\n\nhttp://ftp.gnome.org/pub/GNOME/";
		}
			
		?></textarea>
	</td>
</tr>
<TR>
	<TD colspan="2" nowrap>
		<!-- <input type="checkbox" name="preformatted" value="1" <?php echo ((db_result($result,0,'preformatted'))?'checked':''); ?>> Preserve my pre-formatted text. -->
		<input type="hidden" name="preformatted" value="1">
	</td>
</tr>
<TR>
	<TD colspan="2" nowrap>
		<br>
		<b>Announce this release:</b><br>
		Note: This will send an email that appears to come from your registered email address.<br>
		<?php
		if (db_result($result,0,'announce') == 1)
		{
			print "<p>This release has already been announced.</p>\n";
		}
		else
		{
			print "<p><input type=\"checkbox\" name=\"announce\" value=\"1\"> Announce this release to the gnome-announce mailing list.</p>";
		}
		?>
		<p>
		<input type="submit" name="submit" value="Submit/Refresh">
	</td>
</tr>
</table>
</form>

<?php
}
	project_admin_footer(array());
?>
