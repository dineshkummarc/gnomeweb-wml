<?php

include ("./util.php");

// $to = "xkahn@ximian.com";
$to = "bounty@lists.ximian.com";
$message = "\r\n" . 
	   "bounty: " . $_POST['bounty'] . "\r\n" .
	   "name: " . $_POST['name'] . "\r\n" . 
	   "email: " . $_POST['email'] . "\r\n" .
	   "phone: " . $_POST['phone'] . "\r\n" .
           "donate: " . $_POST['donate'] . "\r\n\r\n" .
           "solution: " . "\r\n" . $_POST['solution'] . "\r\n\r\n" .
           "team: " . "\r\n" . $_POST['team'] . "\r\n\r\n" .
           "help: " . "\r\n" . $_POST['help'] . "\r\n\r\n" . 
           "notes: " . "\r\n" . $_POST['notes'] . "\r\n\r\n";

$status = mail ($to, "Submission for Bounty #" . $_POST['bounty'], stripslashes($message));

?>

<?php write_page_header ("Thank you for your submission to Bounty #" . $_POST['bounty']); ?>

<?php box_start ("Thank you for your submission to Bounty #" . $_POST['bounty']); ?>

Thank you for your submission.  

<?php if ($status) { ?>
  We'll get back to you as soon as we can -- probably within two business days.
<?php } else { ?>
  There was a problem sending your submission.  Please send email to <a href="webmaster@ximian.com">webmaster@ximian.com</a> and report this problem.  Or, simply try to submit again later.
<?php } ?>

<?php box_end (); ?>

<?php write_page_footer (); ?>

</body>
</html>

