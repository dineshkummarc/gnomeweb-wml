<?php
include "pre.php";

$HTML->header(array('title'=>'Latest Releases'));

print "<p align=\"center\"><a href=\"list\">Browse the software map by category</a><br>"
	. "<a href=\"".$GLOALS['sys_default_domain']."/register/\">Add a new project to the "
	. "software map</a></p>\n";

// ## default limit
if (!$limit) $limit = 20;
if ($limit > 100) $limit = 100;

$query = "SELECT groups.group_name AS group_name,"
	. "groups.group_id AS group_id,"
	. "groups.unix_group_name AS unix_group_name,"
	. "groups.short_description AS short_description,"
	. "frs_release.release_date AS release_date,"
	. "frs_release.name AS release_name,"
	. "frs_release.release_id AS filerelease_id "
	. "FROM frs_release,groups WHERE "
	. "frs_release.group_id=groups.group_id "
	. "ORDER BY frs_release.release_date DESC";

//print $query."\n";

$res = db_query ($query,($limit * 3));

$outputtotal = 0;

print "<table cellspacing=\"5\">\n<tr><th>Application</th><th>Updated</th><th>Version</th>"
	. "<th>Description</th></tr>\n";

while ($row = db_fetch_array($res)) {
	if (!$G_RELEASE["$row[group_id]"]) {
		print "<tr valign=\"top\"><td>"
			. "<a href=\"http://$GLOBALS[sys_default_domain]/softwaremap/projects/"
			. $row[unix_group_name]."\">".htmlspecialchars($row[group_name])."</a></td>\n\t"
			. "<td nowrap>".date("Y-m-d", $row[release_date])."</td>\n\t"
			. "<td align=\"center\" nowrap>".$row[release_name]."</td>\n\t"
			. "<td>".$row[short_description]."</td></tr>\n";
		$outputtotal++;
	}
	// ## eliminate dupes, only do $limit of these
	$G_RELEASE["$row[group_id]"] = 1;
	if ($outputtotal >= $limit) break;
}

print "</table>\n";

$HTML->footer ();

?>
