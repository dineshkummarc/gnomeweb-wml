<?php

$email = "{$_POST['email']}";
$checkbox = "{$_POST['vehicle']}";
$country = "{$_POST['country']}";
$name =  "{$_POST['firstname']}";
$captcha = "{$_POST['captcha']}";

// Sanity Checks

if (empty($_POST['firstname'])) {
    $output = "Please enter your full name.<br />";
    include('error.html.php');
    exit();
}

if (!preg_match("/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i", $email)) {
    $output = "Incorrect email format. Please try again.<br/><br/>";
    include('error.html.php');
    exit();
}

if (preg_match("/Select Country/", $country)) {
    $output = "Please select a valid country.<br/>";
    include('error.html.php');
    exit();
}

if (!preg_match("/Car/", $checkbox)) {
    $output = "Please agree to the terms of this contest.<br/>";
    include('error.html.php');
    exit();
}

if (empty($_FILES["datafile"]["name"])) {
    $output = "Please provide a valid file for submission.<br />";
    include('error.html.php');
    exit();
}

if (file_exists("uploads/" . $_FILES["datafile"]["name"])) {
    $output = $_FILES["datafile"]["name"] . "already exist.";
    include('error.html.php');
    exit();
} else {
    move_uploaded_file($_FILES["datafile"]["tmp_name"], "uploads/" . $_FILES["datafile"]["name"]);
}

if (!empty($captcha)) {
    $output = "Only bots fill out hidden form fields. Nice try.";
    include('error.html.php');
    exit();
}

include('Mail.php');
include('Mail/mime.php');
 
$message = new Mail_mime();
$text = "$name<br/>$country<br/>$email";
 
$message->setHTMLBody($text);
$message->addAttachment("uploads/" . $_FILES["datafile"]["name"]);
$body = $message->get();
$extraheaders = array("From"=>"$email", "Subject"=>"Contest Submission");
$headers = $message->headers($extraheaders);
 
$mail = Mail::factory("mail");
$mail->send("contest@gnome.org", $headers, $body);

$output = "$name<br /> $country<br /> $email<br /> {$_FILES["datafile"]["name"]}";
include('thank-you.html.php');

?>
