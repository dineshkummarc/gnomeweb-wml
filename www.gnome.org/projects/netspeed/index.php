<?php require_once("php.inc"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Netspeed: A Netspeed Applet for GNOME</title>
	<link rel="stylesheet" type="text/css" href="http://www.gnome.org/default.css" />
	<link rel="stylesheet" type="text/css" href="netspeed.css" />
	<link rel="icon" type="image/png" href="images/icon.png" />
	<meta name="description" content="The Netspeed Applet Homepage" />
	<meta http-equiv="content-type" content="application/xml+xhtml; charset=utf-8" />
</head>
<body>

<!-- body -->
<div id="body">


<!-- About !-->
<h1><a name="about">What is Netspeed?</a></h1>
<p>
Netspeed is just a little <a href="http://www.gnome.org">GNOME</a>-applet that shows how much traffic occurs on a specified network device (for example eth0).
You get the best impression of it, if you look at the screenshots below.
</p>


<!-- Screenshots -->
<h1><a name="screenshots">How does it look like?</a></h1>
<p>
This screenshot shows netspeed monitoring a W-Lan device.
</p>
<img src="images/netspeed1.png" alt="A screenshot showing a wlan device" />
<p>
A screenshot showing the effect of enabling the "show only sum" setting.
</p>
<img src="images/netspeed2.png" alt="A screenshot showing the show-sum setting enabled" />
<p>
Netspeed in a transparent panel with context menu.
</p>
<img src="images/netspeed3.png" alt="A screenshot showing netspeed in a transparent panel" />
<p>
The preferences dialog.
</p>
<img src="images/netspeed-settings.png" alt="A screenshot showing the preferences dialog" />
<p>
This window shows some details on the selected network device.
</p>
<img src="images/netspeed-details.png" alt="A screenshot showing the details window" />


<!-- Documentation -->
<h1><a name="faq">Documentation &amp; FAQ</a></h1>
<p>
The manual is available via the GNOME Help Browser or via the context menu of the applet.
</p>

<p>
I gathered some FAQ. Please read them before contacting me:
</p>

<h4>I installed the applet, but after starting it from the commandline, nothing happens or I get an error.</h4>
It's not possible to start the applet from the commandline - you have to use the entry in the panel
menu to start the applet.

<h4>I don't have a entry for the applet in the panelmenu.</h4>
First of all, you have to restart the panel before the entry will appear. Second, you have
to install the applet at the same location as the rest of gnome2. (The applet-<tt>.server</tt>-file has to be located
at the same place where all the other .server-files are - usually <tt>/GNOME2_PATH/lib/bonobo/servers/</tt>).

<h4>Why doesn't the applet have a (dis-)connect feature?</h4>
Well, actually it has (since version 0.10). However the setup is currently not
visible in the UI. To set it up, fire up gconf-editor (the applet must be running), and navigate to <tt>/apps/panel/profiles/default/applets/</tt>.
Scroll through the applets until you find an entry with the bonobo_iid <tt>OAFIID:GNOME_NetspeedApplet</tt>. In the prefs
subsection add (or edit the) two keys <tt>up_command</tt> and <tt>down_command</tt>. The values have to be the path to the commands you use to
connect/disconnect your devices (usually /sbin/ifup and /sbin/ifdown). After that, on the commandline, execute <tt>bonobo-slay netspeed</tt>.
The applet should now restart and after that left-clicking on the applet should give you a connect-dialog.

<h4>Why is this feature so difficult to set up?</h4>
I originally didn't want to include this feature in the applet at all, because I think it's more or less a hack.
However it has now been requested so frequently, that I thought it's almost a "must-have". But it's still a hack IMHO, so
that's why it's only available via gconf ATM. If you think you know a (rather simple,) clean, distro independant way (with little ui) to implement this, I'll of course change my mind (patches are wellcome :-)).

<!--
<h4>Why don't you use the official <a href="http://www.romulus2.com/articles/guides/misc/bitsbytes.shtml">IEC</a>
abreviations for kilobyte, megabyte, etc.? (KiB, MiB, etc.)</h4>
I think they look stupid. However, most import the applet would take more space in the panel ;)
-->


