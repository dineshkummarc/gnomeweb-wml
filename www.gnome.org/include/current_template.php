<?php

class HTML
{
	function img($file, $height, $width, $alt = "", $params = 0)
	{
		$output = "<img src=\"".$GLOBALS['sys_http_domain']."/images/".$file."\" "
			. "height=\"".$height."\" width=\"".$width."\" alt=\"".$alt."\" ";

		if ($params)
		{
			if (isset($params['align'])) $output .= "align=\"".$params['align']."\" ";
			if (isset($params['hspace'])) $output .= "hspace=\"".$params['hspace']."\" ";
			if (isset($params['vspace'])) $output .= "vspace=\"".$params['vspace']."\" ";
		}

		if (!$params['border'])
		{
			$output .= "border=\"0\" ";
		}
		else 
		{
			$output .= "border=\"".$params['border']."\" ";
		}
		
		$output .= ">";
		
		return $output;
	}
	
	function img_clear ($height = 1, $width = 1)
	{
		return $this->img ('dot.gif',$height,$width,'');
	}

	var $COLOR_HTMLBOX_BACK = "#FFFFFF";
	var $COLOR_HTMLBOX_TITLE = "#CCCCCC";
	
	function box1_top($title,$echoout=1,$bgcolor='',$start_first_row=1){
		if (!$bgcolor) {
			$bgcolor=$this->COLOR_HTMLBOX_BACK;
		}
		$return = '<TABLE cellspacing="1" cellpadding="5" width="100%" border="0" bgcolor="'.$this->COLOR_HTMLBOX_BACK.'">
			<TR BGCOLOR="'.$this->COLOR_HTMLBOX_TITLE.'" align="center">
				<TD colspan=2><SPAN class=titlebar>'.$title.'</SPAN></TD>
			</TR>';

		//backwards compatibility hack
		//many places assumed the row would be started
		if ($start_first_row) {
			$return .= '<TR align=left bgcolor="'.$bgcolor.'">
				<TD colspan=2>';
		}
		if ($echoout) {
			print $return;
		} else {
			return $return;
		}
	}

	/**
	 * box1_middle() - Box Middle, equivalent to html_box1_middle()
	 *
	 * @param	string	The box title
	 * @param	string	The box background color
	 * @param	string  The title background color
	 * @param	bool	Whether to start the first row or not
	 * @returns	Middle box HTML content
	 */
	function box1_middle($title,$bgcolor='',$title_bgcolor='',$start_first_row=1) {
		if (!$bgcolor) {
			$bgcolor=$this->COLOR_HTMLBOX_BACK;
		}
		if (!$title_bgcolor) {
			$title_bgcolor=$this->COLOR_HTMLBOX_BACK;
		}
		$return = '
				</TD>
			</TR>
			<TR BGCOLOR="' . $title_bgcolor . '" align="center">
				<TD colspan=2><SPAN class=titlebar>'.$title.'</SPAN></TD>
			</TR>';

		//backwards compatibility hack
		//many places assumed the row would be finished up
		if ($start_first_row) {
			$return .= '<TR align=left bgcolor="'.$bgcolor.'">
				<TD colspan=2>';
		}
		return $return;
	}

	/**
	 * box1_bottom() - Box Bottom, equivalent to html_box1_bottom()
	 *
	 * @param	bool	Whether to echo or return the output
	 */
	function box1_bottom($echoout=1) {
		$return = '
		</TD>
			</TR>
	</TABLE>
';
		if ($echoout) {
			print $return;
		} else {
			return $return;
		}
	}

	
	function header($params = 0)
	{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<?php
		print "<title>GNOME - ";

		if ($params['title'])
		{
			print $params['title'];
		}
		else
		{
			print "Computing Made Easy";
		}
?>
</title>

<style type="text/css">#menutasks {position: absolute; left: 129px; top: 21px; z-index: 101;visibility: hidden; width: 181px;} #menusections {position: absolute; left: 192px; top: 21px; z-index: 101;visibility: hidden; width: 181px;} #menucontact {position: absolute; left: 268px; top: 21px; z-index: 101;visibility: hidden; width: 181px;}</style>

<script language="javascript" src="<?php print $GLOBALS['sys_http_domain']; ?>/menucontrol.js" type="text/javascript" defer>
</script>

</head>

<body bgcolor="#ffffff" text="#000000" marginwidth="0" marginheight="0" leftmargin="0" topmargin="0">

<table border="0" cellspacing="0" cellpadding="0" hspace="0" vspace="0">
<tr><td rowspan="2"><a href="/"><?php print $this->img("logo-small.png", "125", "129", "", array("hspace"=>"0", "vspace"=>"0")); ?></a></td><td>
<a href="javascript:dropdown_tasks();"><?php print $this->img("topbar-tasks.png","22", "63"); ?></a><a
href="javascript:dropdown_sections();"><?php print $this->img("topbar-sections.png", "22", "76"); ?></a><a href="javascript:dropdown_contact();"><?php print $this->img("topbar-contact.png", "22", "133"); ?></a><?php print $this->img("topbar-endcap.png", "22", "200"); ?></td></tr><tr><td><?php print $this->img("banner-getmore.png", "103", "421", "Get More Software"); ?></td></tr></table><?php print $this->img("subpage-side.png", "182", "129", "", array("align"=>"left", "hspace"=>"0", "vspace"=>"0")); ?><table border="0" hspace="0" vspace="0" cellspacing="0"
cellpadding="0"><tr valign="top"><td>

<?php
	}

