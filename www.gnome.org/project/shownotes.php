<?php
//
// SourceForge: Breaking Down the Barriers to Open Source Development
// Copyright 1999-2000 (c) The SourceForge Crew
// http://sourceforge.net
//
// $Id$

require ('pre.php');

$result=db_query("SELECT changes,group_id,preformatted,name "
	. "FROM frs_release WHERE release_id='$release_id'");

if (!$result || db_numrows($result) < 1) {
	echo db_error();
	exit_error("Error - Not Found","That Release Was Not Found");
} else {

	$group_id=db_result($result,0,'group_id');

	site_project_header(array('title'=>"File Release Changelog",'group'=>$group_id,'toptab'=>'downloads'));

	$HTML->box1_top('Notes');

	echo '<h3>Release Name: <A HREF="showfiles.php?group_id='.db_result($result,0,'group_id').'">'.db_result($result,0,'name').'</A></H3>
		<P>';

/*
	Show preformatted or plain notes/changes
*/
	if (db_result($result,0,'preformatted')) {
		echo '
<HR NOSHADE>
<B>Changes:</B>
'.db_result($result,0,'changes').'</PRE>';

	} else {
		echo '
<HR NOSHADE>
<B>Changes:</B>
'.db_result($result,0,'changes');

	}

	$HTML->box1_bottom();

	site_project_footer(array());

}

?>
