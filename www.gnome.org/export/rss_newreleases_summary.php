<?php
// ## export gnome.org file releases in RSS
include("pre.php");
include "rss_utils.inc";
header("Content-Type: text/plain");

function bad ()
{
	die ('No soup for you!');
}

if ($HTTP_GET_VARS['date'])
{
	$date = $HTTP_GET_VARS['date'];

	if (strlen ($date) != 8) bad ();

	$y = intval (substr ($date, 0, 4));
	$m = intval (substr ($date, 4, 2));
	$d = intval (substr ($date, 6, 2));

	if (!checkdate ($m, $d, $y)) bad ();
}
else bad ();

print '<?xml version="1.0"?>
<apps>
';

$query = "SELECT groups.group_name AS group_name,"
	. "groups.group_id AS group_id,"
	. "groups.short_description AS short_description,"
	. "groups.mini_description AS mini_description,"
	. "frs_release.release_date AS release_date "
	. "FROM frs_release,groups WHERE "
	. "frs_release.group_id=groups.group_id "
	. "AND frs_release.release_date >= '".mktime (0,0,0,$m,$d,$y)."' "
	. "ORDER BY frs_release.release_date DESC";

//print $query."\n";

$res = db_query ($query);

$outputtotal = 0;
while ($row = db_fetch_array ($res)) {
	print "  <app>\n";
	print "   <name>".htmlspecialchars ($row['group_name'])."</name>\n";

	if ($row['mini_description'] != "")
	{
		print "   <desc>".rss_description (str_replace ("\n", "", trim ($row['mini_description'])))."</desc>\n";
	}
	else
	{
		print "   <desc>".rss_description (str_replace ("\n", "", trim ($row['short_description'])))."</desc>\n";
	}
	
	print "  </app>\n";
	$outputtotal++;
}
// ## end output
?>
</apps>