	function footer($params = 0)
	{
		print "<br clear=\"all\">\n"
			. $this->img("background.png", "250", "488", "", array("align"=>"right"));
?>
</td><td width="8">&nbsp;</td></tr></table>

<?php $this->subpage_menu(); ?>

</body>
</html>
<?php
	}

	function menurow($image, $alt, $url)
	{
		return "<td><a href=\"".$url."\">".$this->img("sidebar-".$image.".png", "18", "168",
			$alt, array("hspace"=>"0", "vspace"=>"0"))."</a></td>";
	}


	function subpage_menu()
	{
?>
<div id="menutasks"><table width="181" border="0" hspace="0" vspace="0"
cellpadding="0" cellspacing="0" bgcolor="#000000" name="menutasks">
<tr><td rowspan="7"><?php print $this->img("dot.gif", "1", "1"); ?></td>
<td width=12 background="<?php print $GLOBALS['sys_http_domain']; ?>/images/sidebar-stripe-green.png" rowspan="7"><?php print $this->img("dot.gif", "1", "12"); ?></td>
<?php 
print $this->menurow("findout", "Find out what GNOME is", "/intro/findout.html")."</tr>\n<tr>"
. $this->menurow("seegnome", "See GNOME in action", "/seegnome.html")."</tr>\n<tr>"
. $this->menurow("getgnome", "Get GNOME", "/start/")."</tr>\n<tr>"
. $this->menurow("learn", "Learn to use GNOME", "/learn/")."</tr>\n<tr>"
. $this->menurow("getmore", "Get more software", "/softwaremap/")."</tr>\n<tr>"
. $this->menurow("developwith", "Develop with GNOME", "http://developer.gnome.org")."</tr>\n<tr>"
. $this->menurow("contribute", "Contribute to GNOME", "/todo/index.php3")."</tr>\n";
?>
<tr>
      <td colspan="3"><a href="javascript:pullup_tasks();"><?php print $this->img("popdown-endcap-green.png","10","181"); ?></a></td>
    </tr>
</table></div>

<div id="menusections"><table width="181" border="0" hspace="0" vspace="0"
cellpadding="0" cellspacing="0" bgcolor="#000000" name="menusections">
<tr><td rowspan="9"><?php print $this->img("dot.gif", "1", "1"); ?></td>
<td width=12 background="<?php print $GLOBALS['sys_http_domain']; ?>/images/sidebar-stripe-blue.png" rowspan="9"><?php print $this->img("dot.gif", "1", "12"); ?></td>
<?php
print $this->menurow("latestnews", "Latest news", "http://news.gnome.org/gnome-news/")."</tr>\n<tr>"
. $this->menurow("calendar", "Calendar", "/resources/calendar.html")."</tr>\n<tr>"
. $this->menurow("developerinterviews", "Developerinterviews", "/developerinterviews/index.html")."</tr>\n<tr>"
. $this->menurow("gnomeoffice", "GNOME Office", "/gnome-office/")."</tr>\n<tr>"
. $this->menurow("resourceindex", "Resource index", "/resources/")."</tr>\n<tr>"
. $this->menurow("reportbugs", "Bug reporting system", "http://bugzilla.gnome.org/")."</tr>\n<tr>"
. $this->menurow("translations", "Translations", "/i18n/")."</tr>\n<tr>"
. $this->menurow("faq", "Frequently Asked Questions", "/faqs/")."</tr>\n<tr>"
. $this->menurow("gnomefoundation", "GNOME Foundation", "http://foundation.gnome.org/")."</tr>";
?>
<tr>
      <td colspan="3"><a href="javascript:pullup_sections();"><?php print $this->img("popdown-endcap-blue.png","10","181"); ?></a></td>
    </tr>
</table></div>


<div id="menucontact"><table width="181" border="0" hspace="0" vspace="0"
cellpadding="0" cellspacing="0" bgcolor="#000000" name="menucontact">
<tr><td rowspan="5"><?php print $this->img("dot.gif", "1", "1"); ?></td>
<td width=12 background="<?php print $GLOBALS['sys_http_domain']; ?>/images/sidebar-stripe-purple.png" rowspan="5"><?php print $this->img("dot.gif", "1", "12"); ?></td>
<?php
print $this->menurow("mailinglists", "Mailing lists", "http://mail.gnome.org/")."</tr>\n<tr>"
. $this->menurow("developersbyregion", "Developers by region", "/developers/")."</tr>\n<tr>"
. $this->menurow("speakingabout", "Speaking about GNOME", "/speakingabout.html")."</tr>\n<tr>"
. $this->menurow("pressreleases", "Press releases", "/pressreleases.html")."</tr>\n<tr>"
. $this->menurow("commercialsupport", "Commercial support", "/commsupp.html")."</tr>\n";
?>
<tr>
      <td colspan="3"><a href="javascript:pullup_contact();"><?php print $this->img("popdown-endcap-purple.png","10","181"); ?></a></td>
    </tr>
</table></div>

<?php
	}
}

?>