<!--<h4>I use FreeBSD, and recent versions of netspeed doesn't work anymore</h4>
Configure netspeed with <tt>./configure enable-libgtop</tt>. Netspeed now uses
it's own (linux specific) code to read the transfered bytes from <tt>/proc/dev/net</tt>.
This is because libgtop has/had a bug which made netspeed crash with ppp0 devices.<br />
If you want to create a patch for FreeBSD, take a look at <tt>src/backend.c</tt>.-->

<!-- Download -->
<h1><a name="download">How do I get it?</a></h1>
<p>
The latest version of Netspeed requires GNOME (&gt;=2.15.x) and GTK (&gt;=2.6).
</p>
<p>
The latest release is version 0.14. Packages available are:
</p>
<ul>
<li>Source Tarball: <a href="http://www.wh-hms.uni-ulm.de/~mfcn/netspeed/packages/netspeed_applet-0.14.tar.gz">netspeed_applet-0.14.tar.gz</a></li>
<li>Debian: use <tt>apt-get install netspeed</tt></li> 
<li>Ubuntu: you need <tt>universe</tt> in your sources.list, to apt-get it</li>
<li>Gentoo: simply emerge it</li>
<li>Fedora Core 3 &amp; 4: netspeed is part of Fedoras Extras (<tt>gnome-applet-netspeed</tt>).</li>
<li>Redhat &amp; older versions of FC: Dag Wieers provides <a href="http://dag.wieers.com/packages/netspeed_applet/">some RPMs</a></li>
<li>FreeBSD: Fresh Ports provides <a href="http://www.freshports.org/net/netspeed_applet/">netspeed ports</a></li>
</ul>

<p>
Previous releases are available <a href="http://www.wh-hms.uni-ulm.de/~mfcn/netspeed/packages/">here</a>.
</p>



<!-- Changes -->
<h1><a name="changes">Changes</a></h1>
<h4>0.14</h4>
<ul>
<li>We now use 1000 bit = 1Mbit and 1024 bytes = 1 MiByte (thus switch to SI-Units)</li>
<li>Improved performace</li>
<li>Migration to gnome-doc-utils</li>
<li>Fixed some small leaks</li>
</ul>

<h4>0.13</h4>
<ul>
<li>The "layout-engine" for different panel-configurations was rewritten</li>
<li>Basic IPv6 support</li>
<li>Icontheme support</li>
<li>"dummy*" devices are now ignored in the "search for running device" handler</li>
<li>Try device with default gateway set first in the "search for running device" handler</li>
</ul>
Big thanks to Pedro Villavicencio Garrido and Benoit Dejean for their help!

<h4>0.12.1</h4>
<ul>
<li>There was a problem with configure not findig pkg-config. This should be fixed now.</li>
</ul>

<h4>0.12</h4>
<ul>
<li>Applied patches of Pedro Villavicencio Garrido: support panel-transparency and use new gtk about-dialog</li>
</ul>

<!-- Bugs -->
<h1><a name="bugs">Bugs &amp; Feature Requests</a></h1>
<p>
Please report bugs to <a href="http://bugzilla.gnome.org/buglist.cgi?product=netspeed">netspeed component</a> of GNOME Bugzilla.
</p>

</div>
<!-- end of body -->


<!-- header -->
<div id="hdr">
<div id="netspeed-logo"><a href="."><img src="images/spacer.png" alt="HOME" /></a></div>
<div id="hdrNav">
<a href="#about">About</a> &middot;
<a href="#screenshots">Screenshots</a> &middot;
<a href="#download">Get</a> &middot;
<a href="#faq">FAQ</a> &middot;
<a href="#changes">Changes</a> &middot;
<a href="#bugs">Bugs</a> &middot;
<a href="http://www.gnome.org/">GNOME</a>
</div>
</div>

<div id="copyright">
<p>Copyright &copy; 2002-2008, <a href="http://www.wh-hms.uni-ulm.de/~mfcn/">Joergen Scheibengruber</a> and <a href="http://www.gnome.org">The GNOME Project</a>.
<br />
GNOME and the foot logo are trademarks of the GNOME Foundation.
<br />
<?php last_modified() ?>
</p>
<p>
<?php display_counter() ?>
</p>
</div>
<!-- end of header -->

</body>
</html>