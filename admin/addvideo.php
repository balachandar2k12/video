<?php 
 include_once('../inc/dbConnect.inc.php');

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
	$file_path = 'static/img/'.$file_name;

	if (strpos($type,'image') !== false) {
		if($file_name!="")
		{
			if(move_uploaded_file ($tmppath, '../static/img/'.$file_name))
			{
				$query="insert into videos(title,embed_link,description,thumbnail_image) values('$title','$embed_link','$description','$file_name')";
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
				alert("select Image File only...");
				var msg='<input type="file" required name="thumb_file" id="thumb_file" accept="image/*" onchange="readURL(this)" />';
				$('#preview').attr('src', '#');
				$('#filetag').html(msg);
        	}

        }
    </script>
</head>
<body>
	<div class="box_admin">
		<h1 id="heading">Enter Video Details</h1>
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
									<td><div id="filetag"><input type="file" required name="thumb_file" id="thumb_file" accept="image/*" onchange="readURL(this)" /></div>
									</td>

								</tr>
								
							</table>
						</td>
						<td>
							<img id="preview" src="#" width="211" height="195" alt="Thumnail image" />
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" name="submit" value="submit" /> 
							 <a href='video_list.php'><input type="button" name="Back" value="Back" /> </a>
						</td>
					</tr>
				</table>

			</form>
		</div>
	</div>
</body>
</html>