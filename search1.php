<?php
   mysql_connect('localhost','root','jaiyog');
   mysql_select_db('chitfund');
   $exp ='';
   $value = $_POST['value'];
   echo '<ul>';
   $sql = mysql_query("select memberid,membername from memberinfo where membername LIKE '$value%'");
   while($row = mysql_fetch_assoc($sql))
   {
      $name= $row['membername'];
      echo "<li>
          <a href = 'entry1.php?exp=list&memberid=".$row['memberid']."&name=".$name."'>$name</a>
          </li><br>";
  }
 echo '</ul>';

?>
