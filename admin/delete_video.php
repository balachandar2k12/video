<?php 
 include_once('../inc/dbConnect.inc.php');

if($_POST['id'])
{
	$id=$_POST['id'];
	$sql = "DELETE FROM videos WHERE id = $id";
	$result = mysql_query($sql) or die('MySql Error' . mysql_error());
	echo $result;
}