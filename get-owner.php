<html>
<?php
   mysql_connect('localhost','root','jaiyog');
   mysql_select_db('chitfund');
   $sql1 =mysql_query("select *from memberinfo where responseid= '".$_POST['responseid']."'" );

?>
<option>-----உறுப்பினர் பெயர்-----</option>
<?php
  while($row = mysql_fetch_assoc($sql1))
 {
    ?>
  <option name = "member" value = "<?php echo $row['memberid'];?>"><?php echo $row['membername'];?></option>
<?php  }?>
</html>
