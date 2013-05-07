<?php
if(isset($_POST['submit']))
{
	if($_POST['user_name']=='admin' && $_POST['password']=='admin')
	{
		header( 'Location: video_list.php' ) ;
	}
	else
	{
		echo "Enter valid details";
	}
}
?>
<form name="login_form" action="" method="post">
	<table>
		<tr>
			<td>
				User Name :
			</td>
			<td>
				<input name="user_name" type="text" required>
			</td>
		</tr>
		<tr>
			<td>
				Password :
			</td>
			<td>
				<input name="password" type="password" required>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input name="submit" type="submit">
			</td>
		</tr>
	</table>
</form>