<?php

	/*** All tools and their supported distro/version combos go here ***/
	$tool = array(
		"Runlevel"	=> array(
			"metadata"		=> array(
					"icon" => "tool_runlevel.png", 
					"description" => "This tool is used to select which services should be run at each runlevel."
				),
			"Debian GNU/Linux"	=> array ( "2.2 Potato", "Sarge", "3.0 Woody" ),
			"Mandrake Linux"	=> array ( "7.1", "7.2", "9.1" ),
			"Red Hat Linux"	=> array ( "5.2", "6.0", "6.1", "6.2", "7.0", "7.1", "7.2", "8.0", "9.0" ),
			"SuSE Linux"	=> array ( "7.0" ),
			"Turbolinux"	=> array( "7.0" ),
			"PLD Linux"    => array( "1.0" )
		),
		"Network"	=> array(
			"metadata"		=> array(
					"icon" => "tool_ethernet.png",
					"description" => "This tool is used to setup network cards, Internet connections and file shares."
				),
			"Debian GNU/Linux"	=> array ( "2.2 Potato", "Sarge", "3.0 Woody" ),
			"Mandrake Linux"	=> array ( "7.1", "7.2" ),
			"Red Hat Linux"	=> array ( "5.2", "6.0", "6.1", "6.2", "7.0", "7.1", "7.2", "8.0", "9.0" ),
			"SuSE Linux"	=> array ( "7.0" ),
			"Turbolinux"	=> array( "7.0" ),
			"PLD Linux"    => array( "1.0" )
		),
		"Time"	=> array(
			"metadata"		=> array(
					"icon" => "tool_time.png",
					"description" => "This tool is used to setup date and time, including timezone."
				),
			"Debian GNU/Linux"	=> array ( "2.2 Potato", "Sarge", "3.0 Woody" ),
			"Gentoo Linux"	=> array ( "gentoo" ),
			"Mandrake Linux"	=> array ( "7.1", "7.2" ),
			"Red Hat Linux"	=> array ( "5.2", "6.0", "6.1", "6.2", "7.0", "7.1", "7.2", "7.3", "8.0" ),
			"Slackware Linux"	=> array ( "8.0", "9.0" ),
			"SuSE Linux"	=> array ( "7.0" ),
			"Turbolinux"	=> array( "7.0" )
		),
		"Users"	=> array(
			"metadata"		=> array(
					"icon" => "tool_users.png",
					"description" => "This tool is used to administrate users and groups on your system."
				),
			"Debian GNU/Linux"	=> array ( "2.2 Potato", "Sarge", "3.0 Woody" ),
			"FreeBSD"	=> array ( "4", "5" ),
			"Mandrake Linux"	=> array ( "7.1", "7.2", "9.1" ),
			"Red Hat Linux"	=> array ( "5.2", "6.0", "6.1", "6.2", "7.0", "7.1", "7.2", "7.3", "8.0", "9.0" ),
			"Slackware Linux"	=> array ( "8.0", "8.1", "9.0" ),
			"SuSE Linux"	=> array ( "7.0" ),
			"Turbolinux"	=> array( "7.0" ),
			"Gentoo"       => array( "1.4" ),
			"PLD Linux"    => array( "1.0" )
		),
		"Boot"	=> array(
			"metadata"		=> array(
					"icon" => "tool_boot.png",
					"description" => "This tool is used to select boot-method and administrate different Linux-kernels."
				),
			"Linux"		=> array ( "Lilo and Grub is supported for all Linux distributions." )
		)
	);
?>
<html>
  <head>
    <title>GNOME System Tools</title>
    <link href="gst.css" rel="stylesheet" type="text/css">

<script>
<!--
	function showtool(target)
	{
		// First, hide all blocks!
		<?php
			while( list($toolkey,$toolval) = each($tool) ) {
				print("obj=(document.all) ? document.all['$toolkey'] : document.getElementById('$toolkey');\n");
				print("obj.style.display='none';\n");
			}
			reset($tool);
		?>
		obj=(document.all) ? document.all[target] : document.getElementById(target);
		obj.style.display='block';
	}
