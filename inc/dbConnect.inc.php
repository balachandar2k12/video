<?php

$mysql_db_hostname = "localhost";
$mysql_db_user = "root";
$mysql_db_password = "root";
$mysql_db_database = "vedio_hiphop";
define('PER_PAGE',4);
define('SITE',"http:localhost/vedio");

$con = mysql_connect($mysql_db_hostname, $mysql_db_user, $mysql_db_password) or die("Could not connect database");
mysql_select_db($mysql_db_database, $con) or die("Could not select database");
?>