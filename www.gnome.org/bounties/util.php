<?php

function write_table_header ($show_category, $show_funded_by)
{
?>
<table class="table-tasks" cellspacing=2 border=0>
<thead><tr>
<?php
if ($show_category == "yes") {
?>
    <th style="text-decoration:none" class="column-category" style=onMouseOver="ul(this)" onMouseOut="noul(this)" onClick="tableSort (this, 'Text')">Category</th>
<? } ?>
    <th style="text-decoration:none" class="category">Task Name</th>
    <th style="text-decoration:none" class="column-category" style=onMouseOver="ul(this)" onMouseOut="noul(this)" onClick="tableSort (this, 'Money')">Bounty</th>
<?php
if ($show_funded_by == "yes") {
?>
    <th style="text-decoration:none" class="column-category" style=onMouseOver="ul(this)" onMouseOut="noul(this)" onClick="tableSort (this, 'Money')">Funded By</th>
<?php
}
?>
</tr></thead>
<?php
}

function taskrow ($title, $category, $funder, $amount, $id, $solution = "")
{
?>
<tr class="taskrow">
<?php
if ($category != "hidden") { ?>
    <td><a href="<?php print $category; ?>.html"><?php print $category; ?></a></td>
    <td style=onMouseOver="ul(this)" onMouseOut="noul(this)"><?php if ($solution) print "<span class=\"solved\">Solved:</span>"; ?><a STYLE="text-decoration:none" href="<?php print $category; ?>.html#<?php print $id; ?>"><?php if ($solution) {print "<span class=\"solved-strike\">" . $title . "</span>";} else {print $title;} ?></a></td>
<?php } else { ?>
    <td style=onMouseOver="ul(this)" onMouseOut="noul(this)"><?php if ($solution) print "<span class=\"solved\">Solved: </span>"; ?><a STYLE="text-decoration:none" href="#<?php print $id; ?>"><?php if ($solution) {print "<span class=\"solved-strike\">" . $title . "</span>";} else {print $title;} ?></a></td>
<?php } ?>
    <td bgcolor="#d0d0ff" >$<?php print $amount; ?></td>
<?php
    if ($funder != "hidden") { ?>
    <td bgcolor="#d0d0ff" ><a href="<?php print $funder; ?>.html"><?php print $funder; ?></a></td>
<?php
    }
?>    
</tr>

<?php
}

function write_table_footer ()
{
?>
</table>
<p>
<?php
}