//-->
</script>
  
  </head>
  <body background="images/bg.jpg">
    <table border="0" cellpadding="10">
      <tr>
        <td><img src="images/logo.png"></td>
	<td><img src="images/gst.png"></td>
      </tr>
    </table>
    <table border="0" width="100%" cellpadding="10">
      <tr>
        <td valign="top" width="160">
          <table border="0" width="160" cellspacing="0" cellpadding="0">
            <tr>
              <td width="26"><img src="images/border1.png"></td>
  	      <td bgcolor="#ffffff"></td>
              <td width="26"><img src="images/border2.png"></td>
            </tr>

            <tr>
              <td background="images/side1.png"></td>
	      <td bgcolor="#ffffff">
    	        - <a href="index.html">home</a><br>
	        - <a href="news.html">What's New</a><br>
	        - <a href="structure.html">GST Structure</a><br>
		   - <a href="team.html">GST Team</a><br>
	        - <a href="screenshots.html">Screenshots</a><br>
		   - Distro Support<br>
	        - <a href="download.html">Download</a><br>
	        - <a href="contrib.html">Getting Involved</a><br>
	        - <a href="contact.html">Contacting</a><br>
	        - <a href="bugs.html">Bugs</a><br>
	      </td>
	      <td background="images/side2.png"></td>
            </tr>

            <tr>
              <td><img src="images/border3.png"></td>
	      <td bgcolor="#ffffff"></td>
	      <td><img src="images/border4.png"></td>
            </tr>
          </table>
	</td>

	<td valign="top">
	  <table border="0" width="100%"  cellspacing="0" cellpadding="0">
            <tr>
              <td width="26"><img src="images/border1.png"></td>
              <td bgcolor="#ffffff"></td>
              <td width="26"><img src="images/border2.png"></td>
            </tr>

	    <tr>
	      <td background="images/side1.png"></td>
	      <td bgcolor="#ffffff">

		<h2>Supported distributions</h2>
		<p>
			GNOME System Tools currently supports the following distributions. If your distribution is not listed here, then your work is needed!
			<a href="contrib.html">Click here</a> to find out how you can contribute.
		</p>
		<p>
			Select tool: <select name="tool" onchange="javascript:showtool(this.options[this.selectedIndex].value);">
				<?php
					while( list($toolkey,$toolval) = each($tool) ) {
						print("<option value='$toolkey'>$toolkey</option>");
					}
					reset($tool);
				?>
			</select>
		</p>
		<p>
			<?php

				// Loop through all tools
				while( list($toolkey,$toolval) = each($tool) ) {
					print("<div id='$toolkey' style='display:none'>");
					print("<fieldset><legend><b>".$toolkey."</b></legend>");

					$icon = "";
					$description = "";
					// If any metadata exists, extract it!
					if ( key($toolval) == "metadata" ) {
						extract($toolval['metadata'], EXTR_OVERWRITE);
						next($toolval);
					}

					print("<table cellpadding=1 cellspacing=0 width=100%><tr>");
					print("<td valign=top>$description</td>");
					if ( $icon != "" )
						print( "<td><img src='images/$icon' border=0 align=absmiddle></td>" );
					print("</tr></table>");

					// Loop through all the distros and versions for this tool...
					print("<table cellpadding=1 cellspacing=0 width=100%>");
					$bg_color = "white";
					while( list($key,$value) = each($toolval) ) {
						print("<tr bgcolor='$bg_color'><td>");
						$bg_color = ($bg_color == 'white') ? "#f0f0f0" : "white";
						print( "<b>$key</b> </td><td>" );
						for ( $i = 0; $i < count($value); $i++ ) {
							print("<i>".$value[$i]."</i>&nbsp;");
							if ( $i < count($value)-1 )
								print(",&nbsp;");
						}
						print("</td></tr>");
					} // End of distro-loop
					print("</table></fieldset><br></div>");
				} // End of tool-loop

				reset($tool);
			?>
		</p>


<script>
<!--
	// Display the first tool by default!
	showtool('<?php echo key($tool); ?>');
//-->
</script>

              </td>
	      <td background="images/side2.png"></td>
	    </tr>

            <tr>
              <td><img src="images/border3.png"></td>
              <td bgcolor="#ffffff"></td>
              <td><img src="images/border4.png"></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>

