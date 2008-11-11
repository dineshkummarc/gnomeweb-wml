<?

function template_header($option="") {
	global $topnav;
	$bodytag="";

	if ($option['name'] == "")
		$option['name']="Beagle";

	if ($option['pageid'] != "")
		$bodytag.=' id="page-main"';
		
	if ($option['sidebar'] == 1)
		$bodytag.=' class="with-sidebar"';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
	<head>
		<title><?=$option['name']?></title>
		<?=$option['headmisc']?>
		<style type="text/css">
			@import url(style.css);
		</style>
	</head>

	<body<?=$bodytag?>>
		<div id="header">
			<img src="img/beagle-logo.png" alt="">

			<h1><a href="">Beagle</a></h1>

			<div id="tagline">
			<?
			/*
				&ldquo;Unearthing the porn you thought was gone... In front of your boss.&rdquo;
				*/
				?>
				<!-- &ldquo;Tagline here!&rdquo; -->
			</div>
		</div>
		<hr class="clear spacing">

		<? print $topnav->returnNav(); ?>

		<hr class="clear spacing">

		<div id="content">
			<div id="content-body">
<?
}

function template_footer($option="") {
	global $bottomnav;
?>
					<hr class="clear">
			</div>

				<div id="footer">
					<hr class="clear dotted spacing">
					<? print $bottomnav->returnNav('nav-bottom'); ?>
					Copyright &copy; 2004
				</div>
			</body>
		</html>
<?
}

?>
