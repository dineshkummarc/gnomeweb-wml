<?php

function write_table_header ($show_category)
{
?>
<center>
<table id="table-tasks" cellspacing=2 border=0 width="750">
<thead><tr>
<?php
if ($show_category == "yes") {
?>
    <th style="background: #303030; cursor: n-resize;" onMouseOver="ul(this)" onMouseOut="noul(this)" onClick="tableSort (this, 'Text')" id="column-category"><b><font color="#ffffff"><u>Category</u></font></b></th>
<? } ?>
    <th style="background: #303030;"><b><font color="#ffffff">Task Name</font></b></th>
    <th style="background: #303030; cursor: n-resize;" onMouseOver="ul(this)" onMouseOut="noul(this)" onClick="tableSort (this, 'Money')"><b><font color="#ffffff"><u>Bounty</u></font></b></th>
</tr></thead>
<?php
}

function taskrow ($title, $category, $amount, $id)
{
?>
<tr>
<?php
if ($category != "hidden") { ?>
    <td bgcolor="#d0d0ff"><?php print $category; ?></td>
    <td bgcolor="#d0d0ff" align=left style="cursor: default;" onMouseOver="ul(this)" onMouseOut="noul(this)"><a href="<?php print $category; ?>.php3#<?php print $id; ?>"><?php print $title; ?></a></td>
<?php } else { ?>
    <td bgcolor="#d0d0ff" align=left style="cursor: default;" onMouseOver="ul(this)" onMouseOut="noul(this)"><a href="#<?php print $id; ?>"><?php print $title; ?></a></td>
<?php } ?>
    <td bgcolor="#d0d0ff">$<?php print $amount; ?></td>
</tr>

<?php
}

function write_table_footer ()
{
?>
</table>
</center>
<p>
<?php
}

function box_start ($title, $category = "unset", $bounty = "unset", $id = "UNKNOWN-ID", $bug = "0",
                    $title_fg = "#ffffff", $title_bg = "#303030", $fg = "#000000", 
		    $bg = "#d0d0ff", $width = "750", $titlealign = "left", $tablealign = "left")
{
    static $box_num;
    if (!isset($box_num)) {
	$box_num = 0;
    }
    $box_num++;
?>
    <a name="<?php print $id; ?>"></a><a name="box<?php print $box_num; ?>"></a>
    <table border="0" cellpadding="0" cellspacing="0" align="center" width="<?php print $width ?>">
	      <tr bgcolor="#ffffff"> <td align="<?php print $titlealign; ?>">
		  <table border="0" cellspacing="1" cellpadding="0" width="100%">
		    <tr bgcolor="<?php print $bg; ?>"> <td align="<?php print $tablealign; ?>">
			<table border="0" cellpadding="2" cellspacing="0" width="100%">
			  <tr bgcolor="<?php print $title_bg; ?>"> <td align="<?php print $titlealign; ?>">
			      <font color="<?php print $title_fg; ?>">
				<b><?php print $title ?></b>
			      </font>
			    </td> 
                            <?php if ($bug != "0") { ?>
                            <td align="right">
			      <a href="http://bugzilla.gnome.org/show_bug.cgi?id=<?php print $bug ?>" title="Visit the Bug to meet with others working on this bounty, declare your interest in working on this bounty, and get up to the minute information on this bounty."><font color="<?php print $title_fg; ?>">(Bug #<?php print $bug ?>)</font></a> <font color="#ffffff">|</font> <a href="discuss.php" title="All discussions take place in IRC on irc.gnome.org in #bounties"><font color="<?php print $title_fg; ?>">Discuss</font></a> <font color="#ffffff">|</font> <a href="claim.php3?bounty=<?php print $bug ?>" title="Once your patch has been accepted by the module maintainers and you have registered yourself in the bug, claim your prize here."><font color="<?php print $title_fg; ?>">Claim Bounty</font></a>
			    </td>
			    <?php } ?>
		          </tr>
			</table>
<?php if ($category != "unset") { ?>
			<table border="0" cellpadding="2" cellspacing="0" width="100%">
			  <tr bgcolor="#808080">
			    <td align="left">
			      <font color="<?php print $title_fg; ?>">
				<?php print $category ?>
			      </font>
			    </td>
			    <td align="right">
			      <font color="<?php print $title_fg; ?>">
				Bounty: <font color="#00ff00">$<?php print $bounty ?></font>
			      </font>
			    </td>
			  </tr>
			</table>
<?php } ?>
			<table cellpadding="2" cellspacing="18" border="0"> <tr> <td>

<?php
}

function box_sec ($sec = "")
{
?>
</td></tr>
<tr><td bgcolor="#a0a0a0" align="left"><font color="#ffffff"><?php print $sec; ?></font></td></tr>
<tr><td>
<?php
} 

function box_end ()
{
?>
			      </td></tr></table>
		      </td> </tr>
		  </table>
		</td> </tr>
	    </table> <br>
<?php
} 

function bonsai ($dirname ="UNKNOWN")
{
?><a href="http://cvs.gnome.org/bonsai/rview.cgi?cvsroot=/cvs/gnome&amp;dir=<?php print $dirname; ?>"><?php print $dirname; ?></a><?php
}

function rfc ($num)
{
?><a href="http://www.faqs.org/rfcs/rfc<?php print $num; ?>.html">RFC <?php print $num; ?></a><?php
}

function bug ($num)
{
?><a href="http://bugzilla.ximian.com/show_bug.cgi?id=<?php print $num; ?>">Ximian Bug #<?php print $num; ?></a><?php
}

function gnomebug ($num)
{
?><a href="http://bugzilla.gnome.org/show_bug.cgi?id=<?php print $num; ?>">GNOME Bug #<?php print $num; ?></a><?php
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

function write_page_header ($name, $style = "style.css")
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <script src="dhtml-table.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title><?php print $name; ?></title>
    <LINK REL="stylesheet" HREF="<?php print $style; ?>" TYPE="text/css">
</head>

<body bgcolor="#ffffff" text="#000000" onLoad="defaultSort()">
<center>
<b><font size="+2"><?php print $name; ?></font></b><br>
<a href="index.php3#categories">[Main Page]</a><br><br>
</center>
<?php 
}

?>
