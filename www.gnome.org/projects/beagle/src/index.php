<? 

include_once('common.inc');

$option['pageid']='page-main';
$option['sidebar']='1';

template_header($option);

?>
<div class="summary">
  Have you ever forgotten what you called that really important file, or forgot where you put it?  Beagle is an experimental tool for indexing and searching your local files.  Using Beagle, you can search your <nobr><img src="img/office-doc.png">office</nobr> documents, <nobr><img src="img/image-doc.png"></nobr>images, <nobr><img src="img/music-doc.png"></nobr>music files, and your <nobr><img src="img/source-doc.png">source</nobr> code.

					</div>
					
				<div class="split-half"><a href="img/screenshot-mockup.png"><img src="img/screenshot-mockup-thumb.png" border=0"></a>
				</div>
				<div class="split-half">
						The mockup on the left gives a good example of a user searching for "baggins" and finding a number of contacts, files, email, and web pages.  Click the image to see it full size.
				</div>

<br clear="all">

<h2><a name="running">Running Beagle</a></h2>
<p>
The most recent version of Beagle is <b>0.0.2</b>, which
was released on September 1, 2004.  You can
<a href="http://ftp.gnome.org/pub/GNOME/sources/beagle/0.0/beagle-0.0.2.tar.gz">
download the 0.0.2 tarball here</a>.
</p>

<p>
Beagle requires <a href="http://www.go-mono.com/download">Mono 1.0.1</a>,

<a href="http://ftp.gnome.org/pub/GNOME/sources/evolution-sharp/0.3">
Evolution-sharp 0.3</a> and
<a href="http://www.freedesktop.org/Software/dbus">CVS D-BUS</a> (including
the Mono bindings).
</p>

<p>
<a href="http://ftp.gnome.org/pub/GNOME/sources/beagle/0.0/">Older versions</a>
of Beagle are also available.
</p>


<h2><a name="discuss">Discussing Beagle</a></h2>

<p>
Discussions relating to Beagle take place in <b>#dashboard</b> on
<a href="http://www.xach.com/gimpnet">GIMPnet</a>
and on the
<a href="http://mail.gnome.org/mailman/listinfo/dashboard-hackers">
dashboard-hackers</a>
mailing list.
</p>

<p>
<a href="http://tech9.net/rml">Robert Love</a> has set up
<a href="http://www.planetbeagle.org">Planet Beagle</a>,
an aggregator for the blogs various Beagle hackers.
</p>

<p>
There is a volunteer-maintained
<a href="http://yakko.cs.wmich.edu/gasiorek/wiki">wiki</a> devoted
to Beagle and Dashboard development.  If you are having problems,
check there first.
</p>


<h2><A name="bugs">Reporting Bugs</a></h2>

<p>
If you find a bug in Beagle, please report it at the
<a href="http://bugzilla.gnome.org/enter_bug.cgi?product=beagle">
Beagle section</a> of
<a href="http://bugzilla.gnome.org">GNOME Bugzilla</a>.
</p>



<h2><a name="hacking">Hacking</a></h2>
<p>
Beagle is written in C# using
<a href="http://www.go-mono.com">Mono</a>

and
<a href="http://gtk-sharp.sourceforge.net">Gtk#</a>.
The indexing is handled by
<a href="http://sourceforge.net/projects/lucenedotnet">Lucene.Net</a>,
a C# port of the <a href="http://www.lucene.net">Lucene</a> indexer.
The source code lives in the
<a href="http://developer.gnome.org/tools/cvs.html">GNOME CVS</a>
repository in the module <b>beagle</b>.
</p>

<p>
Beagle is still in a very early stage of development, and contributions
are encouraged.  Patches can be sent to the

<a href="http://mail.gnome.org/mailman/listinfo/dashboard-hackers">dashboard-hackers</a>
mailing list.
</p>

