<?php

function html_begin_doc ($title)
{
	?>
<HTML>
<HEAD>
  <TITLE>GNOME-DB -
    <?php echo $title; ?>
  </TITLE>
</HEAD>

<BODY TEXT="#000000" bgcolor="#CCCCCC">
<table border=0 cellpadding="0" cellspacing="3" width="100%">
<tr>
  <td>
    <table border=0 cellpadding="0" cellspacing="3" width="100%">
    <tr>
      <td bgcolor="#777777">
        <table  border="0" cellpadding="0" cellspacing="2" width="100%" align="center">
       	<tr>
          <td bgcolor="#ffffff" colspan="0" width="100%" >
            <table cellspacing="0" width="100%" >
            <tr>
              <td>
                <IMG SRC="/projects/gnome-db/images/gnome-db.png" ALT="GNOME-DB"  BORDER=0>
              </td>
            </tr>
	    </table>
	  </td>
	</tr>
	</table>
      </td>
    </tr>
    </table>
  </td>
</tr>
<tr>
  <td rowspan="0" >
    <table border=0 cellpadding=0 cellspacing="3" width="100%" height="100%">
    <tr>
      <td valign="top" align="left" width="20%">
        <table border=0 cellpadding=0 cellspacing=0 width="100%" height="100%">
        <tr>
          <td valign="top">
            <table border=0 cellpadding="0" cellspacing="0" width="100%" height="100%">
            <tr>
              <td bgcolor="#777777" valign="top">
                <table  border="0" cellpadding="5" cellspacing="2" width="100%" align="center" height="100%">
                <tr>
                  <td  valign="top" bgcolor="#ffffff" nowrap>
                    <small><b>
                    <a href="/projects/gnome-db/index.php3">Main</a><br>
                    <a href="/projects/gnome-db/download.php3">Download</a><br>
                    <a href="/projects/gnome-db/news.php3">News</a><br>
                    <a href="/projects/gnome-db/doc/index.php3">Documentation</a><br>
                    <a href="/projects/gnome-db/mailing_lists.php3">Mailing Lists</a><br>
                    <a href="/projects/gnome-db/people.php3">People</a><br>
                    <a href="/projects/gnome-db/screenshots.php3">Screenshots</a><br>
                    <a href="/projects/gnome-db/TODO.php3">TODO</a><br>
                    <a href="/projects/gnome-db/apps.php3">Application List</a><br>
                    <br><a href="http://cvs.gnome.org/lxr/source/gnome-db/">Browse the
                        Code</a><br> 
                    </b></small>
                    <br>
                    <br>
                    <center>
                    <a href="http://www.icewalk.com/app_vote.php3?id=646">
                       <img src="/projects/gnome-db/images/rate_it.gif" alt="Vote for !" width="80"
                            height="18" border="1"></a><br>
                    </center>
                  </td>
                </tr>
                </table>
              </td>
            </tr>
            </table>
          </td>
        </tr>
        </table>
      </td>
      <td valign="top" >
        <table border=0 cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td bgcolor="#777777" valign="top" >
            <table  border="0" cellpadding="5" cellspacing="2" width="100%" align="center">
            <tr>
              <td valign="top" bgcolor="#ffffff">
<?php
}

function html_end_doc ()
{
	?>
	      </td>
            </tr>
            </table></center>
          </td>
        </tr>
        </table>
      </td>
    </tr>
    </table>
  </td>
</tr>
</table>
  </td>
</tr>
<tr>
  <td>
    <table>
    <div align="right">
      <font size=2>Last modified 2000/06/15</font>
    </div>
    <div align="right">
      <B><a href="mailto:rmoya@chez.com">rmoya@chez.com</a></B>
    </div>
    </table>
  </td>
</tr>
</table>
</BODY>
</HTML>
	<?php
}

?>


