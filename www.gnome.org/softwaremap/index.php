<?php
require "pre.php";

$HTML->header(array('title'=>'Software Map'));
?>

<p><font size="+2" color="#400000"><b>Welcome to the GNOME software
map.</b></font></p>

<p>Here you can find all the great software that's available for your GNOME
desktop:</p>

<p>
<a href="list">Browse the software map by category.</a><br>
<a href="latest.php">View most recently changed entries.</a><br>
</p>

<p>
<a href="<?php print $GLOBALS['sys_http_domain']."/account/login.php"; ?>">Log into the software map.</a><br>
<a href="<?php print $GLOBALS['sys_http_domain']."/register/"; ?>">Add a new project to the software map.</a><br>
</p>

<p>Contact <a href="webmaster@gnome.org">webmaster@gnome.org</a> with questions.</p>

<?php
$HTML->footer();
?>
