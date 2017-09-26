<html>
<?php
   mysql_connect('localhost','root','jaiyog');
   mysql_select_db('chitfund');
   $sql1 =mysql_query("select *from auction where groupid= '".$_POST['groupid']."' and auctionamount is not null" );

?>
<option>-----தவணை-----</option>
<?php
  while($row = mysql_fetch_assoc($sql1))
 {
    ?>
  <option name = "noofinstall" value = "<?php echo $row['chitinstallno'];?>"><?php echo $row['chitinstallno'];?></option>
<?php  }?>
</html>
