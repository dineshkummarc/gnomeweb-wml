<?php // // SourceForge: Breaking Down the Barriers to Open Source Development // Copyright 1999-2000 (c) The SourceForge Crew // http://sourceforge.net // // $Id$

//require ('vote_function.php');
//require ('vars.php');
//require ($DOCUMENT_ROOT.'/news/news_utils.php');
require ('trove.php');
require ('project_summary.php');

$title = 'Project Info - '. $project->getPublicName();

site_project_header(array('title'=>$title,'group'=>$group_id,'toptab'=>'home'));


// ########################################### end top area

// two column deal
?>

<TABLE WIDTH="100%" BORDER="0">
<TR><TD WIDTH="99%" VALIGN="top">
<?php 

// ########################################## top area, not in box 
$res_admin = db_query("SELECT users.user_id AS user_id,users.user_name AS user_name "
	. "FROM users,user_group "
	. "WHERE user_group.user_id=users.user_id AND user_group.group_id=$group_id AND "
	. "user_group.admin_flags = 'A'");

if ($project->getStatus() == 'H') {
	print "<P>NOTE: This project entry is maintained by the Gnome.org staff. We are not "
		. "the official site "
		. "for this product. Additional copyright information may be found on this project's homepage.\n";
}

print '<p><b>Project Description</b></p>';

if ($project->getDescription()) {
	print "<P>" . $HTML->img_clear("1","15") . $project->getDescription() . "</P>";
} else {
	print "<P>This project has not yet submitted a description.</P>";
}

print '<p><b>Project Links</b></p>
<table cellpadding="0" cellspacing="1">';

if ($project->getHomePage()) 
{
	print '<tr><td width="10">'.$HTML->img_clear ('1','10').'</td><td nowrap>Home Page</td><td>:&nbsp;</td><td>'
		. '<a href="http://' . $project->getHomePage() . '">http://' 
		. $project->getHomePage() . '</a></td></tr>';
}
if ($project->getDownload()) 
{
	print '<tr><td width="10">'.$HTML->img_clear ('1','10').'</td><td nowrap>Download</td><td>:&nbsp;</td><td>'
		. '<a href="' . $project->getDownload() . '">' 
		. $project->getDownload() . '</a></td></tr>';
}
if ($project->getScreenShot()) 
{
	print '<tr><td width="15">'.$HTML->img_clear ('1','15').'</td><td nowrap>Screen Shots</td><td>:&nbsp;</td><td>'
		. '<a href="http://' . $project->getScreenShot() . '">http://' 
		. $project->getScreenShot() . '</a></td></tr>';
}
if ($project->getMailList()) 
{
	print '<tr><td width="10">'.$HTML->img_clear ('1','10').'</td><td nowrap>Mailing List</td><td>:&nbsp;</td><td>'
		. '<a href="http://' . $project->getMailList() . '">http://' 
		. $project->getMailList() . '</a></td></tr>';
}
if ($project->getBugTracker()) 
{
	print '<tr><td width="10">'.$HTML->img_clear ('1','10').'</td><td nowrap>Bug Tracker</td><td>:&nbsp;</td><td>'
		. '<a href="http://' . $project->getBugTracker() . '">http://' 
		. $project->getBugTracker() . '</a></td></tr>';
}
if ($project->getCVS()) 
{
	print '<tr><td width="10">'.$HTML->img_clear ('1','10').'</td><td nowrap>CVS</td><td>:&nbsp;</td><td>'
		. '<a href="http://' . $project->getCVS() . '">http://' 
		. $project->getCVS() . '</a></td></tr>';
}

print '</table>';

// trove info
print "<p><b>Software Map categories</b></p>\n";
trove_getcatlisting($group_id,0,1);
//print '<BR>&nbsp;';

/*
// Get the activity percentile
$actv = db_query("SELECT percentile FROM project_weekly_metric WHERE group_id='$group_id'");
$actv_res = db_result($actv,0,"percentile");
if (!$actv_res) $actv_res=0;

print("Registered: " . date($sys_datefmt, $project->getStartDate()));
print '<br>Activity Percentile: ' . $actv_res . '%';
print '<br>View project activity <a href="/project/stats/?group_id='.$group_id.'">statistics</a>';

$jobs_res = db_query("SELECT name ".
                "FROM people_job,people_job_category ".
                "WHERE people_job.category_id=people_job_category.category_id ".
                "AND people_job.status_id=1 ".
                "AND group_id='$group_id' ".
                "GROUP BY name",2);
if ($jobs_res) {
	$num=db_numrows($jobs_res);
        if ($num>0) {
        	print '<br><br>HELP WANTED: This project is looking for ';
                if ($num==1) {
                	print '<a href="/people/?group_id='.$group_id.'">'.
                              db_result($jobs_res,0,"name").'(s)</a>';
                } else {
                	print 'People to fill '.
                        '<a href="/people/?group_id='.$group_id.'">several '.
                        'different positions</a>';
                }
        }
}
*/

