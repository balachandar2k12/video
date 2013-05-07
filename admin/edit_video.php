<?php 
$con=mysql_connect( "localhost","root","root");
mysql_select_db ("video_hiphop",$con);
if(@$_POST ['submit'])
{
	$uploaddir='../static/img/';
	$file = $_FILES ['thumb_file'];
	$file_name = $file ['name'];
	$type = $file ['type'];
	$size = $file ['size'];
	$tmppath = $file ['tmp_name'];

	$exists = file_exists($uploaddir.$file_name);
	if($exists)
	{
		$file_name=substr_replace(sha1(microtime(true)), '',3).'_'.$file_name;
	}

	$id=$_POST['id'];
	$title=$_POST['title'];
	$embed_link=$_POST['embed_link'];
	$description=$_POST['description'];
	$file_path = $uploaddir.$file_name;

	if (strpos($type,'image') !== false) {
		if($file_name!="")
		{
			if(move_uploaded_file ($tmppath, $uploaddir.$file_name))
			{
				$query="update videos set title='$title',embed_link='$embed_link',description='$description',thumbnail_image='$file_path' where id=$id";
				mysql_query ($query) or die ('could not updated:'.mysql_error());
				header( 'Location: video_list.php' ) ;
			}
			else
			{
				echo "error in file";
			}
		}
	}
	else {
		echo "select image file to upload";
	}
}
else
{
	if(isset($_GET['videoid'])&&$_GET['videoid']!="")
	{
		$id=$_GET['videoid'];
		$query="select * from videos where id=$id";
		$result = mysql_query($query);
		$num_rows=mysql_num_rows($result);
		if($num_rows)
		{
			while($row = mysql_fetch_array($result))
			{
				$title=$row['title'];
				$description=$row['description'];
				$embed_link=$row['embed_link'];
				$file_path=$row['thumbnail_image'];
			}
		}

	}
	else
	{
		header( 'Location: video_list.php' ) ;
	}
}
		


?>
<html>
<head>
<title>Edit Video</title>
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/videoM.css">
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />
<script type="text/javascript">
        function readURL(input) {
        	var file_type =input.files[0].type;
        	if (file_type.indexOf("image") !== -1)
        	{
        		if (input.files && input.files[0]) {
	                var reader = new FileReader();

	                reader.onload = function (e) {
	                    $('#preview').attr('src', e.target.result);
	                }

	                reader.readAsDataURL(input.files[0]);
            	}
        	}
        	else
        	{
        		alert("select image file");
        	}

        }
    </script>
</head>
<body>
	<div class="box_admin">
		<h1 class="bigdate">Edit Video Details</h1>
		<div style="height:50px"></div>
		<div id="container_video" style="margin:auto">
			<form name="form" action="" method="post" enctype="multipart/form-data">
					<td><input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
<table>
	<tr>
		<td>
			<table>
				<tr>
					<td>Title
					</td>
					<td><input type="text" required name="title" id="title" value="<?php echo $title; ?>" />
					</td>

				</tr>
				<tr>
					<td>Embedded Link
					</td>
					<td><input type="text" required name="embed_link" id="emb_link" value="<?php echo $embed_link; ?>"/>
					</td>
				</tr>
				<tr>
					<td>Description
					</td>
					<td><input type="text" required name="description" id="description" value="<?php echo $description; ?>" />
					</td>
				</tr>
				<tr>
					<td>Thumbnail Image
					</td>
					<td><input type="file" required name="thumb_file" id="thumb_file" value="<?php echo $file_path; ?>" accept="image/*" onchange="readURL(this)" />
					</td>

				</tr>
				<tr>
					<td>
					</td>
					<td><input type="submit" name="submit" value="submit" /> 
					</td>
				</tr>
			</table>
		</td>
		<td>
			<img id="preview" src="<?php echo $file_path; ?>" width="150" height="150" alt="Thumnail image" />
		</td>
	</tr>
</table>



			</form>
		</div>
	</div>
</body>
</html>