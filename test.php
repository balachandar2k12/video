<!-- n=3 -->
<!-- select id,date(added_on) from videos where date(added_on) >= (select distinct date(added_on) from videos order by added_on desc limit 1 offset n+4) and date(added_on) <= (select distinct date(added_on) from videos order by added_on desc limit 1 offset n) order by added_on desc  -->



<?php
include('inc/dbConnect.inc.php');
//$sql = "select * from videos ";
$n=3;
$sql= "select id,date(added_on) as date,`embed_link`,`title`,`description`,`total_views`,`thumbnail_image` from videos where date(added_on) >= (select distinct date(added_on) from videos order by added_on desc limit 1 offset ".($n+4).") and date(added_on) <= (select distinct date(added_on) from videos order by added_on desc limit 1 offset $n) order by added_on desc;";
//echo $sql;
$old_date="";
$count=0;
$result = mysql_query($sql);

          while($row = mysql_fetch_array($result)){

          if ($old_date != $row['date']){
            if ($old_date != '' ) {
              echo '</table>';
            }
           $count=0;
            echo 'table<table></tr>';
            $old_date=$row["date"];
          }



          foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }

            if ($count%3==0){
              echo "</tr><tr>";
            }
            ?>

             <td align="center" valign="top">
              <a href="/videos/video.php?v=<?php echo $row["embed_link"]; ?>">
                <img src="static/img/no_video.png" width="200" height="151" vspace="5" />
                <b> <?php echo $row["date"]; ?>
                  <a href="/videos/video.php?v=<?php echo $row["embed_link"]; ?>">
                   <?php echo $row["comment"]; ?>
                  </b>
                </a>
                <br>
                <strong>
                  <span style="line-height:20px">
                    Total Views <?php echo $row["total_views"]; ?>
                  </span>
                </strong>
              </td>

    <?php   $count++;  }  ?>

 </tr> </table>