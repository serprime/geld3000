<?php

	$DatabaseHost = 'localhost';
	$DatabaseUser = 'root';
	$DatabasePassword = '';
	$Database = 'finance';

					
$con = mysql_connect($DatabaseHost,$DatabaseUser,$DatabasePassword);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($Database) or die(mysql_error());
?>