function box_start($title, $category = "unset", $bounty = "unset", $id = "UNKNOWN-ID", $bug = "0", $solution = "",
                    $title_fg = "#ffffff", $title_bg = "#303030", $fg = "#000000", 
		    $bg = "#d0d0ff", $width = "650", $titlealign = "left", $tablealign = "left")
{
    global $solved;
    if ($solution) {
       $solved = 1;
    } else {
       $solved = 0;
    }

    static $box_num;
    if (!isset($box_num)) {
	$box_num = 0;
    }
    $box_num++;
?>
  
    <a STYLE="text-decoration:none" name="<?php print $id; ?>"></a><a STYLE="text-decoration:none" name="box<?php print $box_num; ?>"></a>
    <div class="content-box">
      <div class="content-box-header">
	<?php if ($bug != "0") { ?> <?php // This runs if it's a bug ?>
           <?php if($solved) { ?>
	      <span class="table-header"><span class="solved-light">Solved: </span> <?php print $title ?></span>
              <span class="bug-number">             
			      <a STYLE="text-decoration:none" href="http://bugzilla.gnome.org/show_bug.cgi?id=<?php print $bug ?>" title="Visit the Bug to meet with others working on this bounty, declare your interest in working on this bounty, and get up to the minute information on this bounty.">(Bug #<?php print $bug ?>)</a>
	      </span>
           <?php } else { ?>
	      <span class="table-header"><?php print $title ?></span>
              <span class="bug-number">             
			      <a STYLE="text-decoration:none" href="http://bugzilla.gnome.org/show_bug.cgi?id=<?php print $bug ?>" title="Visit the Bug to meet with others working on this bounty, declare your interest in working on this bounty, and get up to the minute information on this bounty.">(Bug #<?php print $bug ?>)</a> | | <a STYLE="text-decoration:none" href="discuss.html" title="All discussions take place in IRC on irc.gnome.org in #bounties">Discuss</a> | <a STYLE="text-decoration:none" href="mailto:bounty@lists.ximian.com?Subject=Submission for Bounty #<?php print $bug ?>&body=Bounty: <?php print $bug ?>%0AName: %0AEmail: %0APhone: %0ASolution: %0ATeam mates: %0AHelp from: %0ANotes: %0ADonate My Winning: %0AAddress to post the cheque: " title="Once your patch has been accepted by the module maintainers and you have registered yourself in the bug, claim your prize here.">Claim Bounty</a>
	    </span>
           <?php } ?>
           </div>
           <div class="content-box-second-header">
	     <?php print $category ?>
	     <span>
	     Bounty: <span class="bounty">$<?php 
			  if ($solved) {
				print "<strike>" . $bounty . "</strike>"; 
			  } else {
				print $bounty;
		          }

			?>
		      </span>
	     </span>
	   </div>
	   <?php if($solved) { ?>
	   <div class="content-box-solved-header">
	      <?php print "This bounty has been solved.  The solution is: <a STYLE=\"text-decoration:none\" href=\"" . $solution . "\">" . $solution . "</a>"; ?>
	   </div>
	   <?php } ?>
        <?php } else { ?> <?php // This runs if it's not a bug ?>
           <div class="table-header"><?php print $title ?></div></div>
        <?php } ?>
      <?php if($solved) {?>
		<div class="content-box-body-solved">
	    <?php } else { ?>
	    	<div class="content-box-body">
	    <?php } ?>
<?php
}

function box_end()
{
?>
      </div>
    </div>
<?php }


function box_sec($sec = "")
{
  global $solved;

  if ($solved) print "</span>";
?>

<?php if($solved) print "<div class=\"headlinebar-solved\">"; else print "<div class=\"headlinebar\">";?> <?php print $sec; ?>
</div>

<?php
if ($solved) print "<span class=\"solved-body\">";
}

function bonsai ($dirname ="UNKNOWN")
{
?><a STYLE="text-decoration:none" href="http://cvs.gnome.org/viewcvs/<?php print $dirname; ?>"><?php print $dirname; ?></a><?php
}

function rfc ($num)
{
?><a STYLE="text-decoration:none" href="http://www.faqs.org/rfcs/rfc<?php print $num; ?>.html">RFC <?php print $num; ?></a><?php
}

function bug ($num)
{
?><a STYLE="text-decoration:none" href="http://bugzilla.ximian.com/show_bug.cgi?id=<?php print $num; ?>">Ximian Bug #<?php print $num; ?></a><?php
}

function gnomebug ($num)
{
?><a STYLE="text-decoration:none" href="http://bugzilla.gnome.org/show_bug.cgi?id=<?php print $num; ?>">GNOME Bug #<?php print $num; ?></a><?php
}

function difficultycolor ($difficulty)
{
    if ($difficulty == "Easy")
        return "#00da00";
	
    if ($difficulty == "Medium")
        return "#f8fc00";

    if ($difficulty == "Hard")
        return "#f80000";
}

function write_page_header ($name)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <script src="dhtml-table.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" media="screen" href="styles.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="http://www.gnome.org/default.css">
    <link rel="icon" type="image/png" href="http://www.gnome.org/img/logo/foot-16.png">
    <title><?php print $name; ?></title>
</head>

<body onLoad="defaultSort()"><div id="body">
<center>
<h1><?php print $name; ?></h1>
<div class="navigation"><a STYLE="text-decoration:none" href="index.html#categories">[Main Page]</a></div>
</center>
<?php 
}

function write_page_footer ()
{
?>
</div>

<div id="sidebar">
<p class="section">More Information</p>
<ul>
<li><a STYLE="text-decoration:none" href="index.html">Bounties Main Page</a><li>
<li><a STYLE="text-decoration:none" href="rules.html">Contest Rules</a></li>
<li><a STYLE="text-decoration:none" href="hints.html">Helpful Hints</a></li>
<li><a STYLE="text-decoration:none" href="discuss.html">Bounties Discussion</a></li>
<li><a STYLE="text-decoration:none" href="Winners.html">Claimed Bounties</a></li>
</ul>
</div>

<div id="hdr">
<div id="logo"><a STYLE="text-decoration:none" href="http://www.gnome.org/"><img src="http://www.gnome.org/img/spacer" alt="Home"></a></div>
<div id="banner"><img src="http://www.gnome.org/img/spacer" alt=""></div>
<p class="none"></p>
<div id="hdrNav">
<a STYLE="text-decoration:none" href="http://www.gnome.org/about/">About GNOME</a> &middot;
<a STYLE="text-decoration:none" href="http://www.gnome.org/start/2.4/">Download</a> &middot;
<a STYLE="text-decoration:none" href="http://www.gnome.org/">Users</a> &middot;
<a STYLE="text-decoration:none" href="http://developer.gnome.org/">Developers</a> &middot;
<a STYLE="text-decoration:none" href="http://foundation.gnome.org/">Foundation</a> &middot;
<a STYLE="text-decoration:none" href="http://www.gnome.org/contact/">Contact</a>
</div>
</div>

<br>
<br>
<center>
<i>These pages were <a STYLE="text-decoration:none" href="build.cs">autogenerated</a> using <a STYLE="text-decoration:none" href="http://www.go-mono.com/">Mono</a>.</i>
</center>
</body>
</html>

<?php
}

?>
