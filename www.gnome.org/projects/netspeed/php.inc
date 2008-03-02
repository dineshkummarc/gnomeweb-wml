<?php

/*
function create_link($link)
{
	$real_link = "packages/" . $link;
	$size = filesize($real_link);
	
	$mtime = filemtime($real_link);
	
	$units = array(' B', ' KB', ' MB');
	for ($i = 0; $size > 1024; $i++) $size /= 1024;
	$nsize = round($size, 2).$units[$i];
	
	printf("<a href=\"%s\">%s</a> (%s; released %s)", $real_link, $link, $nsize, date("D, d M Y", $mtime));
}
*/

function last_modified()
{
	putenv("TZ=Europe/Berlin");
	printf("Last modified: %s", date("D, d M Y", getlastmod()));
}

function display_counter()
{
	$counter = file("./counter.txt");
	if(!(is_array($counter))) $count = 0;
	else { 
		$count = $counter[0]+1;
	        $fp = fopen("./counter.txt", "w+");
		fwrite($fp, ($count)."\n");
	        fclose($fp); 
	}
	printf("%d people have visited this page so far.\n", $count);
}

?>
