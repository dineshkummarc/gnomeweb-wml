<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

require ('pre.php');    

$sql = "SELECT * FROM frs_release WHERE group_id='$group_id' AND status_id='1'";
$res_release= db_query( $sql );
$num_releases = db_numrows( $res_release);

if ( $num_releases < 1) {
	exit_error("No Releases","There are no releases defined for this project.");
}

site_project_header(array('title'=>'Project Releases','group'=>$group_id,'toptab'=>'downloads'));

echo '
<p>
Below is a list of all releases of the project. ';
if ($release_id) {
	echo 'The release you have chosen is <span style="background-color:pink">highlighted</span>. ';
}
echo 'Before downloading, you may want to read the Change Log
</p>
';

$title_arr = array();
$title_arr[] = 'Release';
$title_arr[] = 'Change Log';
$title_arr[] = 'Download';
$title_arr[] = 'Date';

   // get unix group name for path
$group_unix_name=group_getunixname($group_id);

   // print the header row
//echo html_build_list_table_top($title_arr) . "\n";
function col_heading($title)
{
  return '<FONT COLOR="'.
	$HTML->FONTCOLOR_HTMLBOX_TITLE.'"><B>'.$title.'</B></FONT>';
}

global $HTML;
echo '
<table width="100%" border="0" cellspacing="1" cellpadding="1">
<tr align="middle" BGCOLOR="'. $HTML->COLOR_HTMLBOX_TITLE .'">'.
'<td>'.col_heading('Release').'</td>'.
'<td>'.col_heading('Change Log').'</td>'.
'<td>'.col_heading('Download').'</td>'.
'<td>'.col_heading('Date').'</td>'.
'</tr>';

// get the releases of the project 
$sql = "SELECT * FROM frs_release WHERE group_id='" . $group_id . "' "
	. "AND status_id=1 ORDER BY release_date DESC";
$res_release = db_query( $sql );
$num_releases = db_numrows( $res_release );

if ( !$res_release || $num_releases < 1 ) {
	print '<TR bgcolor="'.$cur_color.'"><TD>&nbsp;&nbsp;<i>No Releases</i></TD><TD COLSPAN="3">&nbsp;</TD></TR>'."\n";
} else {
	   // iterate and show the releases of the package
	for ( $r = 0; $r < $num_releases; $r++ ) {
		$project_release = db_fetch_array( $res_release );

	    	// Highlight the release if one was chosen
	      	if ( $release_id && $release_id == $project_release['release_id'] ) {
	      		$bgcolor = "pink";
	      	} else {
	      		$bgcolor = $cur_color;
	      	}
		print '<TR BGCOLOR="'. $bgcolor .'"><TD>'.$project_release['name'].'</TD>'
			. '<TD align="center"><A HREF="shownotes.php?release_id='.$project_release['release_id'].'">'
			. html_image("images/manual16c.png",'15','15',array('alt'=>'Change Log'))
			. '</A></TD><TD align="center">';
		
		$project = new Project($group_id);

		if ($project->getDownload() != "")
		{
			print '<A HREF="'.$project->getDownload().'">'.html_image("images/save16.png",'15','15',array('alt'=>'Download')).'</A>';
		}
		else
		{
			print '&nbsp;';
		}
			
		print '</TD><TD align="middle">'
			. date( 'Y-m-d'/*$sys_datefmt*/, $project_release['release_date'] ) 
			. '</TD></TR>'."\n";

	}
}

print "</TABLE>\n\n";

site_project_footer(array());

?>
