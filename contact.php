<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
  #form-container{
  text-align: center;
  margin-top: 36PX;
		margin-left: 20%;
		max-width: 60%;
		border: 1px solid grey;
		border-radius: 28px;
  }
	</style>
</head>
<body>

<?php include('header.php');
include_once("inc/dbConnect.inc.php");
if (isset($_POST['submitted']) && $_POST['visitormail']!= "") {
$name=$_POST['visitor'];
$email=$_POST['visitormail'];
$attn=$_POST['attn'];
$notes=$_POST['notes'];

//echo "<br>arr";
//print_r($season_arr);


$sql = "INSERT INTO `vedio_hiphop`.`contacts` (`name`, `email`, `attention`, `message`) VALUES ('".$name."' , '".$email."','".$attn."','".$notes."');";

 //echo "$sql";
 if(mysql_query($sql)){
 echo '<script type="text/javascript"> alert("Message succesfully delivered!");</script>
';
 }

}

?>
<script type="text/javascript"> alert("Message succesfully delivered!");</script>

<div id="form-container">
<form method="post" action="">
<input type="hidden" name="ip" value="" />
<input type="hidden" name="httpref" value="http://www.worldstarhiphop.com/videos/tos.php" />
<input type="hidden" name="httpagent" value="" />

<br />
Name: <input type="text" name="visitor" size="35" required/>
<br /> <br />
Email: * <input type="text" name="visitormail" size="35" required/>
<br /> <br />
Attention:
<select name="attn" size="">
<option value=" General ">General </option>
<option value=" Technical ">Technical </option>
<option value=" Legal ">Legal </option>
<option value=" Advertising ">Advertising </option>
<option value="press">Press </option>
</select>
<br /><br />
Message:
<br />
<textarea name="notes" rows="4" cols="40" required></textarea>
<br />
<br />
<input type="submit" value="Send Mail" />
<input type="hidden" name="submitted" value="true" />
</form>
<br><br>
<br>
<center>
<b>Video Submissions</b><br>

Thank you for submitting your video to our website.  Send video<br>
submissions to (worldstar@worldstarhiphop.com). Include in your submission<br>
the title, description, and the video url. (Upload video to<br>
sendspace.com). All video submissions will get proper credit if<br>
accepted.<br><br>

By submitting your video, you are representing to Worldstar Hip Hop that<br>
you have all necessary rights in the video to authorize our use and<br>
reuse of the audio and visual material it contains, that your submission<br>
of the video is governed by our <a href="#" target="_blank">On Line Video Submission Agreement</a>, and<br>
that you have read, understood and agreed to the terms and conditions of<br>
that Agreement.<br>
</center>
</div>

</body>
</html>