<?php 
if($_POST['id'])
{
	$id=$_POST['id'];
	include"../db.php";
	$sql = "DELETE FROM video_hiphop.videos WHERE videos.id = $id";
	$result = mysql_query($sql) or die('MySql Error' . mysql_error());
	echo $result;
}