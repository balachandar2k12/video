<?php
 //include_once('inc/dbConnect.inc.php');
error_reporting(E_ALL);
      //Calculating no of pages
      $sql = "select SQL_NO_CACHE distinct(date(added_on)) from videos;";


      $result = mysql_query($sql);
      $count = mysql_num_rows($result);
      $pages = ceil($count/PER_PAGE);
      //Pagination Numbers
        for($i=1; $i<=$pages; $i++)
        {
          $link= ($cur_page==$i)? "":"index.php?page=".$i;

           echo '<a href="'.$link.'"><strong> '.$i.'</strong></a>&nbsp;&nbsp;&nbsp;';
        }
        echo "of $pages";


?>