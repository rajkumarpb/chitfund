<html>
<?php
   mysql_connect('localhost','root','jaiyog');
   mysql_select_db('chitfund');
   $sql1 =mysql_query("select *from membergroup where memberid= '".$_POST['memberid']."'" );
?>
<option>-----குரூப்பின் பெயர்-----</option>
<?php
  while($row = mysql_fetch_assoc($sql1))
  {
    $sq = mysql_query("select *from groupinfo where groupid = '".$row['groupid']."'");
    while($r = mysql_fetch_assoc($sq))
  {
    ?>
  <option name = "group" value = "<?php echo $r['groupid'];?>"><?php echo $r['symbolicname'];?></option>
<?php }}?>
</html>