<table cellSpacing=1 cellPadding=0 width=100% border=0 valign="center"> 
<tr><td><img src="img/office-doc.png"></td><td>Microsoft Word</td><td>(doc)</td><td><img src="img/office-doc.png"></td><td>OpenOffice.org Write</td><td>(sxw)</td></tr>
<tr><td><img src="img/office-doc.png"></td><td>Microsoft PowerPoint</td><td>(ppt)</td><td><img src="img/office-doc.png"></td><td>Portable Document Format</td><td>(pdf)</td></tr>
<tr><td><img src="img/office-doc.png"></td><td>HyperText Markup Language</td><td>(html)</td><td><img src="img/office-doc.png"></td><td>Rich Text Format</td><td>(rtf)</td></tr>
<tr><td><img src="img/image-doc.png"></td><td>Images</td><td>(jpg, png)</td><td><img src="img/music-doc.png"></td><td>Music</td><td>(mp3, ogg)</td></tr>
<tr><td><img src="img/source-doc.png"></td><td>Texinfo Files</td><td>(texi)</td><td><img src="img/source-doc.png"></td><td>Source Code</td><td>(java, c, c++, c#, python)</td></tr>
<tr><td><img src="img/office-doc.png"></td><td>Plain Text</td><td>(txt)</td></tr>
</table>

				</p>
			</div>

			<div id="sidebar">
				<h2><img src="img/chat.png">Developer Resources</h2>

				<ul>
					<li><a
				href="http://bugzilla.gnome.org/buglist.cgi?short_desc_type=allwordssubstr&short_desc=&product=beagle&long_desc_type=allwordssubstr&long_desc=&status_whiteboard_type=allwordssubstr&status_whiteboard=&keywords_type=anywords&keywords=&bug_status=UNCONFIRMED&bug_status=NEW&bug_status=ASSIGNED&bug_status=REOPENED&emailtype1=substring&email1=&emailtype2=substring&email2=&bugidtype=include&bug_id=&changedin=&chfieldfrom=&chfieldto=Now&chfieldvalue=&cmdtype=doit&order=Bug+Number&field0-0-0=noop&type0-0-0=noop&value0-0-0=">Outstanding bugs</a></li>
					<li><a href="http://nat.org/beagle-fixme.php3">Outstanding FIXMEs</a></li>
					<li><a href="http://lists.gnome.org/archives/dashboard-hackers/">Mailing
				list archives</a></li>
					<li><a href="http://cia.navi.cx/stats/project/gnome/beagle">CIA
				Project Status</a></li>
					<li><a
				href="http://cvs.gnome.org/viewcvs/*checkout*/beagle/AUTHORS">Authors
				List</a></li>

				</ul>

				<h2><img src="img/news.png">Newsletters</h2>
				<ul id="newsletters">
					<li><a href="http://beaglewiki.org/index.php/Beagle%20Newsletter%20Issue%202">Monday October 11th</a></li>
					<li><a href="http://beaglewiki.org/index.php/Beagle%20Newsletter%20Issue%201">Tuesday September 21st</a></li>
					</ul>
				<h2><img src="img/example.png">Documentation</h2>
				<ul>
					<li><a href="http://beaglewiki.org/">BeagleWiki</a></li>
					<li><a href="http://planetbeagle.org/">Planet Beagle</a></li>
				</ul>
<!--				<h2><img src="img/notebook.png">Beagle To-Go</h2>
				<ul>
					<li><a href="http://beaglewiki.org/">BeagleWiki</a></li>
					<li><a href="http://planetbeagle.org/">Planet Beagle</a></li>
				</ul>
				<h2><img src="img/chat.png">Get Involved!</h2>
				<ul>
					<li><a href="http://beaglewiki.org/">BeagleWiki</a></li>
					<li><a href="http://planetbeagle.org/">Planet Beagle</a></li>
				</ul>
-->
			<!--<a href="http://mail.gnome.org/mailman/listinfo/dashboard-hackers"><img src="img/dog-mail.png">Join the mailing list!</a>-->
			</div>

<?

template_footer($option);

?>
