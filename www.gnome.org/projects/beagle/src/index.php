<? 

include_once('common.inc');

$option['pageid']='page-main';
$option['sidebar']='1';

template_header($option);

?>
<h2>
Quickly find the stuff you care about
</h2>
	<!-- Locate version 2.0!  We've combined the power of 'grep' with the snaziness of 'locate'! -->
	<p>

	Beagle is a search tool that ransacks your <i>personal
information space</i> to find whatever you're looking for.  Beagle can
search in many different domains:

	</p>
	<p>
	<div class="split-tosize img-box"><a href="http://www.beaglewiki.org/index.php/BeagleScreenshots"><img src="img/best-shot-thumb.png" border=0"><br><string>Find everything fast</strong></a>
	</div>

	<p>
	Using Beagle, you can easily find:
	<ul class="list-indented">
		<li><img src="img/office-doc.png">documents</li>
		<li><img src="img/stock_mail.png">emails</li>
		<li><img src="img/gnome-globe-16.png">web history</li>
		<li><img src="img/office-doc.png">IM/IRC conversations</li>
		<li><img src="img/source-doc.png">source code</li>
		<li><img src="img/image-doc.png">images</li>
		<li><img src="img/music-doc.png">music files</li>
		<li><img src="img/office-doc.png">applications</li>
		<li style="list-style: none;">...and <a href="#filetypes">much more</a></li>
	</ul>
	</p>
	<p>
	</p>

<h2 id="running">Running Beagle</h2>
<p>
The most recent version of Beagle is <b>0.0.3</b>, which
was released on November 23, 2004.  You can
<a href="http://ftp.gnome.org/pub/GNOME/sources/beagle/0.0/beagle-0.0.3.tar.gz">
download the 0.0.3 tarball here</a>.
</p>

<p>
The <a href="http://www.beaglewiki.org/index.php/Installing%20Beagle">Beagle project wiki</a> outlines where to get and install the software requirements.
</p>
<p>
<a href="http://ftp.gnome.org/pub/GNOME/sources/beagle/0.0/">Older versions</a>
of Beagle are also available.
</p>


<h2 id="discuss">Discussing Beagle</h2>

<img src="img/chat.png" class="img-leader">
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
<a href="http://www.planetbeagle.org/">Planet Beagle</a>,
an aggregator for the blogs various Beagle hackers.
</p>

<p>
There is a volunteer-maintained
<a href="http://www.beaglewiki.org">wiki</a> devoted
to Beagle and Dashboard development.  If you are having problems,
check there first.
</p>


<h2 id="bugs">Reporting bugs</h2>

<img src="img/debugger.png" class="img-leader">
<p>
If you find a bug in Beagle, please report it at the
<a href="http://bugzilla.gnome.org/enter_bug.cgi?product=beagle">
Beagle section</a> of
<a href="http://bugzilla.gnome.org">GNOME Bugzilla</a>.
</p>

<h2 id="filetypes">Supported filetypes</h2>
<ul id="supported-items">
	<li><img src="img/office-doc.png"> Microsoft Word
		<ul><li>doc</li></ul>
	</li>
	<li><img src="img/office-doc.png"> OpenOffice.org
		<ul>
			<li>sxw</li>
			<li>sxi</li>
			<li>sxm</li>
		</ul>
	</li>
	<li><img src="img/office-doc.png"> Microsoft PowerPoint
		<ul><li>ppt</li></ul>
	</li>
	<li><img src="img/office-doc.png"> Portable Document Format
		<ul><li>pdf</li></ul>
	</li>
	<li><img src="img/office-doc.png"> Web Pages
		<ul><li>html</li></ul>
	</li>
	<li><img src="img/office-doc.png"> Rich Text Format
		<ul><li>rtf</li></ul>
	</li>
	<li><img src="img/image-doc.png"> Images
		<ul>
			<li>jpg</li>
			<li>png</li>
	</ul>
	</li>
	<li><img src="img/music-doc.png"> Music
		<ul>
			<li>mp3</li>
			<li>ogg</li>
			<li>flac</li>
		</ul>
	</li>
	<li><img src="img/source-doc.png"> Texinfo Files
		<ul>
			<li>texi</li>
		</ul>
	</li>
	<li><img src="img/office-doc.png"> Plain Text
		<ul>
			<li>txt</li>
		</ul>
	</li>
	<li><img src="img/source-doc.png"> Source Code
		<ul>
			<li>java</li>
			<li>c</li>
			<li>c++</li>
			<li>c#</li>
			<li>python</li>
		</ul>
	</li>
</ul>

<span class="clear">&nbsp;</span>

<h2 id="hacking">Hacking</h2>
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


				</p>
			</div>

			<div id="sidebar">
				<h2><img src="img/news.png">Newsletters</h2>
				<ul id="newsletters">
					<li><a href="http://beaglewiki.org/index.php/Beagle%20Newsletter%20Issue%204">Monday November 29th</a></li>
					<li><a href="http://beaglewiki.org/index.php/Beagle%20Newsletter%20Issue%203">Thursday November 5th</a></li>
					<li><a href="http://beaglewiki.org/index.php/Beagle%20Newsletter%20Issue%202">Monday October 11th</a></li>
					<li><a href="http://beaglewiki.org/index.php/Newsletters">Archives</a></li>
					</ul>
				<h2><img src="img/example.png">Documentation</h2>
				<ul>
					<li><a href="http://beaglewiki.org/">BeagleWiki</a></li>
					<li><a href="http://www.planetbeagle.org/">Planet Beagle</a></li>
				</ul>
				
				<h2><img src="img/notebook.png">Developer Resources</h2>
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

			</div>

<?

template_footer($option);

?>
