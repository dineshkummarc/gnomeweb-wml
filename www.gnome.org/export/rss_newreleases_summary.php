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
elseif (isset ($HTTP_GET_VARS['send_report']))
{
	$date = time () - 604800; // Now minus a week
	$y = date ("Y", $date);
	$m = date ("m", $date);
	$d = date ("d", $date);
}
else bad ();

$output = '<?xml version="1.0"?>
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
	$output .= "  <app>\n";
	$output .= "   <name>".htmlspecialchars ($row['group_name'])."</name>\n";

	if ($row['mini_description'] != "")
	{
		$output .= "   <desc>".rss_description (str_replace ("\n", "", 
			trim ($row['mini_description'])))."</desc>\n";
	}
	else
	{
		$output .= "   <desc>".rss_description (str_replace ("\n", "", 
			trim ($row['short_description'])))."</desc>\n";
	}
	
	$output .= "  </app>\n";
	$outputtotal++;
}

$output .= "</apps>";

if (isset ($HTTP_GET_VARS['send_report']))
{
	mail ("gnome-summary@gnome.org", "Software Map releases this last week",
		$output, "From: webmaster@gnome.org");
}
else
{
	print $output;
}

?>