print '</TD><TD NoWrap VALIGN="top">';

// ########################### Developers on this project

echo $HTML->box1_top($Language->DEVELOPER_INFO, 1, '', 0);
print '<TR align=left><TD nowrap>';
?>
<?php
if (db_numrows($res_admin) > 0) {

	?>
	<SPAN CLASS="develtitle"><?php echo $Language->PROJECT_ADMINS; ?>:</SPAN><BR>
	<?php
		while ($row_admin = db_fetch_array($res_admin)) {
			print "<A href=\"/users/$row_admin[user_name]/\">$row_admin[user_name]</A><BR>";
		}
	?>
	<HR WIDTH="100%" SIZE="1" NoShade>
	<?php

}

?>
<SPAN CLASS="develtitle"><?php echo $Language->DEVELOPERS; ?>:</SPAN><BR>
<?php
//count of developers on this project
$res_count = db_query("SELECT user_id FROM user_group WHERE group_id=$group_id");
print db_numrows($res_count);

?>

<A HREF="/project/memberlist.php?group_id=<?php print $group_id; ?>">[View Members]</A>
<?php 

echo $HTML->box1_bottom();

print '
</TD></TR>
</TABLE>
<P>
';


// ############################# File Releases

echo $HTML->box1_top($Language->LATEST_FILE_RELEASES); 
	$unix_group_name = $project->getUnixName();

	echo '
	<TABLE cellspacing="1" cellpadding="5" width="100%" border="0">
		<TR bgcolor="'.$GLOBALS['COLOR_LTBACK1'].'">
		<TD align="center">
			'.$Language->FILE_VERSION.'
		</td>
		<td align="center">
			'.$Language->FILE_REL_DATE.'
		</td>
		<TD align="center">
			'.$Language->FILE_CHANGELOG; //.' / '.$Language->FILE_MONITOR.'
	echo '
		</td>
		<TD align="center">
			'.$Language->FILE_DOWNLOAD.'
		</td>
		</TR>';

		$sql="SELECT name AS release_name, release_id, release_date ".
			"FROM frs_release ".
			"WHERE frs_release.group_id='$group_id' ".
			"AND frs_release.status_id=1 ".
			"ORDER BY release_date DESC";

		$res_files = db_query($sql);
		$rows_files=db_numrows($res_files);
		if (!$res_files || $rows_files < 1) {
			echo db_error();
			// No releases
			echo '<TR BGCOLOR="'.$GLOBALS['COLOR_LTBACK1'].'"><TD COLSPAN="4"><B>This Project Has Not Made Any Releases</B></TD></TR>';

		} else {
			/*
				This query actually contains ALL releases of all packages
				We will test each row and make sure the package has changed before printing the row
			*/
			$rel_date = getdate(db_result($res_files,$f,'release_date'));
			echo '
			<TR BGCOLOR="'.$GLOBALS['COLOR_LTBACK1'].'" ALIGN="center">';
			// Releases to display
			print '<TD>'.db_result($res_files,$f,'release_name') .'
			</TD>
			<td>' . $rel_date["month"] . ' ' . $rel_date["mday"] . ', ' . $rel_date["year"] . '</td>
			<TD><A href="/project/shownotes.php?group_id=' . $group_id . '&release_id=' . db_result($res_files,$f,'release_id') . '">';
			echo html_image("images/manual16c.png",'15','15',array('alt'=>'Change Log'));
			/*
			echo '</A> - <A HREF="/project/filemodule_monitor.php?filemodule_id=' .	db_result($res_files,$f,'package_id') . '">';
			echo html_image("images/mail16d.png",'15','15',array('alt'=>'Monitor This Package'));
			echo '</A>
			*/
			echo '
			</TD>
			<TD>';
			
			if ($project->getDownload() != "")
			{
				echo '<A HREF="'.$project->getDownload().'">'.$Language->FILE_DOWNLOAD.'</A>';
			}
			else
			{
				echo '&nbsp;';
			}
				
			echo '
			</TD></TR>';

		}
		?></TABLE>
	<div align="center">
	<a href="/project/showfiles.php?group_id=<?php print $group_id; ?>">[View ALL Project Releases]</A>
	</div>
<?php
	echo $HTML->box1_bottom();

site_project_footer(array());

?>
