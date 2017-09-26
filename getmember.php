<html>
<?php
   mysql_connect('localhost','root','jaiyog');
   mysql_select_db('chitfund');
   $sql1 =mysql_query("select memberid from membergroup where groupid= '".$_POST['groupid']."'" );

?>
<option>-----உறுப்பினர்களின் பெயர்-----</option>
<?php
     while($r = mysql_fetch_assoc($sql1))
     {
       $memberid = $r['memberid'];
       $sq = mysql_query("select *from memberinfo where memberid = '$memberid'");
      while($row = mysql_fetch_assoc($sq))
     {
        ?>
        <option name = "member" value = "<?php echo $row['memberid'];?>"><?php echo $row['membername'];?></option>
      <?php  }}?>
</html>
