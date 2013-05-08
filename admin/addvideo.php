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

	$title=$_POST['title'];
	$embed_link=$_POST['embed_link'];
	$description=$_POST['description'];
	$file_path = $uploaddir.$file_name;

	if (strpos($type,'image') !== false) {
		if($file_name!="")
		{
			if(move_uploaded_file ($tmppath, $uploaddir.$file_name))
			{
				$query="insert into videos(title,embed_link,description,thumbnail_image) values('$title','$embed_link','$description','$file_path')";
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

?>
<html >
<head>
<title>Add Video</title>
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
        		$("#thumb_file").val="";
        	}

        }
    </script>
</head>
<body>
	<div class="box_admin">
		<h1 class="bigdate">Enter Video Details</h1>
		<div style="height:50px"></div>
		<div id="container_video" style="margin:auto">
			<form name="form" action="" method="post" enctype="multipart/form-data">
				<table>
					<tr>
						<td>
							<table>
								<tr>
									<td>Title
									</td>
									<td><input type="text" required name="title" id="title" />
									</td>
								</tr>
								<tr>
									<td>Embedded Link
									</td>
									<td><input type="url" required name="embed_link" id="emb_link" />
									</td>
								</tr>
								<tr>
									<td>Description
									</td>
									<td><input type="text" required name="description" id="description" />
									</td>
								</tr>
								<tr>
									<td>Thumbnail Image
									</td>
									<td><input type="file" required name="thumb_file" id="thumb_file" accept="image/*" onchange="readURL(this)" />
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