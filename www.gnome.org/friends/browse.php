<?php
require "pre.php";
$HTML->header(array(title=>"Friends of GNOME", banner=>"friends"));
?>

<h2>Become a Friend of GNOME</h2>

<table>
<tr align="left"><th>Category</th><th>Amount/Price</th><th></th></tr>
<tr><td>Friend</td><td>up to $24.99</td><td><a href="order.php?id=101">Donate</a></td></tr>
<tr><td>Associate</td><td>$25.00 to $49.99</td><td><a href="order.php?id=102">Donate</a></td></tr>
<tr><td>Benefactor</td><td>$50.00 to $249.99</td><td><a href="order.php?id=103">Donate</a></td></tr>
<tr><td>Sponsor</td><td>$250.00 to $999.99</td><td><a href="order.php?id=104">Donate</a></td></tr>
<tr><td>Patron</td><td>$1,000.00 to $4999.99</td><td><a href="order.php?id=105">Donate</a></td></tr>
<tr><td>Founder</td><td>$5,000 or above</td><td><a href="order.php?id=106">Donate</a></td></tr>
<tr><td colspan="3"><br/>Your Friend of GNOME benefits will be effective for one year.<br/><br/></td></tr>
<?php //<tr><td>GNOME t-shirt</td><td>$20</td><td><a href="showitem.php?id=201">View Details</a></td></tr>?>
</table>

<p>Funds are used to support GNOME development, education and promotion
around the globe.</p>

<?php
$HTML->footer();
?>
