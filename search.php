<?php 
 include_once('inc/dbConnect.inc.php');
if(isset($_POST['SearchVideo']) && $_POST['SearchVideo']!="")
{
  $key= $_POST['SearchVideo'];
  $query="select * from videos where title like '%$key%'";
  $result = mysql_query($query);
  $num_rows=mysql_num_rows($result);
}
else
{
  $key="";
  $num_rows=0;
}
?>

<html>
  <head>
    <title>
      vide hip hop
    </title>
    <link rel="stylesheet" type="text/css" href="css/videoM.css">
  </head>
  <body style="background:#efefef;">
  
    <?php include('header.php'); ?>

    <form action="search.php" method="post">
      <br>
      <table width="30%" border="0" class="front_page_list_table" align=center>
        <tr>
          <td>
            <hr />
          </td>
        </tr>
        <tr>
          <td>
            &nbsp;
          </td>
        </tr>
        <tr>
          <td align="center">
            <h2 class="bigdate">
              <?php 
                if($num_rows==0)
                  echo "No Videos Found";
                else if($num_rows==1)
                  echo "$num_rows Video Found";
                else
                  echo "$num_rows Videos Found";
              ?>
            </h2>
          </td>
        </tr>
      </table>
      <input type="hidden" name="SearchVideo" value="zay">
      <input type="hidden" name="SearchName" value="0">
      <input type="hidden" name="SearchDate" value="0">
      <input type="hidden" name="SearchArtist" value="0">
    </form>
    <table width="100" border="0" align="center" bgcolor="#EFEFEF";>
      <tr>
        <?php
        if($key!="")
        {
          $i=1;
          if($num_rows)
          {
            while($row = mysql_fetch_array($result))
            {
        ?>
              <td height="100%" valign="top">
                <table width="100%" border="0">
                  <tr>
                    <td valign="top">
                      <div align="center">
                        <a href="video.php?id=<?php echo $row['id']?>">
                          <img src="<?php echo $row['thumbnail_image']?>" width="211" height="195" />
                        </a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div align="center">
                        <strong>
                          <?php echo $row['title']?>
                        </strong>
                      </div>
                      <div align="center">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div align="center">
                        <strong>
                          <span class="style9">
                            Total Views <?php echo $row['total_views']?>
                          </span>
                        </strong>
                      </div>
                    </td>
                  </tr>
                </table>
              </td>  
        <?php
              if($i%4==0)
                echo "</tr><tr>";
              $i++;
            }
          }
        }
        ?>

      </tr>
    </table>

  </body>
</html>
