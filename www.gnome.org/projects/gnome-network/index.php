<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"
  "http://www.w3.org/TR/REC-html40/loose.dtd">

<?
  $current_version = "1.99.3";
  $date_release = "November 25, 2003";
?>
  
<html>
  <head>
    <title>GNOME Network</title>
    <link rel="stylesheet" href="style/gn.css" type="text/css">
    <link rel="icon" type="image/png" href="images/foot-16.png">
  </head>
  <body bgcolor="#FFFFFF">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td valign="top" align="left">
      	  <img src="images/gnome-194.png" alt="GNOME" align="left" />
        </td>
        <td rowspan="2" width="25">
          <img src="images/spacer.png" alt="" hspace="12" width="1" height="1" />
        </td>
        <td align="left" style="background: #ffffff" width="100%" height=135>
          <img src="images/gnomenetworklogo.png" alt="GNOME Network" width="445" height="91" ALIGN="center" />
        </td>
      </tr>
      <tr>
        <td valign="top">
          <img src="images/spacer.png" alt="" vspace="5" width="1" height="1" />
<?
  include ("menu.html");
?>
        </td>
        <td valign="top">
<?
  if (empty ($page))
    $page = "home";
  include ("$page.html");
?>
        </td>
      </tr>
    </table>
    <div align="center">
      <p><font color="#777777" size="-1">Copyright &copy; 1999-2003 GNOME Foundation.</font></p>
    </div>
  </body>
</html>

