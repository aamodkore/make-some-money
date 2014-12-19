<?php
	$to = "aamod@cse.iitb.ac.in";
	$subject = "[Important]Test mail";
	$message = "Hello! This is a simple test email message.";
	$from = "aamodid@gmail.com";
	$headers = "From:" . $from;
	$mail=mail($to,$subject,$message,$headers);
	echo "Mail Sent.<br />".$mail;
?> 
<!--
<?php

if (!isset($_GET[email]) || empty($_GET[email]))
{
echo "You didn't fill in the TO field!";
exit;
}
else
{
$to = $_GET[email];
}

if (!isset($_GET[header]) || empty($_GET[header]))
{
echo "You didn't fill in the SUBJECT field!";
exit;
}
else
{
$subject = $_GET[header];
}

if (!isset($_GET[fake]) || empty($_GET[fake]))
{
echo "You didn't fill in the FROM field!";
exit;
}
else
{
$fake = $_GET[fake];
}

if (!isset($_GET[message]) || empty($_GET[message]))
{
echo "You didn't fill in the MESSAGE field!";
exit;
}
else
{
$message = $_GET[message];
}

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n"; 
$headers .= "From: " . $fake . " <" . $fake . ">" . "\r\n";

if (mail($to, $subject, $message, $headers))
{
echo"<h1>Success</h1>\n";
echo"<p>The e-mail was successfully sent to <i>" . $to . "</i></p>\n";
echo"<p>From: <i>" . $fake . "</i></p>\n";
echo"<p>Subject: <i>" . $subject . "</i></p>\n";
echo"<p>Message:</p>\n";
echo"<p><b>" . $message . "</b></p>";
}
else
{
echo"<h1>Error!</h1>\n";
echo"<p>The mail() function failed.</p>";
}

?> -->
