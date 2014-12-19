<?php
$myServer='localhost';
$myUser='user';
$myPass='**********';
$myDB='database';
$db_flag = true;	
$con = mysql_connect($myServer, $myUser, $myPass)
	or $db_flag = false;
//  or die("Couldn't connect to SQL Server on $myServer :".mysql_error()); 
$db=mysql_select_db($myDB,$con)
	or $db_flag = false;
//  or die("Couldn't connect to $myDB at $myServer");
?>
